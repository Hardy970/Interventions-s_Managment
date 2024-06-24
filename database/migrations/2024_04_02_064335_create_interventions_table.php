<?php

use App\Models\Chauffeur;
use App\Models\Demandeur;
use App\Models\FaitGenerateur;
use App\Models\Vehicule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->string('feedback')->nullable();
            $table->string('date_demande');
            $table->string('date_debut');
            $table->string('date_fin')->nullable();
            $table->time('h_depart_b');
            $table->time('h_arrivee_b');
            $table->time('h_arrivee_c')->nullable();
            $table->time('h_depart_c')->nullable();
            $table->string('travaux')->nullable();
            $table->boolean('statut_fact')->nullable();
            $table->boolean('est_vehicule_service')->nullable();
            $table->string('status')->default('Non commencée');
            $table->foreignIdFor(FaitGenerateur::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Vehicule::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Demandeur::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Chauffeur::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
