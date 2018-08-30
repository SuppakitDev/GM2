<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbErrorLog extends Model
{
    protected $table = 'tbErrorLog';
    protected $fillable = ['UserID','MBxID','PcsID','SerialNo','ErrorCode','Duration'];

    public function tbUserIDs(){
        return $this->belongsTo(tbUserID::class,'UserID');
    }

    public function tbErrorDescripts(){
        return $this->belongsTo(tbErrorDescript::class,'ErrorCode');
    }
}
