<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;
    protected $table = 'direccion';
    protected $primaryKey = 'Id_Direccion';
    protected $fillable = ['Id_Cliente','Direccion', 'Ciudad',];
    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(Client::class, 'Id_Cliente');
    }
}
