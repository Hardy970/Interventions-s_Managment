<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChauffeurRequest extends FormRequest
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
        $id = $this->route('chauffeur') ? $this->route('chauffeur')->id : null;
        return [
            'nom'=>['required','string','unique:chauffeurs,nom,'.$id]
        ];
    }
    public function messages(): array
    {
        return [
            'nom.required' => 'Ce champ est requis.',
            'nom.unique' => 'Ce nom de chauffeur existe déjà',

        ];
    }
}
