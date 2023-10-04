<?php

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
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('nom');
            $table->string('prenoms');
            $table->string('contact')->nullable();

            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')
                    ->references('id')
                    ->on('parents')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->unsignedBigInteger('classe_id');
            $table->foreign('classe_id')
                    ->references('id')
                    ->on('classes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};
