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
        Schema::create('gmg_medidas', function (Blueprint $table) {
            $table->smallIncrements('idMedida')->comment('Contém o identificador único da medida. Ex: 01, 02.');
            $table->string('item', 45)->comment('Contém o nome do item de medida. Ex: xícara, grama.');
            $table->string('tipo', 45)->comment('Contém o tipo da medida. Ex: sólido, líquido.');
            $table->string('descricao', 45)->nullable()->comment('Descrição opcional da medida.'); // adicionado
            $table->string('simbolo', 10)->nullable()->comment('Contém o símbolo da medida. Ex: g, ml, xic.');
            $table->tinyInteger('ind_ativo')->comment('Contém o indicador (status) da medida: 1 - ativo, 0 - inativo.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_medidas');
    }
};
