<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidatoController extends Controller
{
    function index() {
        $candidatos = DB::table('candidatos')->select()->get();

        return view('candidatos.index', [
            'candidatos' => $candidatos
        ]);
    }

    function store(Request $request) {
        $data = $request->all();
        DB::table('candidatos')->insert($data);

        return redirect('/candidatos');
    }

    function create() {

        $periodos = DB::table('periodos')->select()->get();
        $cargos = [
            ['id' => 1, 'nome' => 'Presidente'],
            ['id' => 2, 'nome' => 'Governador'],
        ];

        return view('candidatos.create', [
            'periodos' => $periodos,
            'cargos' => $cargos
        ]);
    }

    function edit($id) {
        $candidato = DB::table('candidatos')->find($id);

        return view('candidatos.edit', [
            'candidato' => $candidato
        ]);
    }

    function update(Request $request) {
        $data = $request->all();
        $id = array_shift($data);

        DB::table('candidatos')->where('id', $id)->update($data);

        return redirect('/candidatos');
    }

    function destroy($id){
        DB::table('candidatos')->where('id', $id)->destroy();

        return redirect('/candidatos');
    }
}
