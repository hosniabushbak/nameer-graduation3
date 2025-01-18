<?php

namespace App\Http\Requests\Owner;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateOwnerRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:owners,email,' . $this->route('owner')],
            'phone'     => ['required', 'string', 'max:20'],
            'id_number' => ['required', 'string', 'max:20', 'unique:owners,id_number,' . $this->route('owner')],
            'address'   => ['required', 'string', 'max:500'],
            'status'    => ['nullable', 'in:0,1'],
        ];
    }
}