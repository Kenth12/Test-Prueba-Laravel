<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    // se le da nombre a la tabla
    protected $table = 'venta';
      // se le reasigna su llave primaria
    protected $primaryKey = 'Id_Venta';
      // se le asignan sus propiedades al modelo
    protected $fillable = ['Id_Cliente', 'Estado', 'Fecha'];
      // se pone el $timestaps en falso para que no de errores
    public $timestamps = false;
}
