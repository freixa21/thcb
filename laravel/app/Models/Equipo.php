<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipo extends Model {
    use HasFactory;

    protected $fillable = ['nombre', 'id_usuario', 'estado_inscripcion', 'comprovante_img'];

    public function user() {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function jugadores() {
        return $this->hasMany(Jugador::class);
    }
}
