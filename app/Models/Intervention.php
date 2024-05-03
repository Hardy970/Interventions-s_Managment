<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;
    protected $fillable=[
        'feedback',
        'date_demande',
        'date_debut',
        'date_fin',
    	'h_depart_b',
    	'h_arrivee_b',
    	'h_arrivee_c',
    	'h_depart_c',
    	'travaux',
    	'statut_fact',
    	'est_vehicule_service',
    	'fait_generateur_id',
    	'vehicule_id',
    	'demandeur_id',
    	'chauffeur_id',
        'status'
    ];

    public function faitgenerateur()
    {

        return $this->belongsTo(FaitGenerateur::class);
    }
    public function vehicule()
    {

        return $this->belongsTo(Vehicule::class);
    }
    public function demandeur()
    {

        return $this->belongsTo(Demandeur::class);
    }
    public function chauffeur()
    {

        return $this->belongsTo(Chauffeur::class);
    }
    public function consultants()
    {

        return $this->belongsToMany(User::class);
    }
    public function produits()
    {

        return $this->belongsToMany(Produit::class);
    }
    public function typesdemandes()
    {

        return $this->belongsToMany(TypeDemande::class);
    }
    public function typesinterventions()
    {

        return $this->belongsToMany(TypeIntervention::class);
    }
    public function equipes()
    {

        return $this->belongsToMany(Equipe::class);
    }

}
