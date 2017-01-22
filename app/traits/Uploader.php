<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

trait Uploader
{
    /**
     * Upload path
     *
     * @var string
     */
    protected $uploadPath = "uploads";

    protected $defaultConfig = array(
        'lg' => array('width' => 512),
        'md' => array('width' => 256),
        'sm' => array('width' => 128),
        'xs' => array('width' => 64),
    );

    public function getPicture($size='sm')
    {
        $class = $this->getClass();

        if (!$this->picture) {
            return asset(
                'assets/images/'.str_plural($class).'/'.$size.'/'.$this->defaultPicture
            );
        }

        return '/' . $this->getUploadPath($size) . $this->picture;
    }

    /**
     * Return upload path
     *
     * @param string $suffix
     *
     * @return string
     */
    public function getUploadPath($suffix=null)
    {
        $suffix = (isset($this->id) ? $this->id . '/' : '') . $suffix;

        $class = $this->getClass();

        $dir = $this->uploadPath . '/' .
            str_plural($class) . ($suffix ? '/' . $suffix : '') . '/';

        return trim($dir, '/') . '/';
    }

    public function upload($file, $remove=true)
    {
        // don't forget upload_max_filesize and post_max_size
        // memory_limit minimum 256M if file size ~3MB

        $filename = $this->slugFilename($file);

        $this->saveFile($filename, $file->getRealPath(), $remove);

        return $filename;
    }

    public function deleteDirectory($dir)
    {
        Storage::deleteDirectory($dir);
    }

    public function deleteFiles($dir)
    {
        $files = Storage::files($dir);

        Storage::delete($files);
    }

    public function saveFile($filename, $filePath, $remove=true)
    {
        $imageConfig = (isset($this->imageConfig) ? $this->imageConfig : $this->defaultConfig);

        foreach ($imageConfig as $size => $c) {
            $img = \Image::make($filePath);

            $dir = public_path($this->getUploadPath($size));

            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            } elseif ($remove) {
                $this->deleteFiles($this->getUploadPath($size));
            }

            if (!empty($c['fit'])) {
                $img->fit($c['width']);
            } else {
                $img->widen($c['width']);
            }

            $img->save($dir . $filename);
        }
    }

    private function slugFilename($file)
    {
        return Str::slug(basename($file->getClientOriginalName(), $file->getClientOriginalExtension()), '-').'.'.$file->getClientOriginalExtension();
    }

    private function getClass()
    {
        return (substr(strrchr(get_class($this), '\\'), 1));
    }
}
