<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    protected $fillable = ['nome', 'contato', 'telefone', 'ativo'];
}
