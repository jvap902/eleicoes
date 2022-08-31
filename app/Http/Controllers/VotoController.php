<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VotoController extends Controller
{
    function index()
    {
        return view('votos.index');
    }

    function create()
    {
        $candidatos = DB::table('candidatos')
            ->select()
            ->get();

        return view('votos.create', [
            'candidatos' => $candidatos
        ]);
    }

    function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        DB::table('votos')->insert($data);

        return redirect('/home');
    }

    function titulo(){
        return view('votos.titulo');
    }

    function validar(Request $request){
        $data = $request->all();
        unset($data['_token']);
        $titulo = $data['titulo'];
        $valido = $votou = $ativo = false;
        $eleitores = DB::table('eleitores')->get();
        $votantes = DB::table('votantes')->get();
        $periodos = DB::table('periodos')->get();
        $hoje = Carbon::now()->format('Y-m-d H:i:s');
        $pid = $eid = $erro =null;

        foreach($eleitores as $e){
            if($e->titulo == $titulo){
                $eid = $e->id;
                $valido = true;
                foreach($periodos as $p){
                    if($hoje >= $p->data_inicio && $hoje <= $p->data_fim){
                        $pid = $p->id;
                        $ativo = true;
                        foreach($votantes as $v){
                            if($pid == $v->periodo_id && $eid == $v->eleitor_id){
                                $votou = true;
                                break;
                            }
                        }
                        if(!$votou){
                            $request->session()->put('voto',  true);
                            return redirect('/votos/create');
                        }
                        break;
                    }
                }
                break;
            }
        }

        if(!$valido){
            $erro = "Este título não está cadastrado!";
        }elseif(!$ativo){
            $erro = "Não há nenhum período ativo no momento!";
        }elseif($votou){
            $erro = "Não é possível votar mais de uma vez em um período!";
        }
        return view('/votos/titulo', ['erro' => $erro]);

    }
}
