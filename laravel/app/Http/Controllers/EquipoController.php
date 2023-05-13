<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $jugadores = Jugador::all();

        return view('equipo', compact('jugadores'));
    }

    public function uploadComprovant(Request $request) {
        $request->validate([
            'comprovante_img' => 'required|image|max:10240',
        ]);


        if ($request->hasFile('comprovante_img')) {
            $image = $request->file('comprovante_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/uploads'), $filename);
        }

        $equipo = Equipo::find(Auth::user()->equipo->id);

        $equipo->update([
            'comprovante_img' => $filename,
            'estado_inscripcion' => "1",
        ]);


        return redirect()->back()->with('success', 'El comprovant s\'a enviat correctament. Ens posarem en conctacte amb tu quan haguem verificat el pagament i la inscripció del teu equip quedarà confirmada!');
    }
}
