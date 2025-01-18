<?php

namespace App\Http\Requests\HouseOwner;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateHouseOwnerRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:owners,email'],
            'phone'     => ['required', 'string', 'max:20'],
            'id_number' => ['required', 'string', 'max:20', 'unique:owners,id_number'],
            'address'   => ['required', 'string', 'max:500'],
            'status'    => ['nullable', 'in:0,1'],

            // بيانات المنزل
            'house.ownership_type'      => ['required', 'string', 'max:255'],
            'house.land_area'          => ['required', 'numeric'],
            'house.building_area'      => ['required', 'numeric'],
            'house.floors_count'       => ['required', 'integer'],
            'house.rooms_count'        => ['required', 'integer'],
            'house.building_age'       => ['required', 'integer'],
            'house.damage_level'       => ['required', 'string', 'max:255'],
            'house.damage_description' => ['required', 'string'],
            'house.damage_photos'      => ['required', 'array'],
            'house.damage_photos.*'    => ['image', 'mimes:jpeg,png,jpg'],
            'house.estimated_cost'     => ['required', 'numeric'],
            'house.ownership_document' => ['required', 'file', 'mimes:pdf,jpeg,png,jpg'],
            'house.inspection_report'  => ['required', 'file', 'mimes:pdf'],
        ];
    }
}