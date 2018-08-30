<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbPCSInfo extends Model
{
    protected $table = 'tbPCSInfo';
    protected $fillable = ['UserID','MBxID','PcsID','SerialNo','ErrorCode',
                           'PcsStatus','Vac','Iac','Pac','AcFreq','VdcBus',
                           'PCtrlRate','PSuppression','VSuppression','TempSuppression',
                           'PConsumption','INVTemp','NumberOfString','created_at'
                          ];
    
    public function tbSuppressionDescripts(){
        return $this->belongsTo(tbSuppressionDescript::class,'PSuppression');
    }
    public function tbPcsStatusDescripts(){
        return $this->belongsTo(tbPcsStatusDescript::class,'PcsStatus');
    }
    public function tbSuppressionDescript_T(){
        return $this->belongsTo(tbSuppressionDescript::class,'TempSuppression');
    }
    public function tbSuppressionDescript_V(){
        return $this->belongsTo(tbSuppressionDescript::class,'VSuppression');
    }
    public function tbErrorDescripts(){
        return $this->belongsTo(tbErrorDescript::class,'ErrorCode');
    }
    public function tbUserIDs(){
        return $this->belongsTo(tbUserID::class,'UserID');
    }
    
}
