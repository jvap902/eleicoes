<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('candidatos')->where('id', '=', 1)->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
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
};
