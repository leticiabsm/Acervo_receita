<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Funcionario extends Authenticatable
{
    protected $table = 'funcionarios';

    protected $fillable = [
        'nome',
        'email',
        'password',
        'cargo_id',
        'ativo',
        'rg',
        'salario',
        'data_inicio',
        'data_finalizacao',
        'nome_fantasia',
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
