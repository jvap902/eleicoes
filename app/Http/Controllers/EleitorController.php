<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class EleitorController extends Controller
{
    function index(){
        $eleitores = DB::table('eleitores')
        ->select()
        ->get();

        return view('eleitores.index', [
            'eleitores' => $eleitores
        ]);
    }

    function create(){
        return view('eleitores.create');
    }

    function store(Request $request){
        $data = $request->all();
        unset($data['_token']);
        $titulos = DB::table('eleitores')->select('titulo')->get();
        if($data['nome'] && $data['titulo'] && $data['zona'] && $data['secao']){
            foreach($titulos as $t){
                if($t == $data['titulo']){
                    return view('/eleitores/create', ['erro' => "Este título já está registrado"]);
                }
            }
            DB::table('eleitores')->insert($data);

            return redirect('/eleitores');
        }else{
            return view('/eleitores/create', ['erro' => "Preencha todos os campos"]);
        }

        
    }

    function edit($id){
        $eleitor = DB::table('eleitores')
        ->find($id);

        return view('eleitores.edit', [
            'eleitor' => $eleitor
        ]);
    }

    function update(Request $request){
        $data = $request->all();
        unset($data['_token']);

        $id = array_shift($data);

        DB::table('eleitores')
        ->where('id', $id)
        ->update($data);

        return redirect('/eleitores');
    }

    function destroy($id){
        try{
            DB::table('eleitores')
            ->where('id', $id)
            ->delete();
    
            return redirect('/eleitores');
        }catch(Exception $e){
            $eleitores = DB::table('eleitores')
            ->select()
            ->orderby('id', 'DESC')
            ->get();
            return view('/eleitores.index', ['eleitores' => $eleitores, 'erro' => "Este eleitor não pode ser excluído."]);
        }

    }

    function show($id){
        $eleitor = DB::table('eleitores')
        ->find($id);

        return view('eleitores.show', ['eleitor' => $eleitor]);
    }
}

