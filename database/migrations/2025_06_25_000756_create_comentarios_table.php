<?php
// database/migrations/xxxx_xx_xx_create_comentarios_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('FKLivro'); // ou 'livro_id'
            $table->text('texto');
            $table->timestamps();

            // Foreign key (opcional, mas recomendado)
            $table->foreign('FKLivro')->references('idlivro')->on('gmg_livro')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};