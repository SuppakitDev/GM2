<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suppression_descript extends Model
{
    protected $table = 'suppression_descript';
    protected $fillable = ['Suppressioncode','Descript'];
    protected $primaryKey = 'Suppressioncode';
    public $incrementing = false;

    public function z50pcs_infos()
    {
        return $this->hasMany(z50pcs_info::class,'Suppressioncode');
    }
}
