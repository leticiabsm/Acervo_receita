<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 

class Medida extends Model
{
    use HasFactory;

    protected $table = 'gmg_medidas';
    protected $primaryKey = 'idMedida';
     public $timestamps = false;

    protected $fillable = ['tipo', 'item', 'descricao', 'ind_ativo'];


    public function ingredientes(): BelongsToMany
    {
        
        return $this->belongsToMany(Ingrediente::class, 'gmg_ingrediente_medida', 'idMedida', 'idIngrediente')
                    ->withPivot('quantidade', 'observacao')
                    ->withTimestamps();
    }
}
