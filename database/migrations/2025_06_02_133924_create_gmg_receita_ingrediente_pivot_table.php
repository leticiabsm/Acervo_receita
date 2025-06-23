<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('gmg_receita_ingrediente', function (Blueprint $table) {
            
            $table->unsignedInteger('idReceitas')->comment('ID da receita.');

            $table->unsignedSmallInteger('idIngrediente')->comment('ID do ingrediente.');

            
            $table->unsignedSmallInteger('idMedida')->comment('ID da medida (xícara, grama, etc.).'); 

            
            $table->decimal('quantidade', 9, 2)->comment('Quantidade do ingrediente para a receita.');
            $table->string('observacao', 255)->nullable()->comment('Observações sobre o ingrediente nesta receita.');

            // Chave primária composta
            $table->primary(['idReceitas', 'idIngrediente', 'idMedida'], 'pk_gmg_receita_ingrediente');

            // Definição das chaves estrangeiras
            $table->foreign('idReceitas')
                  ->references('idReceitas')->on('gmg_receitas')
                  ->onDelete('cascade')
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

    public function down(): void
    {
        Schema::dropIfExists('gmg_receita_ingrediente');
    }
};