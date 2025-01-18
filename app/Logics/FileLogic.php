<?php

namespace App\Logics;

use Illuminate\Support\Facades\File;

class FileLogic
{

    private $full_save_path = 'public/files';
    private $save_path = 'public/files';

    public function createUniqueFilename($filename, $extension)
    {
        $path = storage_path($this->full_save_path . $filename . '.' . $extension);
        if (File::exists($path)) {
            $fileToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $fileToken . '.' . $extension;
        }
        return $filename . '.' . $extension;
    }

    public function original($photo, $filename)
    {
        $file = $photo->storeAs($this->save_path, $filename);
        return $file;
    }

}
