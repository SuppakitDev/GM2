<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\tbPVinput;
class tbDDCStatusDescript extends Model
{
    protected $table = 'tbDDCStatusDescript';

    protected $fillable = ['INVModel','Status','Descript'];

    protected $primaryKey = 'Status';

    public function tbPVinputs(){
        return $this->hasMany(tbPVinput::class,'Status');
    }
}
