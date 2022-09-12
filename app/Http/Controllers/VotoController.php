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

        if (isset($presidente[0])) {
            $presidente = $presidente[0];
        } else {
            $presidente = null;
        }

        if (isset($governador[0])) {
            $governador = $governador[0];
        } else {
            $governador = null;
        }

        if (isset($senador[0])) {
            $senador = $senador[0];
        } else {
            $senador = null;
        }

        if (isset($deputado_federal[0])) {
            $deputado_federal = $deputado_federal[0];
        } else {
            $deputado_federal = null;
        }

        if (isset($deputado_estadual[0])) {
            $deputado_estadual = $deputado_estadual[0];
        } else {
            $deputado_estadual = null;
        }

        return view('votos.confirmar', [
            'titulo' => $data['titulo'],
            'presidente' => $presidente,
            'governador' => $governador,
            'senador' => $senador,
            'deputado_federal' => $deputado_federal,
            'deputado_estadual' => $deputado_estadual,
            'zona' => $data['zona'],
            'secao' => $data['secao']
        ]);
    }

    function store(Request $request)
    {

        $data = $request->all();
        unset($data['_token']);

        $date = Carbon::now();
        $date->setTimezone('America/Rosario');

        $eleitor = DB::table('eleitores')->where('titulo', $data['titulo'])->select('id')->first();
        $periodo = DB::table('periodos')->whereRaw("data_inicio < '$date'")->whereRaw("data_fim > '$date'")->select('id')->first();

        DB::transaction(function () use (&$data, &$request, &$eleitor, &$periodo) {

            DB::table('votantes')->insert([
                'eleitor_id' => $eleitor->id,
                'periodo_id' => $periodo->id
            ]);

            if (isset($data['presidente_id'])) {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->format('Y-m-d H:i:s'), // ver o format
                    'candidato_id' => $data['presidente_id'],
                    'zona' => $data['zona'],
                    'secao' => $data['secao']
                ]);
            }

            if (isset($data['governador_id'])) {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->format('Y-m-d H:i:s'),
                    'candidato_id' => $data['governador_id'],
                    'zona' => $data['zona'],
                    'secao' => $data['secao']
                ]);
            }

            if (isset($data['senador_id'])) {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->format('Y-m-d H:i:s'),
                    'candidato_id' => $data['senador_id'],
                    'zona' => $data['zona'],
                    'secao' => $data['secao']
                ]);
            }

            if (isset($data['deputado_federal_id'])) {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->format('Y-m-d H:i:s'),
                    'candidato_id' => $data['deputado_federal_id'],
                    'zona' => $data['zona'],
                    'secao' => $data['secao']
                ]);
            }

            if (isset($data['deputado_estadual_id'])) {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->format('Y-m-d H:i:s'),
                    'candidato_id' => $data['deputado_estadual_id'],
                    'zona' => $data['zona'],
                    'secao' => $data['secao']
                ]);
            }

            $request->session()->forget('voto');
        });

        return redirect('/');
    }

    function titulo()
    {
        return view('votos.titulo');
    }

    function validar(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        $info = DB::table('eleitores')->where('titulo', $data['titulo'])->get();
        $zona = $info[0]->zona;
        $secao = $info[0]->secao;

        $titulo = $data['titulo'];
        $valido = $votou = $ativo = false;
        $eleitores = DB::table('eleitores')->get();
        $votantes = DB::table('votantes')->get();
        $periodos = DB::table('periodos')->get();
        $hoje = Carbon::now()->format('Y-m-d H:i:s');
        $pid = $eid = $erro = null;

        foreach ($eleitores as $e) {
            if ($e->titulo == $titulo) {
                $eid = $e->id;
                $valido = true;
                foreach ($periodos as $p) {
                    if ($hoje >= $p->data_inicio && $hoje <= $p->data_fim) {
                        $pid = $p->id;
                        $ativo = true;
                        foreach ($votantes as $v) {
                            if ($pid == $v->periodo_id && $eid == $v->eleitor_id) {
                                $votou = true;
                                break;
                            }
                        }
                        if (!$votou) {
                            $request->session()->put('voto',  true);
                            return view('/votos/create', [
                                "zona" => $zona,
                                "secao" => $secao,
                                'titulo' => $data['titulo']
                            ]);
                        }
                        break;
                    }
                }
                break;
            }
        }
        if (!$valido) {
            $erro = "Este título não está cadastrado!";
        } elseif (!$ativo) {
            $erro = "Não há nenhum período ativo no momento!";
        } elseif ($votou) {
            $erro = "Não é possível votar mais de uma vez em um período!";
        }
        return view('/votos/titulo', ['erro' => $erro]);
    }

    function resultados()
    {
        $pgeral = $pzonas = $pzvotos = $psecoes = $psvotos = [];
        $periodos = DB::table('periodos')->orderby('data_fim', 'DESC')->get();
        foreach ($periodos as $p) {
            $pgeral[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 1]])
                ->groupby('candidatos.nome', 'cargo')
                ->orderby('votos', 'DESC')
                ->get();

            $pzonas[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'votos.zona as zona')
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

            $psecoes[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'votos.secao as secao')
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
