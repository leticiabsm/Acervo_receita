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
            $table->smallIncrements('idIngrediente')->comment('Contém o identificador único do ingrediente.');
            $table->string('nome', 45)->comment('Contém o nome do ingrediente.');
            $table->string('descricao',1000)->nullable()->comment('Contém a descrição do ingrediente');
            $table->tinyInteger('ind_ativo')->comment(comment: 'Contém o indicador (status) do ingrediente: 1 - ativo, 0 - inativo.');
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