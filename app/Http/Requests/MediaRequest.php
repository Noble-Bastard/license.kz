<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }


    public function rules() : array
    {
        $rules = [

        ];

        switch ($this->getMethod()) {
            case 'POST':
                return[
                        'id' => 'nullable|exists:news,id',
                        'header' => 'required|max:85',
                        'lead' => 'required|max:350',
                        'content' => 'required',
                        'tags' => 'required',
                        'start_date' => 'required',
                        'language_code' => 'required',
                        'country_code' => 'required',
                        'content_type_id' => 'required|min:1|exists:news_content_type,id',
                        'main_image_path' => ''
                    ] + $rules;
            case 'PUT':
                return [
                        'id' => 'required|exists:news,id',
                        'is_actual' => '',
                    ] + $rules;
        }

        return $rules;
    }
}
