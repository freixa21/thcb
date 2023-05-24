<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroEquiposController;
use App\Http\Controllers\RegistroEspectadoresController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EspectadorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminEquiposController;
use App\Http\Controllers\AdminEspectadorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    // Login
    Route::get('/', [LoginController::class, 'index'])->name('auth.login');
    Route::post('/', [LoginController::class, 'authenticate'])->name('auth.login');

    // Recuperar Password
    Route::get('/recuperar-contrasenya', [UserController::class, 'recuperarPasswordView'])->middleware('guest')->name('password.request');
    Route::post('/recuperar-contrasenya', [UserController::class, 'enviarLink'])->middleware('guest')->name('password.email');
    // Reiniciar Password
    Route::get('/reiniciar-contrasenya/{token}', [UserController::class, 'reiniciarPasswordView'])->middleware('guest')->name('password.reset');
    Route::post('/reiniciar-contrasenya', [UserController::class, 'reiniciarPassword'])->middleware('guest')->name('password.update');

    // Registre EQUIPS
    Route::get("registre-equips", [RegistroEquiposController::class, "index"])->name('index.equips');
    Route::post("registre-equips", [RegistroEquiposController::class, "store"])->name('registrar.equip');

    // Registre ESPECTADORS
    Route::get("registre-espectadors", [RegistroEspectadoresController::class, "index"])->name('index.espectadors');
    Route::post("registre-espectadors", [RegistroEspectadoresController::class, "store"])->name('registrar.espectador');
});

// Logout
Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');

// ADMIN ==== Vista general
Route::get("admin", [AdminController::class, "index"])->name('admin.index');
// ADMIN ==== Equips i jugadors
Route::get("admin/equips", [AdminEquiposController::class, "index"])->name('admin.equips');
Route::post('admin/image/upload', [AdminEquiposController::class, 'uploadComprovant'])->name('admin.uploadComprovant');
Route::get("admin/equips/validar/{id}", [AdminEquiposController::class, "validarInscripcio"])->name('admin.validarInscripcio');
Route::get("admin/equip/{id}", [AdminEquiposController::class, "single"])->name('admin.singleEquip');
Route::post("admin/equip/actualitzar-jugador", [AdminEquiposController::class, "actualizarJugador"])->name('admin.actualizarJugador');
Route::post("admin/equip/afegir-jugador", [AdminEquiposController::class, "afegirJugador"])->name('admin.afegirJugador');
Route::delete("admin/equip/eliminar-jugador/{id}", [AdminEquiposController::class, "eliminarJugador"])->name('admin.eliminarJugador');
Route::delete("admin/eliminar-inscripcio-equip", [AdminEquiposController::class, "eliminarInscripcioEquip"])->name('admin.eliminarInscripcioEquip');
// ADMIN ==== Espectadors
Route::get("admin/espectadors", [AdminEspectadorController::class, "index"])->name('admin.espectadors');
Route::get("admin/espectador/{id}", [AdminEspectadorController::class, "single"])->name('admin.singleEspectador');
Route::post("admin/actualitzar-espectador", [AdminEspectadorController::class, "actualizarEspectador"])->name('admin.actualitzarEspectador');
Route::post('admin/espectador/image/upload', [AdminEspectadorController::class, 'espectadorComprovant'])->name('admin.espectadorComprovant');
Route::delete("admin/eliminar-inscripcio/{id}", [AdminEspectadorController::class, "eliminarInscripcioEspectador"])->name('admin.eliminarInscripcioEspectador');


// Vista + accions EQUIPS
Route::get("equip", [EquipoController::class, "index"])->name('index.equip');
Route::post('/image/upload', [EquipoController::class, 'uploadComprovant'])->name('uploadComprovant');
Route::post("/equip/actualitzar-jugador", [EquipoController::class, "actualizarJugador"])->name('actualitzarJugador');
Route::post("/equip/afegir-jugador", [EquipoController::class, "afegirJugador"])->name('afegirJugador');
Route::delete("/equip/eliminar-jugador/{id}", [EquipoController::class, "eliminarJugador"])->name('eliminarJugador');
Route::delete("eliminar-inscripcio-equip", [EquipoController::class, "eliminarInscripcioEquip"])->name('eliminarInscripcioEquip');

// Vista + accions ESPECTADORS
Route::get("espectador", [EspectadorController::class, "index"])->name('index.espectadors');
Route::post("actualitzar-espectador", [EspectadorController::class, "actualizarEspectador"])->name('actualitzarEspectador');
Route::post('espectador/image/upload', [EspectadorController::class, 'espectadorComprovant'])->name('espectadorComprovant');
Route::delete("eliminar-inscripcio", [EspectadorController::class, "eliminarInscripcioEspectador"])->name('eliminarInscripcioEspectador');

