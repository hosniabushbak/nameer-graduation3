<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessOwnerResource extends JsonResource
{
    public function toArray($request)
    {
        $operations = view('admin.business_owners.sub.operations', ['instance' => $this])->render();
        $status = view('admin.business_owners.sub.active', ['instance' => $this])->render();

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email ?? '-',
            'phone'         => $this->phone,
            'id_number'     => $this->id_number,
            'business_info' => $this->business ? 'نوع النشاط: ' . $this->business->business_type : '-',
            'status'        => $status,
            'created_at'    => $this->created_at->format('Y-m-d'),
            'operations'    => $operations,
        ];
    }
}