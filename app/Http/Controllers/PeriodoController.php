<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodoController extends Controller
{
    function index()
    {

        $periodos = DB::table('periodos')
            ->select()
            ->orderby('data_inicio', 'DESC')
            ->get();

        foreach ($periodos as $periodo) {

            $periodo->data_inicio = Carbon::parse($periodo->data_inicio)->format('d/m/Y H:i');
            $periodo->data_fim = Carbon::parse($periodo->data_fim)->format('d/m/Y H:i');
        }



        return view('periodos.index', [
            'periodos' => $periodos
        ]);
    }

    function create()
    {
        return view('periodos.create');
    }

    function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $periodos = DB::table('periodos')->get();
        if ($data['nome'] && $data['data_inicio'] && $data['data_fim']) {
            $inicio = Carbon::parse($data['data_inicio'])->setTimezone('America/Rosario')->format('Y-m-d H:i:s');
            $fim = Carbon::parse($data['data_fim'])->setTimezone('America/Rosario')->format('Y-m-d H:i:s');
            foreach ($periodos as $p) {
                if ($inicio <= $p->data_fim && $fim >= $p->data_inicio) {
                    return view('/periodos/create', ['erro' => "O período '$p->nome' já abrange estas datas!"]);
                }
            }
            DB::table('periodos')->insert($data);

            $periodo_id = DB::table('periodos')->where('data_inicio', '=', $data['data_inicio'])->get();

            DB::table('candidatos')->insert(
                array(
                    'nome' => "Nulo/Branco",
                    'cargo' => 1,
                    'partido' => '',
                    'numero' => 0,
                    'periodo_id' => $periodo_id[0]->id
                )
            );
            DB::table('candidatos')->insert(
                array(
                    'nome' => "Nulo/Branco",
                    'cargo' => 2,
                    'partido' => '',
                    'numero' => 0,
                    'periodo_id' => $periodo_id[0]->id
                )
            );
            DB::table('candidatos')->insert(
                array(
                    'nome' => "Nulo/Branco",
                    'cargo' => 3,
                    'partido' => '',
                    'numero' => 0,
                    'periodo_id' => $periodo_id[0]->id
                )
            );
            DB::table('candidatos')->insert(
                array(
                    'nome' => "Nulo/Branco",
                    'cargo' => 4,
                    'partido' => '',
                    'numero' => 0,
                    'periodo_id' => $periodo_id[0]->id
                )
            );
            DB::table('candidatos')->insert(
                array(
                    'nome' => "Nulo/Branco",
                    'cargo' => 5,
                    'partido' => '',
                    'numero' => 0,
                    'periodo_id' => $periodo_id[0]->id
                )
            );
            return redirect('/periodos');
        } else {
            return view('/periodos/create', ['erro' => "Preencha todos os campos"]);
        }
    }

    function edit($id)
    {
        $periodo = DB::table('periodos')->find($id);
        $votos = DB::table('votos')->get();

        foreach($votos as $v){
            if($v->data >= $periodo->data_inicio && $v->data <= $periodo->data_fim){
                $periodos = DB::table('periodos')->get();
                return view('/periodos.index', ['periodos' => $periodos, 'erro' => "Este período não pode ser alterado."]);
            }
        }

        return view('periodos.edit', [
            'periodo' => $periodo
        ]);
    }

    function update(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $id = array_shift($data);
        $periodo = DB::table('periodos')->find($id);
        $periodos = DB::table('periodos')->get();
        if ($data['nome'] && $data['data_inicio'] && $data['data_fim']) {
            $inicio = Carbon::parse($data['data_inicio'])->setTimezone('America/Rosario')->format('Y-m-d H:i:s');
            $fim = Carbon::parse($data['data_fim'])->setTimezone('America/Rosario')->format('Y-m-d H:i:s');
            foreach ($periodos as $p) {
                if ($inicio <= $p->data_fim && $fim >= $p->data_inicio && $p->id != $id) {
                    return view('/periodos/edit', ['erro' => "O período '$p->nome' já abrange estas datas!", 'periodo' => $periodo]);
                }
            }
            DB::table('periodos')
            ->where('id', $id)
            ->update($data);

        return redirect('/periodos');
        } else{
            return view('/periodos/edit', ['erro' => "Preencha todos os campos", 'periodo' => $periodo]);
        }
    }

    function destroy($id)
    {
        $periodo = DB::table('periodos')->find($id);
        $votos = DB::table('votos')->get();
        foreach($votos as $v){
            if($v->data >= $periodo->data_inicio && $v->data <= $periodo->data_fim){
                $periodos = DB::table('periodos')->select()->orderby('data_inicio', 'DESC')->get();
                foreach ($periodos as $periodo) {
                    $periodo->data_inicio = Carbon::parse($periodo->data_inicio)->format('d/m/Y H:i');
                    $periodo->data_fim = Carbon::parse($periodo->data_fim)->format('d/m/Y H:i');
                }
                return view('/periodos.index', ['periodos' => $periodos, 'erro' => "Este período não pode ser excluído."]);
            }
        }
        DB::table('candidatos')->where([['numero', '=', 0], ['periodo_id', '=', $id]])->delete();
        DB::table('periodos')->where('id', $id)->delete();
        return redirect('/periodos');
    }
}
