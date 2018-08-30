<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\tbUserID;
use App\z50_site;


class client_company extends Model
{
    protected $table = 'client_company';

    protected $fillable = ['id','C_Name','Startdate','Tel','Email','Address'];
    
    
        public function users(){
            return $this->hasMany(User::class,'C_ID');
        }

        public function tbUserIDs()
        {
            return $this->hasMany(tbUserID::class,'C_ID');
        }

        public function z50_sites()
        {
            return $this->hasMany(z50_site::class,'C_ID');
        }
}
