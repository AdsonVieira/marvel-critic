<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|max:255',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'O nome deve ser informado.',
            'name.max' => 'O nome ultrapassa o tamanho máximo de 255 caracteres.',
            'email.required' => 'O email deve ser informado.',
            'email.unique' => 'O email já está em uso.',
            'email.email' => 'O email não tem um formato correto.',
            'password.required' => 'A senha deve ser informada.',
            'password.max' => 'A senha ultrapassa o tamanho máximo de 255 caracteres.'
        ];
    }

    protected function failedValidation(Validator $validator){
        $errors = ['error' => $validator->errors()->first()];

        throw new HttpResponseException(
            response()->json($errors, 400)
        );
    }
}
