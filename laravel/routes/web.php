<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroEquiposController;
use App\Http\Controllers\LoginController;
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
Route::get("/", [LoginController::class, "index"])->name('login');

// Registre GENERAL
/*Route::get('registre', function () {
    return view('register');
});*/

// Registre EQUIPS
Route::get("registre-equips", [RegistroEquiposController::class, "index"])->name('index.equips');
Route::post("registre-equips", [RegistroEquiposController::class, "store"])->name('registrar.equip');

// Registre ESPECTADORS
Route::get('registre-espectadors', function () {
    return view('register-espectadors');
});
Route::post("registre-espectadors", [RegistroEquiposController::class, "store"]);
