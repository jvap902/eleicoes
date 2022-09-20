<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidatoController extends Controller
{
    function index() {
        $candidatos = DB::table('candidatos')->select('periodos.nome as periodo_id', 'candidatos.nome as nome', 'candidatos.partido as partido', 'candidatos.numero as numero', 'candidatos.cargo as cargo', 'candidatos.id as id')->leftjoin('periodos', 'candidatos.periodo_id', '=', 'periodos.id')->where('candidatos.numero', '>', '0')->get();
        foreach($candidatos as $c){
           switch($c->cargo){
               case 1: $c->cargo = "Presidente"; break;
               case 2: $c->cargo = "Governador"; break;
               case 3: $c->cargo = "Senador"; break;
               case 4: $c->cargo = "Deputado Federal"; break;
               case 5: $c->cargo = "Deputado Estadual"; break;
           }

        }

        return view('candidatos.index', [
            'candidatos' => $candidatos
        ]);
    }

    function store(Request $request) {
        $periodos = DB::table('periodos')->select()->get();
        $nomes = ['Presidente', 'Governador', 'Senador', 'Deputado Federal', 'Deputado Estadual'];
        $cargos = [];
        foreach($nomes as $nome) {
            $cargo = new \stdClass;
            $cargo->id = count($cargos) + 1;
            $cargo->nome = $nome;
            $cargos[] = $cargo;
        }
        $data = $request->all();
        unset($data['_token']);
        $candidatos = DB::table('candidatos')->select('numero', 'periodo_id')->get();
        if($data['nome'] && $data['periodo_id'] && $data['partido'] && $data['numero']){
            foreach($candidatos as $c){
                if($c->numero == $data['numero'] && $c->periodo_id == $data['periodo_id']){
                    return view('/candidatos/create', ['erro' => "Este número já está cadastrado neste período!",'periodos' => $periodos,'cargos' => $cargos]);
                }
            }
            DB::table('candidatos')->insert($data);
            return redirect('/candidatos');
        }else{
            return view('/candidatos/create', ['erro' => "Preencha todos os campos", 'periodos' => $periodos, 'cargos' => $cargos]);
        }
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
        $candidato = DB::table('candidatos')->find($id);
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
        unset($data['_token']);
        $id = array_shift($data);

        DB::table('candidatos')->where('id', $id)->update($data);

        return redirect('/candidatos');
    }

    function destroy($id){
        try{
            DB::table('candidatos')
            ->where('id', $id)
            ->delete();

            return redirect('/candidatos');
        }catch(Exception $e){
            $candidatos = DB::table('candidatos')
            ->select()
            ->orderby('numero', 'DESC')
            ->get();
            return view('/candidatos.index', ['candidatos' => $candidatos, 'erro' => "Este candidato não pode ser excluído."]);
        }

    }

}
