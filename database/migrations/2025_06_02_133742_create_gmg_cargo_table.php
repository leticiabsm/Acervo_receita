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
        Schema::create('gmg_cargo', function (Blueprint $table) {
            $table->smallIncrements('idCargo')->comment('Contém o identificador do cargo');
            $table->string('descricao', 45)->comment('Descrição dos cargos de funcionários.');
            $table->date('data_inicio')->comment('Contém a data de início do contrato de trabalho.');
            $table->date('data_fim')->nullable()->comment('Contém a data de Fim do contrato de trabalho.');
            $table->tinyInteger('ind_ativo')->comment('Contém o indicador (status) do cargo: 1 - ativo, 0 - inativo.');
            $table->string('nome', 45)->comment('Contém nome do cargo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_cargo');
    }
};