<?php

namespace App\Http\Controllers;

use App\Logics\FileLogic;
use App\Models\File;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public $guard_name;

    public function __construct()
    {
        // dd(Auth::guard()->name);
        // $this->middleware(function ($request, $next) {
        //     $this->guard_name = Auth::guard()->name;
        //     return $next($request);
        // });
    }

    public function lang() {
        $lang = app()->getLocale();

        if ($lang !== LaravelLocalization::getCurrentLocale()) {
            app()->setLocale(LaravelLocalization::getCurrentLocale());
        }

        return $lang;
    }

    public function response_api($status, $message, $items = null)
    {
        $response = ['status' => $status, 'message' => $message];
        if ($status && isset($items)) {
            $response['item'] = $items;
        } else {
            $response['errors_object'] = $items;
        }
        return response()->json($response);
    }


    public function filterDataTable($items, $request,$take = null,$resource = null)
    {
        if ($items->count() <= 0) {
            $data['recordsTotal'] = 0;
            $data['recordsFiltered'] = 0;
            $data['data'] = [];
            return $data;
        }

        if (!$resource) {
            $resource = $items->first()->resource;
        }

        if (isset($take)) {
            $items = $items->take($take)->get();
            $data = $resource->collection($items);
            return $data;
        }
        $per_page = isset($request->length) ? $request->length : 10;
        $page = isset($request->start) ? $request->start : 1;
        if ($per_page == -1 || $per_page == null) {
            $per_page = 10;
        }
        $itemsCount = $items->count();
        $items = $items->take($per_page)->skip($page)->get();
        $data['recordsTotal'] = $itemsCount;
        $data['recordsFiltered'] = $itemsCount;
        $data['data'] = $resource::collection($items);
        return $data;
    }

    function exMessage($e)
    {
        if (env('APP_ENV')  == 'production') {
            return __('admin.form.some_errors');
        } else {
            return $e->getMessage();
        }
    }

    public function sendResponse($result, $message)
    {
        $main_response = [
            'code' => 200,
            'success' => true,
            'message' => $message,
        ];

        if($result !== null){
            $data = [
                'data' => $result
            ];
        }else{
            $data = [];
        }

        $response = array_merge($main_response, $data);

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'code' => 400,
            'success' => false,
            'message' => $error
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);

    }

    function uploadFile($img, $type = null, $owner_id = null, $owner_type = null)
    {
        if (!$img->getClientOriginalExtension()) {
            return null;
        }
        $extension = $img->getClientOriginalExtension();

        $filename = 'file_' . time() . mt_rand();
        $repo = new FileLogic();

        $allowed_filename = $repo->createUniqueFilename($filename, $extension);

        $uploadSuccess = $repo->original($img, $allowed_filename);

        $originalName = str_replace('.' . $extension, '', $img->getClientOriginalName());

        $file = new File();
        $file->display_name = $originalName . '.' . $extension;
        $file->file_name = $allowed_filename;
        $file->mime_type = $extension;
        $file->size = $img->getSize();
        $file->owner_id = $owner_id;
        $file->owner_type = $owner_type;
        $file->save();
        $url = $file->file_name;

        return $url;
    }


}

