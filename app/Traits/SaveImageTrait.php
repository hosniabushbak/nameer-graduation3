<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait SaveImageTrait
{

    protected function uploadImage($file, $path = '')
    {
        $file_exe = $file->getClientOriginalExtension();
        $new_name = uniqid() . '.' . $file_exe;
        $directory = 'uploads' . '/' . 'images' . '/' . $path;
        $destienation = public_path($directory);
        $file->move($destienation, $new_name);
        return '/' . $directory . '/' . $new_name;
    }
}
