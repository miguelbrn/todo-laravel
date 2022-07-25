<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'name' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O :attribute da tarefa é obrigatório',
            'name.min' => 'O :attribute da tarefa deve ter no mínimo 2 caracteres'
        ];
    }
}
