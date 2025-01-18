<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email',
            'company_phone' => 'required|string|max:20',
            'company_address' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'maintenance_mode' => 'boolean',
            'maintenance_message' => 'required_if:maintenance_mode,1|string|nullable',
        ];
    }

    public function attributes()
    {
        return [
            'company_name' => 'اسم الشركة',
            'company_email' => 'البريد الإلكتروني',
            'company_phone' => 'رقم الهاتف',
            'company_address' => 'العنوان',
            'company_logo' => 'شعار الشركة',
            'maintenance_mode' => 'وضع الصيانة',
            'maintenance_message' => 'رسالة الصيانة',
        ];
    }
}