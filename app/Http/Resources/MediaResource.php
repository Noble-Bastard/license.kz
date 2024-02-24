<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'create_date' => $this->create_date,
            'is_actual' => $this->is_actual,
        ];
    }
}
