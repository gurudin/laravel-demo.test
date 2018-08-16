<?php

namespace App\Handlers;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;

class ImageHandler
{
    /**
     * Allow image type to upload.
     *
     * @var array
     */
    protected static $allowExt = [
        "png",
        "jpg",
        "gif",
        "jpeg",
    ];

    /**
     * Upload image.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param string $prefix
     *
     * @return array
     */
    public function upload(UploadedFile $file, $folder, $prefix, $max_width = false)
    {
        $folder   = 'uploads/images/' . $folder . '/' . date('Y/m/d');
        $ext      = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $filename = $prefix . '_' . UUID::generate() . '.' . $ext;

        if (! \in_array($ext, self::$allowExt, true)) {
            return false;
        }

        $file->move($folder, $filename);

        if ($max_width && $ext !== 'gif') {
            $this->reduceSize($folder . '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url') . '/' . $folder . '/' . $filename,
            'uri'  => '/' . $folder . '/' . $filename,
        ];
    }

    /**
     * Narrow size.
     *
     * @param string $path
     * @param int    $width
     *
     * @return void
     */
    public function reduceSize($path, $width)
    {
        $image = Image::make($path);
        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save();
    }
}