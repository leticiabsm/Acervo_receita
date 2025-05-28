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
            // idMedida como chave primária, auto-incremento (BIGINT por padrão do Laravel)
            $table->id('idMedida');

            // 'tipo' para indicar a medida (ml, kg, xícara, etc.)
            $table->string('tipo', 45)->comment('Contém o tipo de medida (ex: ml, kg, xícara).');

            // 'item' para indicar o tamanho (grande, médio, pequeno)
            $table->string('item', 45)->comment('Contém o tamanho da medida (ex: grande, médio, pequeno).');

            // 'descricao' para a quantidade (como você mencionou agora)
            $table->string('descricao', 20)->comment('Contém a quantidade/descrição da medida (ex: 200, 100g, 1 xícara).');

            // Colunas de timestamp (created_at, updated_at)
            $table->timestamps();
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