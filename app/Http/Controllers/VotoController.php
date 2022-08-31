<?php

namespace App\Http\Controllers;

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

        return redirect('/home');
    }
}
