<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class error_code extends Model
{
    protected $table = 'error_code';
    protected $fillable = ['Errorcode','Descript'];
    protected $primaryKey = 'Errorcode';
    public $incrementing = false;

    public function z50pcs_infos()
    {
        return $this->hasMany(z50pcs_info::class,'Errorcode');
    }
}
