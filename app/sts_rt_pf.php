<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sts_rt_pf extends Model
{
    protected $table = 'sts_rt_pf';
    protected $fillable = ['Statuspowerfactor','Descript'];
    protected $primaryKey = 'Statuspowerfactor';
    public $incrementing = false;

    public function z50pcs_infos()
    {
        return $this->hasMany(z50pcs_info::class,'Statuspowerfactor');
    }
}
