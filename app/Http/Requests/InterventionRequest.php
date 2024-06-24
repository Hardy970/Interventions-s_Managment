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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $timeRegex = '/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';
        return [
        'date_demande'=>['required', 'regex:/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{4})$/'],
        'date_debut'=>['required', 'regex:/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{4})$/'],
        'date_fin'=>['required', 'regex:/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{4})$/'],        
    	'h_depart_b'=>['regex:'.$timeRegex,'required'],
    	'h_arrivee_b'=>['regex:'.$timeRegex,'required'],
    	'h_arrivee_c'=>['regex:'.$timeRegex,'required'],
    	'h_depart_c'=>['regex:'.$timeRegex,'required'],
    	'travaux'=>['required','string'],
    	'statut_fact'=>['in:0,1','required'],
    	'est_vehicule_service'=>['in:0,1','required'],
    	'fait_generateur_id'=>['exists:fait_generateurs,id','required'],
    	'vehicule_id'=>['nullable','exists:vehicules,id'],
    	'demandeur_id'=>['exists:demandeurs,id','required'],
    	'chauffeur_id'=>['nullable','exists:chauffeurs,id'],
        'produits'=>['required','exists:produits,id','array'],
        'typesdemandes'=>['required','exists:type_demandes,id','array'],
        'typesinterventions'=>['required','exists:type_interventions,id','array'],
        'consultants'=>['required','exists:users,id','array'],

        ];
    }
    public function messages(): array
    {
        return [
            'feedback.required' => 'Ce champ est requis.',
            'date_demande.required' => 'Ce champ est requis.',
            'date_debut.required' => 'Ce champ est requis.',
            'date_fin.required' => 'Ce champ est requis.',
            'h_depart_b.required' => 'Ce champ est requis.',
            'h_arrivee_b.required' => 'Ce champ est requis.',
            'h_arrivee_c.required' => 'Ce champ est requis.',
            'h_depart_c.required' => 'Ce champ est requis.',
            'travaux.required' => 'Ce champ est requis.',
            'statut_fact.required' => 'Ce choix est important',
            'est_vehicule_service.required' => 'Ce choix est important.',
            'fait_generateur_id.required' => 'Ce champ est requis.',
            'fait_generateur_id.exists' => 'Ce champ est requis',
            'vehicule_id.exists' => 'Ce champ est requis',
            'vehicule_id.required' => 'Ce champ est requis',
            'chauffeur_id.required' => 'Ce champ est requis',
            'chauffeur_id.exists' => 'Ce champ est requis',
            'demandeur_id.required' => 'Ce champ est requis.',
            'demandeur_id.exists' => 'Ce champ est requis.',
            'produits.required' => 'Ce champ est requis.',
            'typesdemandes.required' => 'Ce champ est requis.',
            'typesinterventions.required' => 'Ce champ est requis.',
            'consultants.required' => 'Ce champ est requis.',
            'date_debut.regex' => 'Ce champ doit être une date',
            'date_demande.regex' => 'Ce champ doit être une date',
            'date_fin.regex' => 'Ce champ doit être une date',
            'h_depart_b.regex' => 'Entrez une heure valable',
            'h_depart_c.regex' => 'Entrez une heure valable',
            'h_arrivee_b.regex' => 'Entrez une heure valable',
            'h_arrivee_c.regex' => 'Entrez une heure valable',

        ];
    }
}
