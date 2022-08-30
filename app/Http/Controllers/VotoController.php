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
}
