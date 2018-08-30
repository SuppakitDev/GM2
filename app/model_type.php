<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_type extends Model
{
    protected $table = 'model_type';
    protected $fillable = ['Model_t','Descript'];
    protected $primaryKey = 'Model_t';
    public $incrementing = false;

    public function z50pcs_infos()
    {
        return $this->hasMany(z50pcs_info::class,'Model_t');
    }
}
