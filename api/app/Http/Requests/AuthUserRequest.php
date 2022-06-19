<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|max:255',
        ];

    }

    public function messages() : array
    {
        return [
            'email.required' => 'O email deve ser informado.',
            'email.email' => 'O email não tem um formato correto.',
            'password.required' => 'A senha deve ser informada.',
            'password.max' => 'A senha ultrapassa o tamanho máximo de 255 caracteres.'
        ];
    }

    protected function failedValidation(Validator $validator){
        $errors = ['errors' => [$validator->errors()]];

        throw new HttpResponseException(
            response()->json($errors, 400)
        );
    }
}
