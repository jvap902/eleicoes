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
                if($t->titulo == $data['titulo']){
                    return view('/eleitores/create', ['erro' => "Este título já está registrado"]);
                }
            }
            if(strlen($data['titulo']) != 12){
                return view('/eleitores/create', ['erro' => "Este título não é válido!"]);
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

        $eleitor = DB::table('eleitores')
        ->find($id);

        $titulos = DB::table('eleitores')->select('titulo')->where('id', "!=", $id)->get();
        if($data['nome'] && $data['titulo'] && $data['zona'] && $data['secao']){
            foreach($titulos as $t){
                if($t->titulo == $data['titulo']){
                    return view('/eleitores/edit', ['erro' => "Este título já está registrado", 'eleitor' => $eleitor]);
                }
            }
            if(strlen($data['titulo']) != 12){
                return view('/eleitores/edit', ['erro' => "Este título não é válido!", 'eleitor' => $eleitor]);
            }
            DB::table('eleitores')
                ->where('id', $id)
                ->update($data);
        
                return redirect('/eleitores');
        }else{
            return view('/eleitores/edit', ['erro' => "Preencha todos os campos", 'eleitor' => $eleitor]);
        }
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

