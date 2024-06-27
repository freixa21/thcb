<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use App\Models\Espectador;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

            // Total afters jugadors$equip->after
            $afterJugadors10 = 0;
            $afterJugadors10confirmats = 0;
            $afterJugadors15 = 0;
            $afterJugadors15confirmats = 0;
            foreach ($jugadors as $jugador) {
                if (($jugador->after) && ($jugador->created_at->lt(env('DATA_CANVI_DE_PREU'))) && ($jugador->equipo->pago_confirmado)) {
                    $afterJugadors10confirmats++;
                } else if ($jugador->after && $jugador->created_at->lt(env('DATA_CANVI_DE_PREU'))) {
                    $afterJugadors10++;
                } else if ($jugador->after && $jugador->created_at->gt(env('DATA_CANVI_DE_PREU')) && $jugador->equipo->pago_confirmado) {
                    $afterJugadors15confirmats++;
                } else if ($jugador->after && $jugador->created_at->gt(env('DATA_CANVI_DE_PREU'))) {
                    $afterJugadors15++;
                }
            }

            // Inscripcions
            $inscripcioJugadors25 = 0;
            $inscripcioJugadors25confirmats = 0;
            $inscripcioJugadors30 = 0;
            $inscripcioJugadors30confirmats = 0;
            foreach ($jugadors as $jugador) {
                if (($jugador->created_at->lt(env('DATA_CANVI_DE_PREU'))) && ($jugador->equipo->pago_confirmado)) {
                    $inscripcioJugadors25confirmats++;
                } else if ($jugador->created_at->lt(env('DATA_CANVI_DE_PREU'))) {
                    $inscripcioJugadors25++;
                } else if ($jugador->created_at->gt(env('DATA_CANVI_DE_PREU')) && $jugador->equipo->pago_confirmado) {
                    $inscripcioJugadors30confirmats++;
                } else if ($jugador->created_at->gt(env('DATA_CANVI_DE_PREU'))) {
                    $inscripcioJugadors30++;
                }
            }


            // Ingressos previstos jugadors
            $ingressosPrevistosJugadors = (($inscripcioJugadors25 + $inscripcioJugadors25confirmats) * 28)
                + (($inscripcioJugadors30 + $inscripcioJugadors30confirmats) * 30)
                + (($afterJugadors10 + $afterJugadors10confirmats) * 11)
                + (($afterJugadors15 + $afterJugadors15confirmats) * 11);


            // Ingressos confirmats jugadors
            $ingressosConfirmatsJugadors = (($inscripcioJugadors25confirmats) * 28)
                + (($inscripcioJugadors30confirmats) * 30)
                + (($afterJugadors10confirmats) * 11)
                + (($afterJugadors15confirmats) * 11);

            /////// ESPECTADORS ///////
            // Espectadors inscrits
            $espectadorsInscrits = count($espectadors);
            // Espectadors confirmats
            $espectadorsConfirmats = Espectador::where('pago_confirmado', 1)->count();
            // Afters espectadors
            $afterEspectadors = Espectador::where('after', 1)->count();

            // Inscripcions ESPECTADORS
            $inscripcioEspectador25 = 0;
            $inscripcioEspectador25confirmats = 0;
            $inscripcioEspectador30 = 0;
            $inscripcioEspectador30confirmats = 0;
            foreach ($espectadors as $espectador) {
                if (($espectador->created_at->lt(env('DATA_CANVI_DE_PREU'))) && ($espectador->pago_confirmado)) {
                    $inscripcioEspectador25confirmats++;
                } else if ($espectador->created_at->lt(env('DATA_CANVI_DE_PREU'))) {
                    $inscripcioEspectador25++;
                } else if ($espectador->created_at->gt(env('DATA_CANVI_DE_PREU')) && $espectador->pago_confirmado) {
                    $inscripcioEspectador30confirmats++;
                } else if ($espectador->created_at->gt(env('DATA_CANVI_DE_PREU'))) {
                    $inscripcioEspectador30++;
                }
            }

            // After Espectadors
            $afterEspectador10 = 0;
            $afterEspectador10confirmats = 0;
            $afterEspectador15 = 0;
            $afterEspectador15confirmats = 0;
            foreach ($espectadors as $espectador) {
                if (($espectador->after) && ($espectador->created_at->lt(env('DATA_CANVI_DE_PREU'))) && ($espectador->pago_confirmado)) {
                    $afterEspectador10confirmats++;
                } else if ($espectador->after && $espectador->created_at->lt(env('DATA_CANVI_DE_PREU'))) {
                    $afterEspectador10++;
                } else if ($espectador->after && $espectador->created_at->gt(env('DATA_CANVI_DE_PREU')) && $espectador->pago_confirmado) {
                    $afterEspectador15confirmats++;
                } else if ($espectador->after && $espectador->created_at->gt(env('DATA_CANVI_DE_PREU'))) {
                    $afterEspectador15++;
                }
            }

            // Ingressos previstos espectadors
            $ingressosPrevistosEspectadors = (($inscripcioEspectador25 + $inscripcioEspectador25confirmats) * 28)
                + (($inscripcioEspectador30 + $inscripcioEspectador30confirmats) * 30)
                + (($afterEspectador10 + $afterEspectador10confirmats) * 11)
                + (($afterEspectador15 + $afterEspectador15confirmats) * 11);


            // Ingressos confirmats espectadors
            $ingressosConfirmatsEspectadors = (($inscripcioEspectador25confirmats) * 28)
                + (($inscripcioEspectador30confirmats) * 30)
                + (($afterEspectador10confirmats) * 11)
                + (($afterEspectador15confirmats) * 11);

            // Total comisio teules prevista
            $ComisioAfter = ((($afterJugadors10 + $afterJugadors10confirmats) * 11) + (($afterJugadors15 + $afterJugadors15confirmats) * 11));
            // Total comisio confirmada
            $ComisioAfterConfirmada = (($afterJugadors10confirmats * 11) + ($afterJugadors15confirmats * 11));





            //////// GENERAL ///////////
            // Total inscrits
            $totalInscrits = count($jugadors) + count($espectadors);
            // Total pagats
            $totalPagats = $jugadorsConfirmats + $espectadorsConfirmats;
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

            $jugadoresConAlergias = DB::table('jugadores')
                ->select('jugadores.*', 'jugadores.alergenos as alergia_jugador')
                ->get();

            $espectadoresConAlergias = DB::table('espectador')
                ->select('espectador.*', 'espectador.alergenos as alergia_espectador')
                ->get();

            $alergias = [];

            foreach ($jugadoresConAlergias as $jugador) {
                if (!empty($jugador->alergenos)) {
                    $alergias[] = [
                        'nombre' => $jugador->nombre,
                        'apellidos' => $jugador->apellidos,
                        'alergia' => $jugador->alergenos
                    ];
                }
            }

            foreach ($espectadoresConAlergias as $espectador) {
                if (!empty($espectador->alergenos)) {
                    $alergias[] = [
                        'nombre' => $espectador->name,
                        'apellidos' => $espectador->apellidos,
                        'alergia' => $espectador->alergenos
                    ];
                }
            }








            return view('admin.index', [
                'totalPagats' => $totalPagats,
                'totalHomes' => $totalHomes,
                'totalDones' => $totaldones,
                'totalIngressosPrevistos' => $totalIngressosPrevistos,
                'totalIngressosConfirmats' => $totalIngressosConfirmats,
                'totalInscrits' => $totalInscrits,
                'totalEquips' => $totalEquips,
                'equipsConfirmats' => $equipsConfirmats,
                'totalJugadors' => $totalJugadors,
                'jugadorsConfirmats' => $jugadorsConfirmats,
                'afterJugadors10' => $afterJugadors10,
                'afterJugadors10confirmats' => $afterJugadors10confirmats,
                'afterJugadors15' => $afterJugadors15,
                'afterJugadors15confirmats' => $afterJugadors15confirmats,
                'inscripcioJugadors25' => $inscripcioJugadors25,
                'inscripcioJugadors25confirmats' => $inscripcioJugadors25confirmats,
                'inscripcioJugadors30' => $inscripcioJugadors30,
                'inscripcioJugadors30confirmats' => $inscripcioJugadors30confirmats,
                'afterEspectador10' => $afterEspectador10,
                'afterEspectador10confirmats' => $afterEspectador10confirmats,
                'afterEspectador15' => $afterEspectador15,
                'afterEspectador15confirmats' => $afterEspectador15confirmats,
                'ComisioAfterConfirmada' => $ComisioAfterConfirmada,
                'ComisioAfter' => $ComisioAfter,
                'inscripcioEspectador25' => $inscripcioEspectador25,
                'inscripcioEspectador25confirmats' => $inscripcioEspectador25confirmats,
                'inscripcioEspectador30' => $inscripcioEspectador30,
                'inscripcioEspectador30confirmats' => $inscripcioEspectador30confirmats,
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
                'alergias' => $alergias
            ]);
        }
        return redirect()->intended('/');
    }
}
