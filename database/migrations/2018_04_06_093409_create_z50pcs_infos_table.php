<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZ50pcsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z50pcs_info', function (Blueprint $table) {
            $table->integer('Site_ID')->unsigned();
            $table->foreign('Site_ID')->references('Site_ID')->on('z50_site');
            $table->string('Comm_v',1);
            $table->string('Model_t',4);
            $table->foreign('Model_t',4)->references('Model_t')->on('model_type');            
            $table->string('SerialNo',10);
            $table->string('Program_v',8);
            $table->string('Pcs_status',1);
            $table->string('Zeroexport',2);
            
            $table->foreign('Pcs_status')->references('Pcs_status')->on('sts_pcs');  
            $table->string('Reg_mode',1);
            $table->foreign('Reg_mode')->references('Reg_mode')->on('reg_mode');              
            $table->string('Insp_test',1);
            $table->foreign('Insp_test')->references('Insp_test')->on('insp_test_mode');                          
            $table->string('Errorcode',4);
            $table->foreign('Errorcode')->references('Errorcode')->on('error_code'); 
            $table->integer('RT_powerout')->unsigned();            
            $table->bigInteger('RT_poweraccum')->unsigned();  
            $table->string('Statuspowerfactor',1);
            $table->foreign('Statuspowerfactor')->references('Statuspowerfactor')->on('sts_rt_pf');
            $table->integer('Input_Vstr1')->unsigned();            
            $table->float('Input_Cstr1')->unsigned();    
            $table->integer('Acvoltage_str1')->unsigned();   
            $table->integer('Input_Vstr2')->unsigned();            
            $table->float('Input_Cstr2')->unsigned();    
            $table->integer('Accurrent')->unsigned(); 
            $table->integer('Input_Vstr3')->unsigned();            
            $table->float('Input_Cstr3')->unsigned(); 
            $table->integer('Frequency')->unsigned(); 
            $table->integer('RT_powerfactor')->unsigned();     
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
        Schema::dropIfExists('z50pcs_info');
    }
}
