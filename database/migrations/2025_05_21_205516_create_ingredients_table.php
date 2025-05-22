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
        // Cria a tabela 'gmg_ingredientes' se ela não existir.
        Schema::create('gmg_ingredientes', function (Blueprint $table) {
            // Define a coluna de ID primária auto-incrementável.
            // Corresponde a `idIngrediente` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY.
            $table->id('idIngrediente');

            // Define a coluna 'nome' como string de 45 caracteres, não nula e única.
            // Corresponde a `nome` VARCHAR(45) NOT NULL.
            $table->string('nome', 45)->unique();

            // Define a coluna 'descricao' como string de 1000 caracteres, permitindo nulos.
            // Corresponde a `descricao` VARCHAR(1000) NULL DEFAULT NULL.
            $table->string('descricao', 1000)->nullable();

            // Adiciona as colunas `created_at` e `updated_at`.
            $table->timestamps();
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        // Remove a tabela 'gmg_ingredientes' se ela existir.
        Schema::dropIfExists('gmg_ingredientes');
    }
};