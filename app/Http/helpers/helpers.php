<?php

use App\Logics\ImageLogic;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

function admin()
{
    if (auth()->guard('admin')->check()) {
        return auth()->guard('admin')->user();
    }
}

function file_url($img, $size = '')
{
    return (!empty($size)) ? (env('APP_URL') . '/storage/files/' . $size . '/' . $img) : (env('APP_URL') . '/storage/files/' . $img);

}

// function uploadImage($img, $type = null, $owner_id = null, $owner_type = null)
// {
//     if (!$img->getClientOriginalExtension()) {
//         return null;
//     }
//     $extension = $img->getClientOriginalExtension();

//     $filename = 'image_' . time() . mt_rand();
//     $repo = new ImageLogic();

//     $allowed_filename = $repo->createUniqueFilename($filename, $extension);

//     $uploadSuccess = $repo->original($img, $allowed_filename);

//     $originalName = str_replace('.' . $extension, '', $img->getClientOriginalName());

//     $image = new Image();
//     $image->display_name = $originalName . '.' . $extension;
//     $image->file_name = $allowed_filename;
//     $image->mime_type = $extension;
//     $image->size = $img->getSize();
//     $image->owner_id = $owner_id;
//     $image->owner_type = $owner_type;
//     $image->save();
//     $url = $image->file_name;

//     return $url;
// }

function locales()
{
    return ['ar', 'en'];
}

function checkNull($key_name)
{
    return request()->has($key_name) && request()->$key_name != null && request()->$key_name != '';
}

function errorResponse($message)
{
    $array = [
        'status' => false,
        'message' => $message,
        'data' => null,
    ];
    return response($array, 200);
}

function timeFormat($from_date)
{
    return \Carbon\Carbon::parse($from_date)->format('d-m-Y');
}

function inputTimeFormat($from_date)
{
    return \Carbon\Carbon::parse($from_date)->format('Y-m-d');
}

function containsOnlyNull($input)
{
    return empty(array_filter($input, function ($a) {
        return $a !== null;
    }));
}
