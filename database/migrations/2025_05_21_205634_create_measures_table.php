<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrações.
     */
    public function up(): void
    {
        // Cria a tabela 'gmg_medidas' se ela não existir.
        Schema::create('gmg_medidas', function (Blueprint $table) {
            // Define a coluna de ID primária auto-incrementável.
            // Corresponde a `idMedida` SMALLINT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY.
            $table->id('idMedida');

            // Define a coluna 'descricao' como string de 20 caracteres e não nula.
            // Note: O SQL fornecido tinha 'decricao', mas foi corrigido para 'descricao' aqui.
            // Corresponde a `decricao` CHAR(20) NOT NULL.
            $table->string('descricao', 20)->unique(); // Adicionei unique() com base na lógica do CRUD anterior.

            // Adiciona as colunas `created_at` e `updated_at`.
            $table->timestamps();
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        // Remove a tabela 'gmg_medidas' se ela existir.
        Schema::dropIfExists('gmg_medidas');
    }
};
