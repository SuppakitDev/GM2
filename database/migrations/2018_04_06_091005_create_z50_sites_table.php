<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZ50SitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z50_site', function (Blueprint $table) {
            $table->increments('Site_ID');
            $table->integer('C_ID')->unsigned();
            $table->foreign('C_ID')->references('id')->on('Client_company');
            $table->string('SiteName');
            $table->string('Site_img')->nullable()->default('nopic.jpg');
            $table->string('Email');
            $table->string('INVModel',20);
            $table->string('Tal',10);
            $table->text('Address');
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
        Schema::dropIfExists('z50_site');
    }
}
