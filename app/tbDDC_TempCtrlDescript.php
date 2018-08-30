<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbDDC_TempCtrlDescript extends Model
{
    protected $table = 'tbDDC_TempCtrlDescript';

    protected $fillable = ['INVModel','TempCtrl','Descript'];

    protected $primaryKey = 'TempCtrl';

    public function tbPVinputs(){
        return $this->hasMany(tbPVinput::class,'TempCtrl');
    }
}
