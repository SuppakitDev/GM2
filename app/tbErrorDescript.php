<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\tbPVinput;
class tbErrorDescript extends Model
{
    protected $table = 'tbErrorDescript';

    protected $fillable = ['INVModel','ErrorCode','Descript'];

    protected $primaryKey = 'ErrorCode';

    public $incrementing = false;
    public $keyType = 'string'; //ในกรณีที่ primary key เป็น String

    public function tbPVinputs(){
        return $this->hasMany(tbPVinput::class,'ErrorCode');
    }

    public function tbErrorLogs(){
        return $this->hasMany(tbErrorLog::class,'ErrorCode');
    }

    public function tbPCSInfos(){
        return $this->hasMany(tbPCSInfo::class,'ErrorCode');
    }

    public function tbMBxInfo(){
        return $this->hasMany(tbMBxInfo::class,'ErrorCode');
    }
}
