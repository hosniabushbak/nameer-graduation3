<?php

namespace App\Http\Requests\Faqs;

use App\Http\Requests\BaseRequest;

class CreateFaqRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'question' => ['required', 'max:255'],
            'answer'   => ['required'],
            'status'   => ['nullable', 'boolean']
        ];
    }
}