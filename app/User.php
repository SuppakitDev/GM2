<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\product_list;
use App\client_company;
use App\tbUserID;
use App\z50_site;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','username','email','password','Fname','Lname','Tel','image','CreateBy','C_ID','SerialNoitem','B_ID','Status','P_ID','List_DeptID','Site_ID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function product_lists()
    {
        return $this->belongsTo(product_list::class,'P_ID');
    }

    public function client_companys()
    {
        return $this->belongsTo(client_company::class,'C_ID');
    }
    public function tbUserIDs()
    {
        return $this->hasOne(tbUserID::class,'UserID');
    }

    public function z50_sites()
    {
        return $this->hasOne(z50_site::class,'Site_ID');
    }

}
