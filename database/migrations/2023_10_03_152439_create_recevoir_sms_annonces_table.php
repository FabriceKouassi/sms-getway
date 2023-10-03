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
        Schema::create('recevoir_sms_annonces', function (Blueprint $table) {
            $table->id();
            $table->string('date_reception');

            $table->unsignedBigInteger('sms_id');
            $table->foreign('sms_id')
                    ->references('id')
                    ->on('sms')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')
                    ->references('id')
                    ->on('parents')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->unsignedBigInteger('annonce_id');
            $table->foreign('annonce_id')
                    ->references('id')
                    ->on('annonces')
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
        Schema::dropIfExists('recevoir_sms_annonces');
    }
};
