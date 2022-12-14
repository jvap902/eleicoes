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

        if ($data['presidente'] == ""){
            $data['presidente'] = '0';
        }
        if ($data['governador'] == ""){
            $data['governador'] = '0';
        }
        if ($data['senador'] == ''){
            $data['senador'] = '0';
        }
        if ($data['deputado_federal'] == ''){
            $data['deputado_federal'] = '0';
        }
        if ($data['deputado_estadual'] == ''){
            $data['deputado_estadual'] = '0';
        }
        $periodo = $request->session()->get('periodo');


        $presidente = DB::table('candidatos')->where('numero', "=", $data['presidente'])->where('cargo', "=", 1)->where('periodo_id', "=", $periodo)->get();
        $governador = DB::table('candidatos')->where('numero', $data['governador'])->where('cargo', "=", 2)->where('periodo_id', "=", $periodo)->get();
        $senador = DB::table('candidatos')->where('numero', $data['senador'])->where('cargo', "=", 3)->where('periodo_id', "=", $periodo)->get();
        $deputado_federal = DB::table('candidatos')->where('numero', $data['deputado_federal'])->where('cargo', "=", 4)->where('periodo_id', "=", $periodo)->get();
        $deputado_estadual = DB::table('candidatos')->where('numero', $data['deputado_estadual'])->where('cargo', "=", 5)->where('periodo_id', "=", $periodo)->get();

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
            'presidente' => $presidente,
            'governador' => $governador,
            'senador' => $senador,
            'deputado_federal' => $deputado_federal,
            'deputado_estadual' => $deputado_estadual,
        ]);
    }

    function store(Request $request)
    {

        $data = $request->all();
        unset($data['_token']);

        $date = Carbon::now();
        $date->setTimezone('America/Rosario');
        $date = Carbon::parse($date)->format('Y-m-d H:i:s');
        $titulo = $request->session()->get('titulo');
        $zona = $request->session()->get('zona');
        $secao = $request->session()->get('secao');

        $eleitor = DB::table('eleitores')->where('titulo', $titulo)->select('id')->first();
        $periodo = DB::table('periodos')->whereRaw("data_inicio < '$date'")->whereRaw("data_fim > '$date'")->select('id')->first();

        DB::beginTransaction();

        try {
            DB::table('votantes')->insert([
                'eleitor_id' => $eleitor->id,
                'periodo_id' => $periodo->id
            ]);

            if (isset($data['presidente_id'])) {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->setTimezone('America/Rosario')->format('Y-m-d H:i:s'),
                    'candidato_id' => $data['presidente_id'],
                    'zona' => $zona,
                    'secao' => $secao
                ]);
            } else {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->setTimezone('America/Rosario')->format('Y-m-d H:i:s'),
                    'candidato_id' => 1,
                    'zona' => $zona,
                    'secao' => $secao
                ]);
            }

            if (isset($data['governador_id'])) {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->setTimezone('America/Rosario')->format('Y-m-d H:i:s'),
                    'candidato_id' => $data['governador_id'],
                    'zona' => $zona,
                    'secao' => $secao
                ]);
            } else {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->setTimezone('America/Rosario')->format('Y-m-d H:i:s'),
                    'candidato_id' => 2,
                    'zona' => $zona,
                    'secao' => $secao
                ]);
            }

            if (isset($data['senador_id'])) {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->setTimezone('America/Rosario')->format('Y-m-d H:i:s'),
                    'candidato_id' => $data['senador_id'],
                    'zona' => $zona,
                    'secao' => $secao
                ]);
            } else {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->setTimezone('America/Rosario')->format('Y-m-d H:i:s'),
                    'candidato_id' => 3,
                    'zona' => $zona,
                    'secao' => $secao
                ]);
            }

            if (isset($data['deputado_federal_id'])) {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->setTimezone('America/Rosario')->format('Y-m-d H:i:s'),
                    'candidato_id' => $data['deputado_federal_id'],
                    'zona' => $zona,
                    'secao' => $secao
                ]);
            } else {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->setTimezone('America/Rosario')->format('Y-m-d H:i:s'),
                    'candidato_id' => 4,
                    'zona' => $zona,
                    'secao' => $secao
                ]);
            }

            if (isset($data['deputado_estadual_id'])) {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->setTimezone('America/Rosario')->format('Y-m-d H:i:s'),
                    'candidato_id' => $data['deputado_estadual_id'],
                    'zona' => $zona,
                    'secao' => $secao
                ]);
            } else {
                DB::table('votos')->insert([
                    'data' => Carbon::now()->setTimezone('America/Rosario')->format('Y-m-d H:i:s'),
                    'candidato_id' => 5,
                    'zona' => $zona,
                    'secao' => $secao
                ]);
            }

            $request->session()->forget('voto');

            DB::commit();

            $confirma = "Voto confirmado!";

            return view('votos.comprovante', [
                "confirma" => $confirma
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            $erro = "Aconteceu um erro ao processar o seu voto. Tente novamente!";

            return view('votos.comprovante', [
                "erro" => $erro
            ]);
        }

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

        if (isset($info[0])) {
            $zona = $info[0]->zona;
            $secao = $info[0]->secao;

            $titulo = $data['titulo'];
            $valido = $votou = $ativo = false;
            $eleitores = DB::table('eleitores')->get();
            $votantes = DB::table('votantes')->get();
            $periodos = DB::table('periodos')->get();
            $hoje = Carbon::now()->setTimezone('America/Rosario');
            $hoje = Carbon::parse($hoje)->format('Y-m-d H:i:s');
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
                                $request->session()->put('titulo',  $data['titulo']);
                                $request->session()->put('zona',  $zona);
                                $request->session()->put('secao',  $secao);
                                $request->session()->put('periodo', $pid);
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
                $erro = "Este t??tulo n??o est?? cadastrado!";
                return view('/votos/titulo', ['erro' => $erro]);
            } elseif (!$ativo) {
                $erro = "N??o h?? nenhum per??odo ativo no momento!";
                return view('/votos/titulo', ['erro' => $erro]);
            } elseif ($votou) {
                $erro = "N??o ?? poss??vel votar mais de uma vez em um per??odo!";
                return view('/votos/titulo', ['erro' => $erro]);
            }
        } else {
            $erro = "Este t??tulo n??o est?? cadastrado";
            return view('/votos/titulo', ['erro' => $erro]);
        }
    }

    function resultados()
    {
        $pgeral = $pzonas = $pzvotos = $psecoes = $psvotos = [];
        $ggeral = $gzonas = $gzvotos = $gsecoes = $gsvotos = [];
        $sgeral = $szonas = $szvotos = $ssecoes = $ssvotos = [];
        $dfgeral = $dfzonas = $dfzvotos = $dfsecoes = $dfsvotos = [];
        $degeral = $dezonas = $dezvotos = $desecoes = $desvotos = [];
        $periodos = DB::table('periodos')->orderby('data_fim', 'DESC')->get();
        foreach ($periodos as $p) {
            // PRESIDENTES
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

            // GOVERNADORES
            $ggeral[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 2]])
                ->groupby('candidatos.nome', 'cargo')
                ->orderby('votos', 'DESC')
                ->get();
            $gzonas[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'votos.zona as zona')
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 2]])
                ->groupby('zona', 'cargo')
                ->orderby('zona', 'ASC')
                ->get();
            $gzvotos[$p->id] = DB::table('votos')
                ->select('votos.zona as zona', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 2]])
                ->groupby('votos.zona', 'candidatos.nome', 'cargo')
                ->orderby('votos', 'DESC')
                ->get();
            $gsecoes[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'votos.secao as secao')
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 2]])
                ->groupby('secao', 'cargo')
                ->orderby('secao', 'ASC')
                ->get();
            $gsvotos[$p->id] = DB::table('votos')
                ->select('votos.secao as secao', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 2]])
                ->groupby('votos.secao', 'candidatos.nome', 'cargo')
                ->orderby('votos', 'DESC')
                ->get();

            // SENADORES
            $sgeral[$p->id] = DB::table('votos')
            ->select('candidatos.cargo as cargo', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
            ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
            ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 3]])
            ->groupby('candidatos.nome', 'cargo')
            ->orderby('votos', 'DESC')
            ->get();
            $szonas[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'votos.zona as zona')
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 3]])
                ->groupby('zona', 'cargo')
                ->orderby('zona', 'ASC')
                ->get();
            $szvotos[$p->id] = DB::table('votos')
                ->select('votos.zona as zona', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 3]])
                ->groupby('votos.zona', 'candidatos.nome', 'cargo')
                ->orderby('votos', 'DESC')
                ->get();
            $ssecoes[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'votos.secao as secao')
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 3]])
                ->groupby('secao', 'cargo')
                ->orderby('secao', 'ASC')
                ->get();
            $ssvotos[$p->id] = DB::table('votos')
                ->select('votos.secao as secao', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 3]])
                ->groupby('votos.secao', 'candidatos.nome', 'cargo')
                ->orderby('votos', 'DESC')
                ->get();

            // DEPUTADO FEDERAL
            $dfgeral[$p->id] = DB::table('votos')
            ->select('candidatos.cargo as cargo', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
            ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
            ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 4]])
            ->groupby('candidatos.nome', 'cargo')
            ->orderby('votos', 'DESC')
            ->get();
            $dfzonas[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'votos.zona as zona')
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 4]])
                ->groupby('zona', 'cargo')
                ->orderby('zona', 'ASC')
                ->get();
            $dfzvotos[$p->id] = DB::table('votos')
                ->select('votos.zona as zona', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 4]])
                ->groupby('votos.zona', 'candidatos.nome', 'cargo')
                ->orderby('votos', 'DESC')
                ->get();
            $dfsecoes[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'votos.secao as secao')
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 4]])
                ->groupby('secao', 'cargo')
                ->orderby('secao', 'ASC')
                ->get();
            $dfsvotos[$p->id] = DB::table('votos')
                ->select('votos.secao as secao', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 4]])
                ->groupby('votos.secao', 'candidatos.nome', 'cargo')
                ->orderby('votos', 'DESC')
                ->get();

            // DEPUTADO ESTADUAL
            $degeral[$p->id] = DB::table('votos')
            ->select('candidatos.cargo as cargo', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
            ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
            ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 5]])
            ->groupby('candidatos.nome', 'cargo')
            ->orderby('votos', 'DESC')
            ->get();
            $dezonas[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'votos.zona as zona')
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 5]])
                ->groupby('zona', 'cargo')
                ->orderby('zona', 'ASC')
                ->get();
            $dezvotos[$p->id] = DB::table('votos')
                ->select('votos.zona as zona', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 5]])
                ->groupby('votos.zona', 'candidatos.nome', 'cargo')
                ->orderby('votos', 'DESC')
                ->get();
            $desecoes[$p->id] = DB::table('votos')
                ->select('candidatos.cargo as cargo', 'votos.secao as secao')
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 5]])
                ->groupby('secao', 'cargo')
                ->orderby('secao', 'ASC')
                ->get();
            $desvotos[$p->id] = DB::table('votos')
                ->select('votos.secao as secao', 'candidatos.nome as nome', DB::raw('count(votos.candidato_id) as votos'))
                ->leftjoin('candidatos', 'votos.candidato_id', '=', 'candidatos.id')
                ->where([['votos.data', '<=', $p->data_fim], ['votos.data', '>=', $p->data_inicio], ['cargo', '=', 5]])
                ->groupby('votos.secao', 'candidatos.nome', 'cargo')
                ->orderby('votos', 'DESC')
                ->get();

        }
        return view('votos.resultados', ['periodos' => $periodos,
        'pgeral' => $pgeral, 'pzonas' => $pzonas, 'pzvotos' => $pzvotos, 'psecoes' => $psecoes, 'psvotos' => $psvotos,
        'ggeral' => $ggeral, 'gzonas' => $gzonas, 'gzvotos' => $gzvotos, 'gsecoes' => $gsecoes, 'gsvotos' => $gsvotos,
        'sgeral' => $sgeral, 'szonas' => $szonas, 'szvotos' => $szvotos, 'ssecoes' => $ssecoes, 'ssvotos' => $ssvotos,
        'dfgeral' => $dfgeral, 'dfzonas' => $dfzonas, 'dfzvotos' => $dfzvotos, 'dfsecoes' => $dfsecoes, 'dfsvotos' => $dfsvotos,
        'degeral' => $degeral, 'dezonas' => $dezonas, 'dezvotos' => $dezvotos, 'desecoes' => $desecoes, 'desvotos' => $desvotos
        ]);
    }
}
