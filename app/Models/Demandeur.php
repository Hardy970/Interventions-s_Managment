<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demandeur extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom',
        'email',
        'telephone',
        'departement',
        'poste',
        'societe_id'
    ];
    public function societe(){
        return $this->belongsTo(Societe::class);
    }
    public function interventions(){
        return $this->hasMany(Intervention::class);
    }
}
