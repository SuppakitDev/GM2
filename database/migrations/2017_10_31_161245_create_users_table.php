<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('Fname',45);//อาจแก้ไข ใส่สำรองไว้
            $table->string('Lname',45);
            $table->string('Tel',10);
            $table->string('image',100)->default('nopic.jpg');
            $table->integer('CreateBy');
            $table->integer('C_ID')->unsigned();
            $table->string('SerialNoitem');
            $table->foreign('C_ID')->references('id')->on('Client_company')->unique();    
            $table->enum('Status', array('ADMIN','MANAGER','USER'));
            $table->integer('P_ID')->unsigned();            
            $table->foreign('P_ID')->references('id')->on('Product_list');
            $table->integer('Site_ID')->unsigned()->nullable();
            $table->foreign('Site_ID')->references('UserID')->on('tbUserID');            
            $table->rememberToken();            
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
        Schema::dropIfExists('users');
    }
}
