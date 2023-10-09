<?php

use App\Models\Classe;
use App\Models\Professeur;
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
        Schema::create('professeurs_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Professeur::class)->constrained();
            $table->foreignIdFor(Classe::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professeurs_classes');
    }
};
