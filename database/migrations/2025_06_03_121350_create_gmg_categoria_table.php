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
        Schema::create('gmg_categoria', function (Blueprint $table) {
            $table->smallIncrements('idCategoria')->comment('Contém o identificador único da categoria.');
            $table->string('nome_categoria', 45)->comment('Contém o nome da categoria da receita. Ex: Massas, Bolos.');
            $table->date('data_fim_categoria')->comment('Contém a data fim de uma categoria.');
            $table->string('descricao',45)->comment('Contém a descrição da categoria');
            $table->tinyInteger('ind_ativo')->comment('Contém o indicador (status) da categoria: 1 - ativo, 0 - inativo.');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_categorias');
    }
};