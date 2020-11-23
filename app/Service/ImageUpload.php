<?php

namespace App\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUpload {
    const DISK = 'public';

    public function upload(UploadedFile $file, $path = 'avatars')
    {
        $lastPath = date('Y') . '/' . date('m') . '/' . date('d');
        $filePath = $path . '/' . $lastPath;
        $fileName = date('H_i_s') . '_' . Str::random(40) . '.' . $file->guessExtension();
        return $file->storeAs($filePath, $fileName, self::DISK);
    }
}
