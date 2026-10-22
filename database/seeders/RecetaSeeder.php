<?php

use App\Models\Receta;
use App\Models\Ingrediente;

// 1. Instanciar y registrar la Receta
$receta = Receta::create([
    'titulo' => 'Pastel de Chocolate',
    'porciones' => 8,
    'instrucciones' => 'Mezclar los ingredientes secos, agregar los húmedos y hornear a 180°C por 45 minutos.'
]);

// 2. Instanciar los Ingredientes
$harina = Ingrediente::create(['nombre' => 'Harina de trigo']);
$cacao = Ingrediente::create(['nombre' => 'Cacao en polvo']);
$azucar = Ingrediente::create(['nombre' => 'Azúcar refinada']);

// 3. Asociar los ingredientes a la receta con sus atributos de cantidad y unidad de medida
$receta->ingredientes()->attach([
    $harina->idIngrediente => ['cantidad' => 2.50, 'unidad_medida' => 'tazas'],
    $cacao->idIngrediente  => ['cantidad' => 1.00, 'unidad_medida' => 'taza'],
    $azucar->idIngrediente => ['cantidad' => 1.75, 'unidad_medida' => 'tazas'],
]);

// 4. Consultar y verificar la receta con sus ingredientes asociados
$recetaCompleta = Receta::with('ingredientes')->find($receta->idReceta);

foreach ($recetaCompleta->ingredientes as $ingrediente) {
    echo "Ingrediente: {$ingrediente->nombre} - Cantidad: {$ingrediente->pivot->cantidad} {$ingrediente->pivot->unidad_medida}\n";
}