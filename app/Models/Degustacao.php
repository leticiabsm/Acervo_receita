<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degustacao extends Model
{
    protected $table = 'gmg_degustacao';
    public $timestamps = false;
    protected $primaryKey = 'idDesgustacao';
    protected $fillable = ['FKReceita', 'FK_degustador', 'FKcozinheiro', 'nota_degustacao', 'data_degustacao', 'descricao'];

    public function receita()
    {
        return $this->belongsTo(Receita::class, 'FKReceita', 'idReceitas'); // ajuste o nome do FK se for diferente
    }
}
