<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $primaryKey = 'Id_Venta';
    protected $fillable = ['Id_Cliente', 'Estado', 'Fecha'];
    
    public $timestamps = false;
}
