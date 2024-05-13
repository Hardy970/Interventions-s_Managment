<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocieteRequest extends FormRequest
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
        $id = $this->route('societe') ? $this->route('societe')->id : null;
        return [
            'nom' => ['required', 'string', 'max:255','unique:societes,nom,'.$id],
            'telephone' => ['nullable','integer'],
            'email' => [ 'nullable','string', 'lowercase', 'email', 'max:255', 'unique:societes,email,'.$id],
            'localite'=>['nullable','string']
        ];
    }
    public function messages(): array
    {
        return [
            'nom.required' => 'Ce champ est requis.',
            'nom.unique' => 'Cette société existe déjà',
            'email.unique' => 'Adresse email déjà utilisée',
            'telephone.integer'=>'Ce champ doit être un entier'

        ];
    }
}
