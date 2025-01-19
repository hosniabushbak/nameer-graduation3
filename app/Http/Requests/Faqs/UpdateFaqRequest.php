<?php

namespace App\Http\Requests\Faqs;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class UpdateFaqRequest extends BaseRequest
{
    public function rules(Request $request)
    {
        return [
            'question' => ['required', 'max:255'],
            'answer'   => ['required'],
            'status'   => ['nullable', 'boolean']
        ];
    }
}