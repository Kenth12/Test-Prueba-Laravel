<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;
    // se le da nombre a la tabla
    protected $table = 'direccion';
    // se reasigna la llave primaria
    protected $primaryKey = 'Id_Direccion';
    // se le asigna sus propiedades de la tabla
    protected $fillable = ['Id_Cliente','Direccion', 'Ciudad',];
    // se coloca false el timestamps para que no de errores
    public $timestamps = false;

    // se establece la relacion de pertenencia entre modelos en esta funcion
    public function client()
    {
        return $this->belongsTo(Client::class, 'Id_Cliente');
    }
}
