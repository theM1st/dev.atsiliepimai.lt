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

    protected $imageConfig = array(
        'lg' => array('width' => 256),
        'sm' => array('width' => 128),
        'xs' => array('width' => 64),
    );

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

        return $dir;
    }

    public function upload($file, $imageConfig=null, $remove=true)
    {
        // don't forget upload_max_filesize and post_max_size
        // memory_limit minimum 256M if file size ~3MB

        $imageConfig = ($imageConfig ? $imageConfig : $this->imageConfig);

        $filename = $this->slugFilename($file);

        $img = \Image::make($file->getRealPath());

        foreach ($imageConfig as $size => $c) {
            $dir = public_path($this->getUploadPath($size));

            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            } elseif ($remove) {
                $files = Storage::files($this->getUploadPath($size));
                Storage::delete($files);
            }

            $img->fit($c['width'])->save($dir . $filename);
        }

        return $filename;
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
