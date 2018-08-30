<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\client_company;
class z50_site extends Model
{
    protected $table = 'z50_site';
    protected $fillable = ['Site_ID','C_ID','SiteName','Site_img','Email','INVModel','Tal','Address','SerialNolist','FIT','Co2_Criterion','Notifytoken'];
    protected $primaryKey = 'Site_ID';

    public function z50pcs_infos()
    {
        return $this->hasMany(z50pcs_info::class,'Site_ID');
    }

    public function client_companyz50()
    {
        return $this->belongsTo(client_company::class,'C_ID');
    }
        
    public function users(){
        return $this->hasOne(User::class,'Site_ID');
    }
}
    