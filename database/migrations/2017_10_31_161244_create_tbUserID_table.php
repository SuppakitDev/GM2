<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbUserIDTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbUserID', function (Blueprint $table) {
            $table->increments('UserID')->unsigned();
            $table->integer('C_ID')->unsigned();
            $table->foreign('C_ID')->references('id')->on('Client_company');
            $table->string('SiteName');
            $table->string('SiteImg')->nullable()->default('nopic.jpg');
            $table->decimal('FIT',19,4);
            $table->decimal('Capacity',11,1);
            $table->string('InstallationType',50)->nullable();
            $table->string('INVModel',50);
            $table->string('Email')->nullable();
            $table->boolean('SRI_sensor',50)->nullable();
            $table->boolean('Temp_sensor',50)->nullable();
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
        Schema::dropIfExists('tbUserID');
    }
}
