<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model {
    protected $fillable = ['nombre', 'talla', 'alergenos', 'after', 'sexo', 'equipo_id'];
    use HasFactory;

    public function equipo() {
        return $this->belongsTo(Equipo::class);
    }
}
