<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    function index() {
        $candidatos = DB::table('candidatos')->select()->get();

        return view('candidatos.index', [
            'candidatos' => $candidatos
        ]);
    }

    function store(Request $request) {
        $data = $request->all();
        DB::table('candidatos')->insert($data);

        return redirect('/candidatos');
    }

    function create() {
        return view('candidatos.create');
    }

    function edit($id) {
        $candidato = DB::table('candidatos')->find($id);

        return view('candidatos.edit', [
            'candidato' => $candidato
        ]);
    }

    function update(Request $request) {
        $data = $request->all();
        $id = array_shift($data);

        DB::table('candidatos')->where('id', $id)->update($data);

        return redirect('/candidatos');
    }

    function destroy($id){
        DB::table('candidatos')->where('id', $id)->destroy();

        return redirect('/candidatos');
    }
}
