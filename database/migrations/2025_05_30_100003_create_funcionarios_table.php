<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('email', 256)->unique();
            $table->string('password');
            $table->string('rg', 30)->nullable();
            $table->decimal('salario', 10, 2)->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_finalizacao')->nullable();
            $table->string('nome_fantasia', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('cargo_id')->constrained('gmg_cargo')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
};