<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodoController extends Controller
{
    function index() {
        $periodos = DB::table('periodos')
        ->select()
        ->get();

        return view('periodos.index', [
            'periodos' => $periodos
        ]);
    }

    function create() {
        
    }
}
