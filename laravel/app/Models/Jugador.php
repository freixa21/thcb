<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellidos', 'sexo', 'talla', 'alergenos', 'after'];
    protected $table = 'jugadores';

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
