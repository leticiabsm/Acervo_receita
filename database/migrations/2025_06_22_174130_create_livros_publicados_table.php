<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livros_publicados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('livro_id');
            $table->string('titulo');
            $table->string('editor')->nullable();
            $table->string('isbn')->nullable();
            $table->unsignedBigInteger('funcionario_id')->nullable();
            $table->unsignedBigInteger('nota_id')->nullable();
            $table->timestamps();

            // Foreign keys (opcional, se quiser integridade referencial)
            // $table->foreign('livro_id')->references('idlivro')->on('gmg_livro');
            // $table->foreign('funcionario_id')->references('id')->on('funcionarios');
            // $table->foreign('nota_id')->references('id')->on('degustacaos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livros_publicados');
    }
};