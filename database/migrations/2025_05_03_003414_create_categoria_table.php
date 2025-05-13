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
        Schema::create('categoria', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 45);
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->boolean('ind_ativo')->default(true);
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria');
    }
};
