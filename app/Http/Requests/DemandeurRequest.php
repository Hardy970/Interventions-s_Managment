<?php

namespace App\Http\Requests;

use App\Models\Demandeur;
use Illuminate\Foundation\Http\FormRequest;

class DemandeurRequest extends FormRequest
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
        $id = $this->route('demandeur') ? $this->route('demandeur')->id : null;
        return [
            'nom' => ['required', 'string', 'max:255','unique:demandeurs,nom,'.$id],
            'telephone' => ['nullable','integer'],
            'email' => [ 'nullable','string', 'lowercase', 'email', 'max:255', 'unique:demandeurs,email,'.$id],
            'poste' => ['required', 'string', 'max:255'],
            'departement'=>['nullable','string'],
            'societe_id'=>['required','exists:societes,id']
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
