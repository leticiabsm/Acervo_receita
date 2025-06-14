<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cargo extends Model
{
    protected $table = 'gmg_cargo';

    protected $fillable = [
        'nome',
        'descricao',
        'data_inicio',
        'ativo',
    ];
}
