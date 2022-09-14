<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::table('periodos')->insert(
            array(
                'id' => 1,
                'nome' => 1,
                'data_inicio' => '0001-01-01 00:00:00',
                'data_fim' => '9999-12-31 23:59:59',
            )
        );

        DB::table('candidatos')->insert(
            array(
                'id' => 1,
                'nome' => "Nulo",
                'partido' => '',
                'numero' => 0,
                'cargo' => 0,
                'periodo_id' => '1'
            )
        );
    }

    public function down()
    {
        //
    }
};
