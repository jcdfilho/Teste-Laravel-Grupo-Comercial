<?php
// filepath: /c:/Users/default.LAPTOP-8M1BMQBO/Documents/Projetos/teste-laravel/database/migrations/2025_02_08_054256_create_grupos_economicos_table.php

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
        Schema::create('grupos_economicos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grupos_economicos');
    }
};