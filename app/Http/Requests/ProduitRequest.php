<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitRequest extends FormRequest
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
        $id = $this->route('produit') ? $this->route('produit')->id : null;
        return [
            'libelle'=>['required','string','unique:produits,libelle,'.$id],
            'categorie_id'=>['required','exists:categories,id']
        ];
    }
    public function messages(): array
    {
        return [
            'libelle.required' => 'Ce champ est requis.',
            'categorie_id.required' => 'Ce champ est requis.',
            'libelle.unique' => 'Ce produit existe déjà',

        ];
    }
}
