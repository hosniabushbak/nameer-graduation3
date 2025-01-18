<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseOwnerResource extends JsonResource
{
    public function toArray(Request $request)
    {
        $operations = view('admin.house_owners.sub.operations', ['instance' => $this])->render();
        $status = view('admin.house_owners.sub.active', ['instance' => $this])->render();

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email ?? '-',
            'phone'         => $this->phone,
            'id_number'     => $this->id_number,
            'property_info' => $this->house ? 'مساحة: ' . $this->house->building_area . ' متر' : '-',
            'status'        => $status,
            'created_at'    => $this->created_at->format('Y-m-d'),
            'operations'    => $operations,
        ];
    }
}