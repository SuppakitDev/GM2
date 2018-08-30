<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class insp_test_mode extends Model
{
    protected $table = 'insp_test_mode';
    protected $fillable = ['Insp_test','Descript'];
    protected $primaryKey = 'Insp_test';
    public $incrementing = false;

    public function z50pcs_infos()
    {
        return $this->hasMany(z50pcs_info::class,'Insp_test');
    }
}
