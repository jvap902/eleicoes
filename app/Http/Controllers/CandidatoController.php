<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidatoController extends Controller
{
    function index() {
        $candidatos = DB::table('candidatos')->join('periodos', 'periodos.id', '=', 'candidatos.periodo_id')->select("candidatos.*", "periodos.id")->get();
        return view('candidatos.index', [
            'candidatos' => $candidatos
        ]);
    }

    function store(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        DB::table('candidatos')->insert($data);

        return redirect('/candidatos');
    }

    function create() {

        $periodos = DB::table('periodos')->select()->get();

        $nomes = ['Presidente', 'Governador', 'Senador', 'Deputado Federal', 'Deputado Estadual'];
        
        $cargos = [];
        foreach($nomes as $nome) {
            $cargo = new \stdClass;
            $cargo->id = count($cargos) + 1;
            $cargo->nome = $nome;
            $cargos[] = $cargo;
        }

        

        return view('candidatos.create', [
            'periodos' => $periodos,
            'cargos' => $cargos
        ]);
    }

    function edit($id) {
        $candidato = DB::table('candidatos')->join('periodos', 'periodos.id', '=', 'candidatos.periodo_id')->select("candidatos.*", "periodos.id")->where('candidatos.id', '=', $id); // acho que dá para tirar o periodos.id
        $periodos = DB::table('periodos')->select()->get();

        $nomes = ['Presidente', 'Governador', 'Senador', 'Deputado Federal', 'Deputado Estadual'];
        
        $cargos = [];
        foreach($nomes as $nome) {
            $cargo = new \stdClass;
            $cargo->id = count($cargos) + 1;
            $cargo->nome = $nome;
            $cargos[] = $cargo;
        }

        return view('candidatos.edit', [
            'candidato' => $candidato,
            'periodos' => $periodos,
            'cargos' => $cargos
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
