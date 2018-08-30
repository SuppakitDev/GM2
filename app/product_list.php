<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class product_list extends Model
{
    protected $table = "product_list";
    protected $fillable = ['id','P_Name','P_Model','Comment','P_img','spec'];

    public function users()
    {
        return $this->hasMany(User::class,'P_ID');
    }
}
