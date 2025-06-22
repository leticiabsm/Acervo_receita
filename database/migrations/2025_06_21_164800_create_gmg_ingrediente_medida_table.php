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
        Schema::create('gmg_ingrediente_medida', function (Blueprint $table) {
            $table->unsignedSmallInteger('idIngrediente');
            $table->unsignedSmallInteger('idMedida');
            $table->decimal('quantidade', 8, 2)->nullable();
            $table->string('observacao', 255)->nullable();
            $table->timestamps();

            $table->primary(['idIngrediente', 'idMedida']);

            $table->foreign('idIngrediente')->references('idIngrediente')->on('gmg_Ingredientes')->onDelete('cascade');
            $table->foreign('idMedida')->references('idMedida')->on('gmg_medidas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gmg_ingrediente_medida');
    }
};
