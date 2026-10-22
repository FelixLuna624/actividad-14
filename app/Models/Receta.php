<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Receta extends Model
{
    use HasFactory;

    protected $table = 'recetas';
    protected $primaryKey = 'idReceta';

    protected $fillable = [
        'titulo',
        'porciones',
        'instrucciones',
    ];

    public function ingredientes(): BelongsToMany
    {
        return $this->belongsToMany(Ingrediente::class, 'receta_ingrediente', 'receta_id', 'ingrediente_id')
                    ->using(RecetaIngrediente::class)
                    ->withPivot('cantidad', 'unidad_medida')
                    ->withTimestamps();
    }
}