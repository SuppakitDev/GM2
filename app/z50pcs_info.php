<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class z50pcs_info extends Model
{
    protected $table = 'z50pcs_info';
    protected $fillable = ['Site_ID','Comm_v','Model_t','SerialNo','Program_v','Pcs_status','Zeroexport','Reg_mode','Insp_test','Errorcode','RT_powerout','RT_poweraccum','Statuspowerfactor','Input_Vstr1','Input_Cstr1','Acvoltage_str1'
                          ,'Input_Vstr2','Input_Cstr2','Accurrent','Input_Vstr3','Input_Cstr3','Frequency','RT_powerfactor','Suppression','Recoverytime','Powermetervalue'];
    
    public function z50_sites()
    {
        return $this->belongsTo(z50_site::class,'Site_ID');    //11/05/61 : ที่จริงต้องเปลี่ยนเป็นเชื่อมด้วย serialnolist แต่การเก็บข้อมูลรวมกันใน 1 ฟิวเลยทำไม่ได้
    }

    public function model_types()
    {
        return $this->belongsTo(model_type::class,'Model_t');    
    }
    

    public function error_codes()
    {
        return $this->belongsTo(error_code::class,'Errorcode');    
    }

    public function suppression_descripts()
    {
        return $this->belongsTo(suppression_descript::class,'Suppression');    
    }

    public function insp_test_modes()
    {
        return $this->belongsTo(insp_test_mode::class,'Insp_test');    
    }

    public function reg_modes()
    {
        return $this->belongsTo(reg_mode::class,'Reg_mode');    
    }

    public function sts_pcss()
    {
        return $this->belongsTo(sts_pcs::class,'Pcs_status');    
    }

    public function sts_rt_pfs()
    {
        return $this->belongsTo(sts_rt_pf::class,'Statuspowerfactor');    
    }


}
