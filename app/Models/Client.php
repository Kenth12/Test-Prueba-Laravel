<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    // se le da nombre a la tabla
    protected $table = 'clients';
    // se asignan sus propiedades
    protected $fillable = ['Nombre', 'Celular', 'Correo', 'Sexo'];
    // se coloca el $timestamps false, para que no de errores
    public $timestamps = false;
}
