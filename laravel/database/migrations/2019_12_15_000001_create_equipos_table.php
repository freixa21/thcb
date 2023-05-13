<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration {
    public function up() {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->string('nombre')->unique();
            $table->boolean('pago_confirmado')->default(0);
            $table->string('estado_inscripcion')->default("0");
            $table->string('comprovante_img')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('equipos');
    }
}
