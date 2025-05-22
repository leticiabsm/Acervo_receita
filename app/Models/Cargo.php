<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';
    protected $primaryKey = 'idCargo';
    
    // public $timestamps = false;

    protected $fillable = [
        'nome_cargo',
        'descricao',
        'data_inicio',
        'data_fim',
        'ind_ativo',
    ];
}
