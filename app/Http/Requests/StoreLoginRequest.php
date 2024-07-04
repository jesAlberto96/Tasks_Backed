<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Controllers\ResponseController as Response;
use Illuminate\Contracts\Validation\Validator;

class StoreLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El campo Email es requerido!',
            'password.required' => 'El campo Contraseña es requerido!',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::sendError("Errores de validación", 406, $validator->errors()));
    }
}
