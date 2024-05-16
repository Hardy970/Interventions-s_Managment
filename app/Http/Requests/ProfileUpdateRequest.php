<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'equipe_id'=>['required','exists:equipes,id']
        ];
    }
    public function messages(): array
    {
        return [
            'last_name.required' => 'Ce champ est requis.',
            'first_name.required' => 'Ce champ est requis.',
            'equipe_id.required' => 'Ce champ est requis.',
            'equipe_id.exists' => 'Veuillez séléctionner une équipe',
            'email.required' => 'Ce champ est requis.',
            'email.unique' => 'Cette adresse email est déjà utilisée',

        ];
    }
}
