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
        Schema::create('gmg_cadastro_de_funcionario', function (Blueprint $table) {
            $table->increments('FK_idFuncionario')->comment('Contém o identificador único do funcionário.');
            $table->integer('rg')->unique()->comment('Registro Geral dos Funcionarios (Número da identidade).');
            $table->string('nome', 100)->comment('Nomes de Funcionário');
            $table->date('dt_adm')->comment('Contém a data de admissão do Funcionário.');
            $table->decimal('salario', 9, 2)->comment('Contém o salário contratado do funcionário.');

            // AQUI ESTÁ A MUDANÇA IMPORTANTE
            // Deve ser unsignedSmallInteger() para corresponder a smallIncrements() de idCargo
            $table->unsignedSmallInteger('FKCargo')->comment('Contém o identificador do cargo');

            $table->binary('foto_perfil')->nullable()->comment('Contém a foto do funcionario para o perfil.');
            $table->string('FKEmail_Funcionarios', 256)->comment('Contém o email do funcionario');
            $table->string('nome_fantasia', 45)->nullable()->comment('Contém o nome fantasia de cozinheiro');
            $table->date('data_fim_funcionario')->nullable()->comment('Contém data fim de funcionario.');
            $table->tinyInteger('ind_funcionario')->unique()->comment('Contém o indicador(status) do funcionario, onde: 1 - ativo, 0 - inativo');

            // Chaves Estrangeiras
            $table->foreign('FKCargo')
                  ->references('idCargo')->on('gmg_cargo')
                  ->onDelete('no action')
                  ->onUpdate('no action');

            $table->foreign('FKEmail_Funcionarios')
                  ->references('FkEmail')->on('login_funcionario')
                  ->onDelete('no action')
                  ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_cadastro_de_funcionario');
    }
};