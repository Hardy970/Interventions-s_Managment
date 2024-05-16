<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Societe;
use App\Models\Categorie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Chauffeur;
use App\Models\Demandeur;
use App\Models\Equipe;
use App\Models\FaitGenerateur;
use App\Models\Produit;
use App\Models\TypeDemande;
use App\Models\TypeIntervention;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Societe::create([
            'nom'=>'SAB'
        ]);
        Societe::create([
            'nom'=>'CDCB'
        ]);
        Categorie::create([
            'libelle'=>'Logiciel'
        ]);
        Categorie::create([
            'libelle'=>'Matériel'
        ]);
        Chauffeur::create([
            'nom'=>'Jean'
        ]);
        Chauffeur::create([
            'nom'=>'Claude'
        ]);
        Demandeur::create([
            'nom'=>'Carlos',
            'poste'=>'Informaticien',
            'societe_id'=>1
        ]);
        Demandeur::create([
            'nom'=>'Junior',
            'poste'=>'Informaticien',
            'societe_id'=>2
        ]);
        Equipe::create([
            'nom'=>'Sage FRP1000'
        ]);
        Equipe::create([
            'nom'=>'Sage 100'
        ]);
        Equipe::create([
            'nom'=>'Odoo & Dev'
        ]);
        Equipe::create([
            'nom'=>'Kelio'
        ]);
        Equipe::create([
            'nom'=>'Sage Paie&RH'
        ]);
        FaitGenerateur::create([
            'libelle'=>'E-mail'
        ]);
        FaitGenerateur::create([
            'libelle'=>'Appel téléphonique'
        ]);
        FaitGenerateur::create([
            'libelle'=>'Rendez-vous'
        ]);
        Produit::create([
            'libelle'=>'Sage FRP 1000',
            'categorie_id'=>1
        ]);
        Produit::create([
            'libelle'=>'Sage 100',
            'categorie_id'=>1
        ]);
        Produit::create([
            'libelle'=>'Odoo',
            'categorie_id'=>1
        ]);
        Produit::create([
            'libelle'=>'Sage Paie',
            'categorie_id'=>1
        ]);
        Produit::create([
            'libelle'=>'Sage 50',
            'categorie_id'=>1
        ]);
        Produit::create([
            'libelle'=>'Bodet & Kelio',
            'categorie_id'=>2
        ]);
        Produit::create([
            'libelle'=>'Câblage & Réseaux',
            'categorie_id'=>2
        ]);
        Produit::create([
            'libelle'=>'G&V électrique',
            'categorie_id'=>2
        ]);
        TypeDemande::create([
            'libelle'=>'Formation',
        ]);
        TypeDemande::create([
            'libelle'=>'Technique',
        ]);
        TypeDemande::create([
            'libelle'=>'Conseil',
        ]);
        TypeIntervention::create([
            'libelle'=>'Installation',
        ]);
        TypeIntervention::create([
            'libelle'=>'Formation',
        ]);
        TypeIntervention::create([
            'libelle'=>'Réseaux & connectivité',
        ]);
        TypeIntervention::create([
            'libelle'=>'Configuration',
        ]);
        TypeIntervention::create([
            'libelle'=>'Développement',
        ]);
        
        Role::create([
            'libelle'=>'admin'
        ]);
        Role::create([
            'libelle'=>'consultant'
        ]);

        User::factory()->create([
            'first_name' => 'Hardy',
            'last_name' => 'ADIMOU',
            'role_id'=>1,
            'email' => 'hardyadimou2005@gmail.com',
            'password'=>Hash::make('00000000')
        ]);
        User::factory()->create([
            'first_name' => 'Zariath',
            'last_name' => 'AROUNA',
            'role_id'=>2,
            'email' => 'zouzou@gmail.com',
            'password'=>Hash::make('00000000')
        ]);
        User::factory()->create([
            'first_name' => 'Marley',
            'last_name' => 'BOB',
            'role_id'=>2,
            'email' => 'bob@gmail.com',
            'password'=>Hash::make('00000000')
        ]);
        User::factory()->create([
            'first_name' => 'Jef',
            'last_name' => 'HARDY',
            'role_id'=>2,
            'email' => 'jef@gmail.com',
            'password'=>Hash::make('00000000')
        ]);
    }
}
