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
        return [
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'integer'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Demandeur::class],
            'poste' => ['nullable', 'string', 'max:255'],
            'departement'=>['string','required'],
            'societe_id'=>['required','exists:societes,id']
        ];
    }
}
