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
        Schema::create('bandeiras', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->unsignedBigInteger('grupo_economico_id'); 
            $table->timestamps();

            $table->foreign('grupo_economico_id')->references('id')->on('grupos_economicos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bandeiras');
    }
};
