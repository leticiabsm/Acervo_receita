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
            $table->smallIncrements('id_cat')->comment('Identificador único da categoria.');
            $table->string('nome_cat', 45)->comment('Nome da categoria. Ex: Massas, Bolos.');
            $table->string('desc', 45)->nullable()->comment('Descrição da categoria.');
            $table->date('dt_fim_cat')->nullable()->comment('Data de fim da categoria.');
            $table->dateTime('dt_ini_cat')->comment('Data de início da categoria.');
            $table->tinyInteger('ind_ativo')->comment('Indicador de status: 1 - ativo, 0 - inativo.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_categoria');
    }
};
