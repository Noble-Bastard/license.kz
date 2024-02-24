<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UploadFileResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'file_path' => $this->filePath,
        ];
    }
}
