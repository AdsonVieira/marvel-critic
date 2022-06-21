<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name' => 'required',
            'synopsis' => 'required',
            'thumbnail_url' => 'required|max:255',
        ];

    }

    public function messages() : array
    {
        return [
            'name.required' => 'O nome do filme deve ser informado.',
            'synopsis.required' => 'O sinopse do filme deve ser informado.',
            'thumbnail_url.required' => 'A url dathumbnail do filme deve ser informada.',
            'thumbnail_url.max' => 'A url dathumbnail do filme tem o tamanho máximo de 255 caracteres.'
        ];
    }

    protected function failedValidation(Validator $validator){
        $error = ['error' => $validator->errors()->first()];

        throw new HttpResponseException(
            response()->json($error, 400)
        );
    }
}
