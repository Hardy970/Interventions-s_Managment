<?php

use App\Models\Equipe;
use App\Models\Intervention;
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
        Schema::create('equipe_intervention', function (Blueprint $table) {
            $table->foreignIdFor(Intervention::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Equipe::class)->constrained()->cascadeOnDelete();
            $table->primary(['intervention_id','equipe_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipe_interventions');
    }
};
