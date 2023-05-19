<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Equipo;
use App\Models\Jugador;
use App\Models\Espectador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $user = Auth::user()->is_admin;

        if ($user == 1) {
            $jugadors = Jugador::All();
            $equips = Equipo::All();
            $espectadors = Espectador::All();

            //////// GENERAL ///////////
            // Total inscrits
            $totalInscrits = count($jugadors) + count($espectadors);
            // Total pagats
            // Total afters
            // Total homes
            // Total dones
            // Total ingressos previstos
            // Total ingressos confirmats

            /////// EQUIPS ///////
            // Total equips inscrits
            $totalEquips = count($equips);
            // Total equips confirmats
            $equipsConfirmats = 0;
            foreach ($equips as $equip) {
                if ($equip->pago_confirmado) {
                    $equipsConfirmats++;
                };
            }
            // Total jugadors inscrits
            $totalJugadors = count($jugadors);
            // Total jugadors confirmats
            $jugadorsConfirmats = 0;
            foreach (Equipo::with('jugadores')->where('pago_confirmado', 1)->get() as $equip) {
                $jugadorsConfirmats += count($equip->jugadores);
            }

            // Total afters jugadors
            $afterJugadors = 0;
            foreach ($jugadors as $jugador) {
                if ($jugador->after) {
                    $afterJugadors++;
                };
            }
            // Ingressos previstos jugadors
            $ingressosPrevistosJugadors = 0;
            foreach (Equipo::with('jugadores')->get() as $equip) {
                $contador = 0;
                foreach ($equip->jugadores as $jugador) {
                    if ($jugador->created_at->lt('2023-06-23 0:00:00')) {
                        if ($jugador->after) {
                            $contador += 35;
                        } else {
                            $contador += 25;
                        }
                    } else {
                        if ($jugador->after) {
                            $contador += 40;
                        } else {
                            $contador += 25;
                        }
                    }
                }
                $ingressosPrevistosJugadors += $contador;
            }

            // Ingressos confirmats jugadors
            $ingressosConfirmatsJugadors = 0;
            foreach (Equipo::with('jugadores')->where('pago_confirmado', 1)->get() as $equip) {
                $contador = 0;
                foreach ($equip->jugadores as $jugador) {
                    if ($jugador->created_at->lt('2023-06-23 0:00:00')) {
                        if ($jugador->after) {
                            $contador += 35;
                        } else {
                            $contador += 25;
                        }
                    } else {
                        if ($jugador->after) {
                            $contador += 40;
                        } else {
                            $contador += 25;
                        }
                    }
                }
                $ingressosConfirmatsJugadors += $contador;
            }





            return view('admin.index', [
                'totalInscrits' => $totalInscrits,
            ]);
        }
        return redirect()->intended('/');
    }
}
