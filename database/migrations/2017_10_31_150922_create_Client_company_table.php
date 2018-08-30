<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Client_company', function(Blueprint $table){
            $table->increments('id',3);
            $table->string('C_Name',45)->unique();
            $table->date('Startdate');
            $table->string('Tel',10);
            $table->string('Email',45);
            $table->longText('Address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('client_company');
    }
}
