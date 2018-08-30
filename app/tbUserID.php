<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\client_company;

class tbUserID extends Model
{
    protected $table  = 'tbUserID';

    protected $primaryKey  = 'UserID';

    protected $fillable = [
                            'UserID','C_ID','SiteName','FIT','Capacity',
                            'InstallationType','INVModel','Email','SRI_sensor',
                            'Temp_sensor'
                          ];
    
    public function users(){
        return $this->hasOne(User::class,'Site_ID');
    }
    public function client_companys()
    {
        return $this->belongsTo(client_company::class,'C_ID');
    }

    public function tbPVinputs(){
        return $this->hasMany(tbPVinput::class,'UserID');
    }

    public function tbErrorLogs(){
        return $this->hasMany(tbErrorLog::class,'UserID');
    }
    public function tbPCSInfos(){
        return $this->hasMany(tbPCSInfos::class,'UserID');
    }

    public function tbMBxInfos(){
        return $this->hasMany(tbMBxInfo::class,'UserID');
    }
}
