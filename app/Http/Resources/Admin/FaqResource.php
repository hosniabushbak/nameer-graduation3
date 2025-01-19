<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    public function toArray(Request $request)
    {
        $operations = view('admin.faqs.sub.operations', ['instance' => $this])->render();
        $status = view('admin.faqs.sub.active', ['instance' => $this])->render();

        return [
            'id'         => $this->id,
            'question'   => $this->question,
            'answer'     => $this->answer,
            'status'     => $status,
            'operations' => $operations,
        ];
    }
}