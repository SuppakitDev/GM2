<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reg_mode extends Model
{
    protected $table = 'reg_mode';
    protected $fillable = ['Reg_mode','Descript'];
    protected $primaryKey = 'Reg_mode';
    public $incrementing = false;

    public function z50pcs_infos()
    {
        return $this->hasMany(z50pcs_info::class,'Reg_mode');
    }
}
