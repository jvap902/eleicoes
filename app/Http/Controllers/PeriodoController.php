<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodoController extends Controller
{
    function index() {
        $periodos = DB::table('periodos')
        ->select()
        ->orderby('data_inicio', 'DESC')
        ->get();

        return view('periodos.index', [
            'periodos' => $periodos
        ]);
    }

    function create() {
        return view ('periodos.create');
    }

    function store(Request $request) {
        $data = $request->all();
        unset($data['_token']);

        DB::table('periodos')->insert($data);
        return redirect('/periodos');
    }

    function edit($id){
        $periodo = DB::table('periodos')
        ->find($id);

        return view('periodos.edit', [
            'periodo' => $periodo
        ]);
    }

    function update(Request $request){
        $data = $request->all();
        unset($data['_token']);

        $id = array_shift($data);

        DB::table('periodos')
        ->where('id', $id)
        ->update($data);

        return redirect('/periodos');
    }

    function destroy($id){
        DB::table('periodos')
        ->where('id', $id)
        ->delete();

        return redirect('/periodos');
    }

    function show($id){
        $periodo = DB::table('periodos')
        ->find($id);

        return view('periodos.show', ['periodo' => $periodo]);
    }
}
