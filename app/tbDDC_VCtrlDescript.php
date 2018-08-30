<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbDDC_VCtrlDescript extends Model
{
    protected $table = 'tbDDC_VCtrlDescript';

    protected $fillable = ['INVModel','VCtrl','Descript'];

    protected $primaryKey = 'VCtrl';

    public function tbPVinputs(){
        return $this->hasMany(tbPVinput::class,'VCtrl');
    }
}
