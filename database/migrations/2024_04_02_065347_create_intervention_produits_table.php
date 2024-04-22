<?php

use App\Models\Intervention;
use App\Models\Produit;
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
        Schema::create('intervention_produit', function (Blueprint $table) {
            $table->foreignIdFor(Intervention::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Produit::class)->constrained()->cascadeOnDelete();
            $table->primary(['intervention_id','produit_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervention_produits');
    }
};
