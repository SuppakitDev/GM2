<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sum_of_z50info extends Model
{
    protected $table = 'sum_of_z50info';
    protected $fillable = ['ID','Site_ID','Powerout_Total','Poweraccum_Total','Tranfer_status','Pcs_status','Zeroexport','SerialNolist','RT_powerout','RT_poweraccum','Created_at'];
}
