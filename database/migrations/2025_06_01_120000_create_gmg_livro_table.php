<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gmg_livro', function (Blueprint $table) {
            $table->bigIncrements('idlivro'); // trocado de $table->id() para idlivro
            $table->string('titulo');
            $table->string('isbn')->nullable();
            $table->string('editor')->nullable();
            $table->string('cozinheiro')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->text('texto_livro')->nullable();
            $table->string('imagem_livro')->nullable();
            $table->string('capa')->nullable();
            $table->text('descricao')->nullable();
            $table->boolean('publicado')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gmg_livro');
    }
};