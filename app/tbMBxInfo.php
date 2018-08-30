<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbMBxInfo extends Model
{
    protected $table = 'tbMBxInfo';
    protected $fillable = ['UserID','MBxID','SRI','OutsideTemp','ErrorCode'];

    public function tbErrorDescripts(){
        return $this->belongsTo(tbErrorDescript::class,'ErrorCode');
    }

    public function tbUserIDs(){
        return $this->belongsTo(tbUserID::class,'UserID');
    }
}
