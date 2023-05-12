<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espectador extends Model {
    use HasFactory;

    protected $fillable = ['id_usuario','name', 'apellidos', 'sexo', 'talla', 'alergenos', 'after'];
    protected $table = 'espectador';

    public function user() {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    protected $casts = [
        'after' => 'boolean',
    ];
}
