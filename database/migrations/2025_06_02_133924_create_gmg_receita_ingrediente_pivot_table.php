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
        Schema::create('gmg_receita_ingrediente', function (Blueprint $table) {
            // Chaves Estrangeiras (partes da chave primária composta)
            $table->unsignedInteger('idReceitas')->comment('ID da receita.'); // unsignedInteger para corresponder a increments() de gmg_receitas

            // AQUI ESTÁ A NOVA MUDANÇA IMPORTANTE
            // Deve ser unsignedSmallInteger() para corresponder a smallIncrements() de gmg_ingredientes
            $table->unsignedSmallInteger('idIngrediente')->comment('ID do ingrediente.');

            // Também verifique esta, se ainda não foi corrigida
            $table->unsignedSmallInteger('idMedida')->comment('ID da medida (xícara, grama, etc.).'); // smallInteger para corresponder a smallIncrements() de gmg_medidas

            // Colunas adicionais para a tabela pivô
            $table->decimal('quantidade', 9, 2)->comment('Quantidade do ingrediente para a receita.');
            $table->string('observacao', 255)->nullable()->comment('Observações sobre o ingrediente nesta receita.');

            // Chave primária composta
            $table->primary(['idReceitas', 'idIngrediente', 'idMedida'], 'pk_gmg_receita_ingrediente');

            // Definição das chaves estrangeiras
            $table->foreign('idReceitas')
                  ->references('idReceitas')->on('gmg_receitas')
                  ->onDelete('cascade') // Se a receita for excluída, remove os registros pivô associados
                  ->onUpdate('no action');

            $table->foreign('idIngrediente')
                  ->references('idIngrediente')->on('gmg_ingredientes')
                  ->onDelete('no action')
                  ->onUpdate('no action');

            $table->foreign('idMedida')
                  ->references('idMedida')->on('gmg_medidas')
                  ->onDelete('no action')
                  ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_receita_ingrediente');
    }
};