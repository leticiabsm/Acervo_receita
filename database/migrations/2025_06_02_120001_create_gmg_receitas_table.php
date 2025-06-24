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
        Schema::create('gmg_receitas', function (Blueprint $table) {
            $table->increments('idReceitas')->comment('Contém o identificador da receita.');
            $table->string('status', 30)->nullable()->comment('Status da receita: aguardando degustacao');
            $table->string('nome_rec', 45)->comment('Contém o nome da receita.');

            $table->unsignedBigInteger('FKcozinheiro')->comment('Contém o identificador do cozinheiro da receita.');
            $table->unsignedSmallInteger('FKCategoria')->comment('Contém o identificador da categoria da receita.');

            $table->date('dt_criacao')->comment('Contém a data de criação da receita.');
            $table->text('preparo')->comment('Contém a instrução de como preparar a receita. Tamanho máximo de 5000 caracteres.');
            $table->decimal('quat_porcao', 9, 2)->comment('Contém a quantidade de porção da receita. Ex: 2 porções, 3 porções.');
            $table->char('ind_rec_inedita', 1)->comment('Contém o indicador se a receita é inédita: S - Sim, N - Não.');
            $table->string('dificudade_receitas', 12)->comment('Contém a dificuldade da receita. Ex: Fácil, Médio, Difícil.');
            $table->time('tempo_de_preparo')->comment('Contém o tempo de preparo da receita. Ex: 00:30:00 (HH:MM:SS).');


            $table->unsignedBigInteger('FKLivro')->nullable()->comment('Livro ao qual a receita pertence');

            $table->foreign('FKLivro')->references('idlivro')->on('gmg_livro');

            $table->foreign('FKcozinheiro')
                ->references('id')->on('funcionarios')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('FKCategoria')
                ->references('id_cat')->on('gmg_categoria')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_receitas');
    }
};
