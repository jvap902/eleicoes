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
        return view('votos.create');
    }

    function confirmar(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        $presidente = DB::table('candidatos')->where('numero', $data['presidente'])->get();
        $governador = DB::table('candidatos')->where('numero', $data['governador'])->get();
        $senador = DB::table('candidatos')->where('numero', $data['senador'])->get();
        $deputado_federal = DB::table('candidatos')->where('numero', $data['deputado_federal'])->get();
        $deputado_estadual = DB::table('candidatos')->where('numero', $data['deputado_estadual'])->get();

        return view('votos.confirmar', [
            'presidente' => $presidente[0]->nome,
            'governador' => $governador[0]->nome,
            'senador' => $senador[0]->nome,
            'deputado_federal' => $deputado_federal[0]->nome,
            'deputado_estadual' => $deputado_estadual[0]->nome
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
        $pgeral = $pzonas = $pzvotos = $psecoes = $psvotos =[];
        $periodos = DB::table('periodos')->orderby('data_fim', 'DESC')->get();
        foreach($periodos as $p){
            $pgeral[$p->id] = DB::table('votos')
            ->select('candidatos.cargo as cargo','candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
            ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
            ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 1]])
            ->groupby('candidatos.nome', 'cargo')
            ->orderby('votos', 'DESC')
            ->get();

            $pzonas [$p->id] = DB::table('votos')
            ->select('candidatos.cargo as cargo','votos.zona as zona')
            ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
            ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 1]])
            ->groupby('zona', 'cargo')
            ->orderby('zona', 'ASC')
            ->get();

            $pzvotos[$p->id] = DB::table('votos')
            ->select('votos.zona as zona', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
            ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
            ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 1]])
            ->groupby('votos.zona', 'candidatos.nome', 'cargo')
            ->orderby('votos', 'DESC')
            ->get();

            $psecoes [$p->id] = DB::table('votos')
            ->select('candidatos.cargo as cargo','votos.secao as secao')
            ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
            ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 1]])
            ->groupby('secao', 'cargo')
            ->orderby('secao', 'ASC')
            ->get();

            $psvotos[$p->id] = DB::table('votos')
            ->select('votos.secao as secao', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
            ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
            ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 1]])
            ->groupby('votos.secao', 'candidatos.nome', 'cargo')
            ->orderby('votos', 'DESC')
            ->get();
        }
        return view('votos.resultados', ['periodos' => $periodos, 'pgeral' => $pgeral, 'pzonas' => $pzonas, 'pzvotos' => $pzvotos, 'psecoes' => $psecoes, 'psvotos' => $psvotos]);

    }
}
