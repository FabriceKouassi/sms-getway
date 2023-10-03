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
        Schema::create('recevoir_sms_absences', function (Blueprint $table) {
            $table->id();

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

            $table->unsignedBigInteger('absence_id');
            $table->foreign('absence_id')
                    ->references('id')
                    ->on('absences')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->string('date_reception');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recevoir_sms_absences');
    }
};
