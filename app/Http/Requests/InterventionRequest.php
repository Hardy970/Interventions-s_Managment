<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterventionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('intervention') ? $this->route('intervention')->id : null;
        return [
            //
        ];
    }
    public function messages(): array
    {
        return [
            'nom.required' => 'Ce champ est requis.',
            'poste.required' => 'Ce champ est requis.',
            'societe_id.required' => 'Ce champ est requis.',
            'nom.unique' => 'Ce nom de demandeur existe déjà',
            'email.unique' => 'Adresse email déjà utilisée',
            'telephone.integer'=>'Ce champ doit être un entier'

        ];
    }
}
