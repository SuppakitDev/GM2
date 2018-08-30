<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbSuppressionDescript extends Model
{
    protected $table = 'tbSuppressionDescript';

    protected $fillable = ['INVModel','SupressionStatus','Descript'];

    protected $primaryKey = 'SupressionStatus';

    public function tbPCSInfos()
    {
        return $this->hasMany(tbPCSInfo::class,'PSuppression');
    }
    public function tbPCSInfo_T()
    {
        return $this->hasMany(tbPCSInfo::class,'TempSuppression');
    }
    public function tbPCSInfo_V()
    {
        return $this->hasMany(tbPCSInfo::class,'VSuppression');
    }
}
