<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degustacao extends Model
{
    protected $table = 'gmg_degustacao';
    public $timestamps = false;
    protected $primaryKey = 'idDesgustacao';
    protected $fillable = ['FK_nome_rec','FK_degustador','FKcozinheiro','nota_degustacao', 'data_degustacao'];

    public function receita()
    {
        return $this->belongsTo(\App\Models\Receita::class, 'FKReceita', 'idReceitas');
    }
}