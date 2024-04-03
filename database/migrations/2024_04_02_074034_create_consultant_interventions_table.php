<?php

use App\Models\Consultant;
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
        Schema::create('consultant_interventions', function (Blueprint $table) {
            $table->foreignIdFor(Intervention::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Consultant::class)->constrained()->cascadeOnDelete();
            $table->primary(['intervention_id','consultant_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultant_interventions');
    }
};
