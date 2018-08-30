<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Product_list', function(Blueprint $table){
            $table->increments('id',3);
            $table->string('P_Name',45)->unique();
            $table->string('P_Model',45);
            $table->string('P_Img',50);
            $table->string('spec',50);
            $table->longText('Comment');
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
        Schema::drop('product_list');
        
    }
}
