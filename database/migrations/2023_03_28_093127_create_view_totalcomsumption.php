<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewTotalcomsumption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement( 'CREATE OR REPLACE VIEW Total_PConsumption AS
        SELECT UserID,MBxID,PcsID,SerialNo, DATE(Time) as x , MAX(PConsumption) - MIN(PConsumption) as y 
        FROM tbpcsinfo
        GROUP BY DATE(Time),SerialNo' );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement( 'DROP VIEW Total_PConsumption' );
    }
}
