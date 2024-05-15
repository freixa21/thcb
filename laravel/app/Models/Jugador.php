<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellidos', 'email', 'sexo', 'talla', 'alergenos', 'after', 'equipo_id'];
    protected $table = 'jugadores';

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
