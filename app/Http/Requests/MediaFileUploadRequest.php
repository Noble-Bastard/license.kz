<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaFileUploadRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:16384',
            'directory' => 'required',
        ];
    }
}
