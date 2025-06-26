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
        Schema::create('gmg_degustacao', function (Blueprint $table) {
            $table->id('idDesgustacao');
            $table->unsignedBigInteger('FKReceita');      // FK para receitas
            $table->unsignedBigInteger('FK_degustador');  // FK para degustador (funcionario)
            $table->unsignedBigInteger('FKcozinheiro');   // FK para cozinheiro (funcionario)
            $table->decimal('nota_degustacao', 4, 2)->nullable();
            $table->date('data_degustacao')->nullable();
            $table->text('descricao');

            $table->unique(['FKReceita', 'FK_degustador'], 'unique_receita_degustador');
            // $table->string('status')->nullable(); // Se quiser status, descomente

            // Foreign keys (opcional, se quiser integridade referencial)
            // $table->foreign('FKReceita')->references('idReceitas')->on('gmg_receitas');
            // $table->foreign('FK_degustador')->references('id')->on('funcionarios');
            // $table->foreign('FKcozinheiro')->references('id')->on('funcionarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_degustacao');
    }
};
