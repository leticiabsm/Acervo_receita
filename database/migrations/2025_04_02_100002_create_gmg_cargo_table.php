<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGmgCargoTable extends Migration
{
    public function up()
    {
        Schema::create('gmg_cargo', function (Blueprint $table) {

            $table->id();
            $table->string('nome')->unique();
            $table->text('descricao')->nullable();
            $table->date('data_inicio')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gmg_cargo');
    }
}
