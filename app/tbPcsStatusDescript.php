<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbPcsStatusDescript extends Model
{
    protected $table = 'tbPcsStatusDescript';

    protected $fillable = ['INVModel','Status','Descript'];

    protected $primaryKey = 'Status';

    public function tbPCSInfos(){
        return $this->hasMany(tbPCSInfo::class,'PcsStatus');
    }
}
