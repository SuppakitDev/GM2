<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\tbDDCStatusDescript;
use App\tbErrorDescript;
use App\tbDDC_TempCtrlDescript;
class tbPVinput extends Model
{
    protected $table = 'tbpvinput';

    protected $fillable = ['UserID','MBxID','PcsID','SerialNo','StringNo',
                           'ErrorCode','Status','TempCtrl','VCtrl','Vdc','Power'];


    public function tbDDCStatusDescripts(){
        return $this->belongsTo(tbDDCStatusDescript::class,'Status');
    }

    public function tbDDC_TempCtrlDescripts(){
        return $this->belongsTo(tbDDC_TempCtrlDescript::class,'TempCtrl');
    }

    public function tbDDC_VCtrlDescripts(){
        return $this->belongsTo(tbDDC_VCtrlDescript::class,'VCtrl');
    }

    public function tbErrorDescripts(){
        return $this->belongsTo(tbErrorDescript::class,'ErrorCode');
    }

    public function tbUserIDs(){
        return $this->belongsTo(tbUserID::class,'UserID');
    }
}
