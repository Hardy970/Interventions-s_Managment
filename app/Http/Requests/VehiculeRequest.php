<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculeRequest extends FormRequest
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
        $id = $this->route('vehicule') ? $this->route('vehicule')->id : null;
        return [
            'matricule'=>['required','string','unique:vehicules,matricule,'.$id],
            'marque'=>['required','string']
        ];
    }
    public function messages(): array
    {
        return [
            'matricule.required' => 'Ce champ est requis.',
            'marque.required' => 'Ce champ est requis.',
            'matricule.unique' => 'Ce matricule est déjà utilisé',

        ];
    }
}
