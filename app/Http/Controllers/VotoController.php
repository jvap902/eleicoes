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
        $presidentes = DB::table('candidatos')
            ->where('cargo', 'presidente')
            ->select()
            ->get();
        $governadores = DB::table('candidatos')
            ->where('cargo', 'governador')
            ->select()
            ->get();
        $deputados_estaduais = DB::table('candidatos')
            ->where('cargo', 'deputado_estadual')
            ->select()
            ->get();
        $deputados_federais = DB::table('candidatos')
            ->where('cargo', 'deputado_federal')
            ->select()
            ->get();
        $senadores = DB::table('candidatos')
            ->where('cargo', 'senador')
            ->select()
            ->get();

        return view('votos.create', [
            'presidentes' => $presidentes,
            'governadores' => $governadores,
            'deputados_estaduais' => $deputados_estaduais,
            'deputados_federais' => $deputados_federais,
            'senadores' => $senadores,
        ]);
    }

    function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        DB::table('votos')->insert($data);
        $request->session()->forget('voto');

        return redirect('/');
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

    function resultados(){
        $votos = [];
        $periodos = DB::table('periodos')->orderby('data_fim', 'DESC')->get();
        foreach($periodos as $p){
            $votos[$p->id] = DB::table('votos')
            ->select('candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
            ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
            ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio]])
            ->groupby('candidatos.nome')
            ->get();

            // $zonas = DB::table('votos')
            // ->select('votos.zona')
            // PEGAR ZONA POR PERIODO 
        }
        return view('votos.resultados', ['periodos' => $periodos, 'votos' => $votos]);
        
    }
}
