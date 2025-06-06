<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'GMG_Livro'; // Define o nome da tabela associada ao modelo

    protected $fillable = ['idlivro','titulo', 'isbn']; // Permite atribuição em massa

    public $timestamps = true; // Desativa os timestamps, se não forem utilizados

//    public function editor() {
        //return $this->belongsTo(Editor::class, 'FKeditor');
    //}
    
}
