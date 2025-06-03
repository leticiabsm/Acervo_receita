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
        Schema::create('gmg_ingredientes', function (Blueprint $table) {
            $table->id('idIngrediente');
            // Adicionando unique() ao campo nome
            $table->string('nome', 45)->unique()->comment('Contém o nome único do ingrediente utilizado nas receitas.');
            $table->text('descricao')->nullable()->comment('Contém a descrição detalhada de alguns ingredientes especiais.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_ingredientes');
    }
};