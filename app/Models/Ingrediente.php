<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = 'ingredientes';
    protected $primaryKey = 'idIngrediente';

    protected $fillable = [
        'nombre',
    ];

    /**
     * Relación de muchos a muchos con Receta
     */
    public function recetas(): BelongsToMany
    {
        return $this->belongsToMany(Receta::class, 'receta_ingrediente', 'ingrediente_id', 'receta_id')
                    ->using(RecetaIngrediente::class)
                    ->withPivot('cantidad', 'unidad_medida')
                    ->withTimestamps();
    }
}