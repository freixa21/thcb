<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('espectador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('apellidos');
            $table->string('sexo');
            $table->string('talla');
            $table->string('alergenos')->nullable();
            $table->boolean('after');
            $table->boolean('pagado');
            $table->boolean('pago_confirmado');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('equipos');
    }
};
