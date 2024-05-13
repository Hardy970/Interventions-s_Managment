<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieRequest extends FormRequest
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
        $id = $this->route('categorie') ? $this->route('categorie')->id : null;
        return [
            'libelle'=>['required','string','unique:categories,libelle,'.$id]
        ];
    }
    public function messages(): array
    {
        return [
            'libelle.required' => 'Ce champ est requis.',
            'libelle.unique' => 'Cette catégorie existe déjà',

        ];
    }

}
