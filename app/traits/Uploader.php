<?php

namespace App\Traits;

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
        $suffix = (isset($this->id) ? $this->id . DIRECTORY_SEPARATOR : '') . $suffix;

        $class = $this->getClass();

        $dir = $this->uploadPath . DIRECTORY_SEPARATOR .
            str_plural($class) . ($suffix ? DIRECTORY_SEPARATOR . $suffix : '') . DIRECTORY_SEPARATOR;

        return $dir;
    }

    public function upload($file, $imageConfig=null)
    {
        $imageConfig = ($imageConfig ? $imageConfig : $this->imageConfig);

        $filename = $this->slugFilename($file);

        $img = \Image::make($file->getRealPath());

        foreach ($imageConfig as $size => $c) {

            $dir = public_path($this->getUploadPath($size));

            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
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
