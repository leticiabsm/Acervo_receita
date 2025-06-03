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
        Schema::create('gmg_ingrediente_medida', function (Blueprint $table) {
            // Chave estrangeira para a tabela gmg_ingredientes
            // Usamos 'idIngrediente' como nome da coluna
            $table->foreignId('idIngrediente')->constrained('gmg_ingredientes', 'idIngrediente')->onDelete('cascade');

            // Chave estrangeira para a tabela gmg_medidas
            // Usamos 'idMedida' como nome da coluna
            $table->foreignId('idMedida')->constrained('gmg_medidas', 'idMedida')->onDelete('cascade');

            // Define as duas chaves estrangeiras como a chave primária composta
            $table->primary(['idIngrediente', 'idMedida']);

            // Adiciona colunas para a quantidade e observações específicas dessa relação
            // Por exemplo, "2" de "xícara" de "farinha"
            $table->decimal('quantidade', 8, 2)->nullable()->comment('Quantidade do ingrediente para esta medida específica.');
            $table->string('observacao', 255)->nullable()->comment('Observações específicas para esta combinação ingrediente-medida.');

            // Opcional: Adicionar timestamps para a tabela pivô
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_ingrediente_medida');
    }
};