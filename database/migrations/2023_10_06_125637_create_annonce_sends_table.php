<?php

use App\Models\_Parent;
use App\Models\SMS;
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
        Schema::create('annonce_sends', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('details')->nullable();
            $table->integer('status')->default(0);
            $table->foreignIdFor(SMS::class, 'sms_id')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignIdFor(_Parent::class, 'parent_id')
                    ->constrained()
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
        Schema::dropIfExists('annonce_sends');
    }
};
