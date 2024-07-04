<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Controllers\ResponseController as Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'date_expired' => 'required|date_format:Y-m-d',
            'completed' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El campo titulo es requerido!',
            'date_expired.required' => 'El campo fecha de vencimiento es requerido!',
            'date_expired.date_format' => 'El campo fecha de vencimiento tiene un formato invalido, debe ser yyyy-mm-dd.',
            'completed.required' => 'El campo tarea completada es requerido!',
            'completed.boolean' => 'El campo tarea completada tiene un formato invalido!',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::sendError("Errores de validación", 406, $validator->errors()));
    }
}
