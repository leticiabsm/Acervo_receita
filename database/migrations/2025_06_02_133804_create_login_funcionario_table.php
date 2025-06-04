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
        Schema::create('login_funcionario', function (Blueprint $table) {
            $table->string('FkEmail', 256)->primary()->comment('Contém o identificador único do funcionário pelo o email.');
            $table->string('senha', 256)->comment('Contém a senha hash do email.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_funcionario');
    }
};