<?php

namespace App\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUpload {
    const DISK = 'public';

    public function upload(UploadedFile $file, $path = 'avatars', $maxWidth = null)
    {
        $lastPath = date('Y') . '/' . date('m') . '/' . date('d');
        $filePath = $path . '/' . $lastPath;
        $ext = $file->guessExtension();
        $fileName = date('H_i_s') . '_' . Str::random(40) . '.' . $ext;
        $shortPath = $file->storeAs($filePath, $fileName, self::DISK);
        if($maxWidth && $ext !== 'gif') {
            $imgPath = Storage::disk(self::DISK)->path($shortPath);
            $this->resize($imgPath, $maxWidth);
        }
        return $shortPath;
    }

    public function getFullUrl($shortPath)
    {
        if(filter_var($shortPath, FILTER_VALIDATE_URL) !== false) {
            return $shortPath;
        }
        return Storage::disk(self::DISK)->url($shortPath);
    }

    protected function resize($imgPath, $width)
    {
        $img = Image::make($imgPath);
        $img->resize($width, null, function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->save();
    }
}
