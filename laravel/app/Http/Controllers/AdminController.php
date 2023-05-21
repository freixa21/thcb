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

            /////// ESPECTADORS ///////
            // Espectadors inscrits
            $espectadorsInscrits = count($espectadors);
            // Espectadors confirmats
            $espectadorsConfirmats = Espectador::where('pago_confirmado', 1)->count();
            // Afters espectadors
            $afterEspectadors = Espectador::where('after', 1)->count();
            // Ingressos previstos espectadors
            $ingressosPrevistosEspectadors = 0;
            foreach ($espectadors as $espectador) {
                if ($espectador->created_at->lt('2023-06-23 0:00:00')) {
                    if ($espectador->after) {
                        $ingressosPrevistosEspectadors += 35;
                    } else {
                        $ingressosPrevistosEspectadors += 25;
                    }
                } else {
                    if ($espectador->after) {
                        $ingressosPrevistosEspectadors += 40;
                    } else {
                        $ingressosPrevistosEspectadors += 25;
                    }
                }
            }

            // Ingressos confirmats jugadors
            $ingressosConfirmatsEspectadors = 0;
            foreach (Espectador::where('pago_confirmado', 1)->get() as $espectador) {
                if ($espectador->created_at->lt('2023-06-23 0:00:00')) {
                    if ($espectador->after) {
                        $ingressosConfirmatsEspectadors += 35;
                    } else {
                        $ingressosConfirmatsEspectadors += 25;
                    }
                } else {
                    if ($espectador->after) {
                        $ingressosConfirmatsEspectadors += 40;
                    } else {
                        $ingressosConfirmatsEspectadors += 25;
                    }
                }
            }


            //////// GENERAL ///////////
            // Total inscrits
            $totalInscrits = count($jugadors) + count($espectadors);
            // Total pagats
            $totalPagats = $jugadorsConfirmats + $espectadorsConfirmats;
            // Total afters
            $totalAfters = $afterJugadors + $afterEspectadors;
            // Total homes
            $homesJugadors = Jugador::where('sexo', 'H')->count();
            $homesEspectadors = Espectador::where('sexo', 'H')->count();
            $totalHomes = $homesJugadors + $homesEspectadors;
            // Total dones
            $donesJugadors = Jugador::where('sexo', 'D')->count();
            $donesEspectadors = Espectador::where('sexo', 'D')->count();
            $totaldones = $donesJugadors + $donesEspectadors;
            // Total ingressos previstos
            $totalIngressosPrevistos = $ingressosPrevistosJugadors + $ingressosPrevistosEspectadors;
            // Total ingressos confirmats
            $totalIngressosConfirmats = $ingressosConfirmatsJugadors + $ingressosConfirmatsEspectadors;


            ////////////  SAMARRETES /////////
            $tallaSJugador = Jugador::where('talla', 'S')->count();
            $tallaSEspectador = Espectador::where('talla', 'S')->count();
            $totalS = $tallaSJugador + $tallaSEspectador;

            $tallaMJugador = Jugador::where('talla', 'M')->count();
            $tallaMEspectador = Espectador::where('talla', 'M')->count();
            $totalM = $tallaMJugador + $tallaMEspectador;

            $tallaLJugador = Jugador::where('talla', 'L')->count();
            $tallaLEspectador = Espectador::where('talla', 'L')->count();
            $totalL = $tallaLJugador + $tallaLEspectador;

            $tallaXLJugador = Jugador::where('talla', 'XL')->count();
            $tallaXLEspectador = Espectador::where('talla', 'XL')->count();
            $totalXL = $tallaXLJugador + $tallaXLEspectador;

            $tallaXXLJugador = Jugador::where('talla', 'XXL')->count();
            $tallaXXLEspectador = Espectador::where('talla', 'XXL')->count();
            $totalXXL = $tallaXXLJugador + $tallaXXLEspectador;

            

            return view('admin.index', [
                'totalPagats' => $totalPagats,
                'totalAfters' => $totalAfters,
                'totalHomes' => $totalHomes,
                'totalDones' => $totaldones,
                'totalIngressosPrevistos' => $totalIngressosPrevistos,
                'totalIngressosConfirmats' => $totalIngressosConfirmats,
                'totalInscrits' => $totalInscrits,
                'totalEquips' => $totalEquips,
                'equipsConfirmats' => $equipsConfirmats,
                'totalJugadors' => $totalJugadors,
                'jugadorsConfirmats' => $jugadorsConfirmats,
                'afterJugadors' => $afterJugadors,
                'ingressosPrevistosJugadors' => $ingressosPrevistosJugadors,
                'ingressosConfirmatsJugadors' => $ingressosConfirmatsJugadors,
                'espectadorsInscrits' => $espectadorsInscrits,
                'espectadorsConfirmats' => $espectadorsConfirmats,
                'afterEspectadors' => $afterEspectadors,
                'ingressosPrevistosEspectadors' => $ingressosPrevistosEspectadors,
                'ingressosConfirmatsEspectadors' => $ingressosConfirmatsEspectadors,
                'totalS' => $totalS,
                'totalM' => $totalM,
                'totalL' => $totalL,
                'totalXL' => $totalXL,
                'totalXXL' => $totalXXL,

            ]);
        }
        return redirect()->intended('/');
    }
}
