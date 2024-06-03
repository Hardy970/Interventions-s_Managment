<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'date_debut' => ['nullable', 'regex:/^(\d{2})\/(\d{2})\/(\d{4})$/'],
            'date_fin' => ['nullable', 'regex:/^(\d{2})\/(\d{2})\/(\d{4})$/'],
        ];
    }
    public function messages(): array
    {
        return [
            // 'date_debut.required' => 'Ce champ est requis.',
            // 'date_fin.required' => 'Ce champ est requis.',
            'date_debut.regex' => 'Ce champ doit être une date',
            'date_fin.regex' => 'Ce champ doit être une date',

        ];
    }
}
