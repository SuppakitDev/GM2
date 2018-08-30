<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sts_pcs extends Model
{
    protected $table = 'sts_pcs';
    protected $fillable = ['Pcs_status','Descript'];
    protected $primaryKey = 'Pcs_status';
    public $incrementing = false;

    public function z50pcs_infos()
    {
        return $this->hasMany(z50pcs_info::class,'Pcs_status');
    }
}
