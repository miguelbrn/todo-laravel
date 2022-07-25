<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O :attribute de usuário é obrigatório',
            'name.min' => 'O :attribute de usuário deve ter no mínimo 2 caracteres',
            'email.required' => 'O :attribute de usuário é obrigatório',
            'email.email' => 'O :attribute de usuário deve ser um e-mail válido',
            'email.max' => 'O :attribute de usuário deve ter no máximo 255 caracteres',
            'email.unique' => 'O :attribute de usuário já está cadastrado',
            'password.required' => 'O :attribute de usuário é obrigatório',
            'password.min' => 'O :attribute de usuário deve ter no mínimo 6 caracteres',
        ];
    }
}
