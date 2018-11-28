<?php

namespace App\Http\Controllers;
use App\z50pcs_info;
use App\z50_site;
use DB;
use DateTime;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\sum_of_z50info;
use App\error_code;
use App\model_type;
use App\tbUserID;
use App\product_list;
use App\z50restarthistory;
use App\User;
use Excel;
use Auth;
use Jcf\Geocode\Geocode;
use Illuminate\Support\Facades\Redirect;

class APIController extends Controller
{
   
    public function Z50APIINSERT(){
        $Site_ID                = Input::get('Site_ID');
        $Comm_v                 = Input::get('Comm_v');
        $Model_t                = Input::get('Model_t');
        $SerialNo               = Input::get('SerialNo');
        $Program_v              = Input::get('Program_v');
        $Pcs_status             = Input::get('Pcs_status');
        $Reg_mode               = Input::get('Reg_mode');
        $Insp_test              = Input::get('Insp_test');
        $Errorcode              = Input::get('Errorcode');
        $RT_powerout_Buf        = Input::get('RT_powerout');
        $RT_poweraccum_Buf      = Input::get('RT_poweraccum');
        $Statuspowerfactor      = Input::get('Statuspowerfactor');
        $Input_Vstr1            = Input::get('Input_Vstr1');
        $Input_Cstr1_Buf        = Input::get('Input_Cstr1');
        $Acvoltage_str1	        = Input::get('Acvoltage_str1');
        $Input_Vstr2            = Input::get('Input_Vstr2');
        $Input_Cstr2_Buf        = Input::get('Input_Cstr2');
        $Accurrent_Buf          = Input::get('Accurrent');
        $Input_Vstr3            = Input::get('Input_Vstr3');
        $Input_Cstr3_Buf        = Input::get('Input_Cstr3');
        $Frequency_Buf          = Input::get('Frequency');
        $RT_powerfactor_Buf     = Input::get('RT_powerfactor');

// management convert type parameter

        $RT_powerout    = $RT_powerout_Buf / 1000;   
        $RT_poweraccum  =  $RT_poweraccum_Buf / 1000; 
        $Input_Cstr1    = $Input_Cstr1_Buf / 10;
        $Input_Cstr2    = $Input_Cstr2_Buf / 10;
        $Input_Cstr3    = $Input_Cstr3_Buf / 10;
        $Accurrent      = $Accurrent_Buf / 10;
        $Frequency      = $Frequency_Buf /10;
        $RT_powerfactor = $RT_powerfactor_Buf / 1000;

// ส่วนของการยืนยัน Site_ID
// $SerialNo; //Serial No ที่จะเอามาหา Site_ID

$COUNT  = z50_site::count(); //จำนวน record ใน Site_Z50

$Siteid = DB::table('z50_site') //ดึง SiteID ออกมาเป้น array เพื่อใช้วนลูป
          ->select('Site_ID')
          ->get();
        foreach ($Siteid as $Siteids) 
        {
        $Site_IDF[] = $Siteids->Site_ID;
        }
        // return($Site_ID);

for($i = 0 ; $i < $COUNT ; $i++)
{
        $serialnolist = DB::table('z50_site') //ดึงรายชื่อ Serialno
                    ->where('Site_ID', '=', $Site_IDF[$i])
                    ->select('SerialNolist')
                    ->get();
        foreach ($serialnolist as $serialnolists) 
        {
            $SerialNolist = explode(",",$serialnolists->SerialNolist);
        }
        //เช็คข้อมูลใน อาร์เรย์ว่าตรงไม๊
        $serialnolist = DB::table('z50_site') //ดึงรายชื่อ Serialno
                    ->where('Site_ID', '=', $Site_IDF[$i])
                    ->select('SerialNolist')
                    ->get();

        foreach ($serialnolist as $serialnolists) 
        {
            $SerialNolist = explode(",",$serialnolists->SerialNolist);
        }

        if(in_array($SerialNo ,$SerialNolist))
        {
                // return("TRUE555");
                $Siteid = DB::table('z50_site') 
                ->where('Site_ID', '=',$Site_IDF[$i])
                ->select('Site_ID')
                ->get();
                foreach ($Siteid as $Siteids) 
                        {
                        $Site_IDSUPPA = $Siteids->Site_ID;
                        }
                        // return($Site_ID);

// ส่วนของการบันทึกข้อมูลลงในตาราง Z50info
        $api                    = new z50pcs_info();
        $api->Site_ID           = $Site_IDSUPPA;
        $api->Comm_v            = $Comm_v;
        $api->Model_t           = $Model_t;
        $api->SerialNo          = $SerialNo;
        $api->Program_v         = $Program_v;

// เพิ่มการจัดการข้อมูลเกี่ยวกับ ZeroExportMode และ ZeroexportController 
        
        $result = str_split($Program_v);

            if(($result[6] == 'Z') && ($result[7] == '1'))
            {
                // $ZeroexportMode = "1";
                // $ZeroexportControll = "1";
                $Zeroexport = "Z1";
            }
            elseif(($result[6] == 'Z') && ($result[7] == '0'))
            {
                // $ZeroexportMode = "1";
                // $ZeroexportControll = "0";
                $Zeroexport = "Z0";
            }
            else
            {
                // $ZeroexportMode = "0";
                // $ZeroexportControll = "0";
                $Zeroexport = "00";
            }

        $api->Pcs_status            = $Pcs_status;
        // $api->ZeroexportMode        = $ZeroexportMode;
        // $api->ZeroexportControll    = $ZeroexportControll;
        $api->Zeroexport    = $Zeroexport;
        $api->Reg_mode          = $Reg_mode;
        $api->Insp_test         = $Insp_test;

// START management Errorcode to Suppress or Recover
        if( $Pcs_status == 'G' || $Pcs_status == 'C')
        {
            $api->Errorcode = $Errorcode;
        }
        elseif($Pcs_status == 'B')
        {
            $api->Suppression = $Errorcode;
        }elseif($Pcs_status == 'A')
        {
            $api->Recoverytime = $Errorcode;
        }else
        {
            $api->Errorcode = $Errorcode;
        }
        // STOP management Errorcode to Suppress or Recover
        $api->RT_powerout       = $RT_powerout;
        $api->RT_poweraccum     = $RT_poweraccum;
        $api->Statuspowerfactor = $Statuspowerfactor;
        $api->Input_Vstr1       = $Input_Vstr1;
        $api->Input_Cstr1       = $Input_Cstr1;
        $api->Acvoltage_str1    = $Acvoltage_str1;
        $api->Input_Vstr2       = $Input_Vstr2;
        $api->Input_Cstr2       = $Input_Cstr2;
        $api->Accurrent         = $Accurrent;
        $api->Input_Vstr3       = $Input_Vstr3;
        $api->Input_Cstr3       = $Input_Cstr3;
        $api->Frequency         = $Frequency;
        $api->RT_powerfactor    = $RT_powerfactor;

        $api->save();
                }
        }

    // ส่วนของการอัปเดตข้อมูลในตาราง Sum_of_z50info
    // ดึงข้อมูลชุดสุดท้ายออกมา
    // $z50user = User::find(Auth::user()->id);
    $serialnolist = DB::table('z50_site')
                    ->where('Site_ID', '=', $Site_IDSUPPA)
                    ->select('SerialNolist')
                    ->get();
    foreach ($serialnolist as $serialnolists) 
        {
            $SerialNolist = explode(",",$serialnolists->SerialNolist);
        }

        for($i = 0 ; $i <= sizeof($SerialNolist)-1 ; $i++)
        {
                    $result = DB::table('z50pcs_info')
                    ->where('SerialNo','=',$SerialNolist[$i])
                    ->select('RT_powerout','RT_poweraccum','created_at','Pcs_status','Zeroexport','SerialNo')
                    ->latest()
                    ->limit(1)
                    ->get();

        //การจัดเตรียมข้อมูล Status
        //Status Description of tranfer system.
            // A : Normal work
            // B : Don't receive data over than 10 minute
            // C : Never received
                foreach ($result as $results) 
                {
                    $date = new DateTime;
                    $date->modify('-5 minutes');
                    $formatted_date = $date->format('Y-m-d H:i:s');

                    if($results->created_at < $formatted_date )
                    {
                        $RT_powerout = 0;
                        $RT_poweraccum = $results->RT_poweraccum;
                        $Pcs_status = $results->Pcs_status;
                        $Zeroexport = $results->Zeroexport;
                        // $ZeroexportControll = $results->ZeroexportControll;
                        $Tranfer_status = "B";
                    }
                    else
                    {
                        $RT_powerout = $results->RT_powerout;
                        $RT_poweraccum = $results->RT_poweraccum;
                        $Pcs_status = $results->Pcs_status;
                        $Zeroexport = $results->Zeroexport;
                        // $ZeroexportControll = $results->ZeroexportControll;
                        $Tranfer_status = "A";
                    }
                }

                $Tranfer_statusArray[] = $Tranfer_status;
                $RT_poweroutArray[] = $RT_powerout;
                $RT_poweraccumArray[] = $RT_poweraccum;
                $Pcs_statusArray[] = $Pcs_status;
                $ZeroexportArray[] = $Zeroexport;
                // $ZeroexportControllArray[] = $ZeroexportControll;

        //เซ็ตค่า Default ในกรณีที่ไม่มีข้อมูลของ Serialno นั้นเข้ามา

                $RT_powerout = 0;
                $RT_poweraccum = 0;
                $Tranfer_status = "C";
                $Pcs_status = "I";
                $Zeroexport = "00";
                // $ZeroexportControll = "0";

                $RT_poweroutTotal = array_sum($RT_poweroutArray);
                $RT_poweraccumTotal = array_sum($RT_poweraccumArray);
            
        }
        // ส่วนของการจัดการ Line status ก่อนบันทึก
        $Linestatus = DB::table('sum_of_z50info')
        ->where('Site_ID','=', $Site_IDSUPPA)
        ->select('Linestatus','Tranfer_status')
        ->latest()
        ->LIMIT(1)
        ->get();
        
        foreach ($Linestatus as $Linestatuss) 
                        {
                        $Linestatus = $Linestatuss->Linestatus;
                        $TS = $Linestatuss->Tranfer_status;
                        }
                        if(!empty($TS)){
                        $TS = explode(",",$TS); 
    if(in_array('B', $TS))
    {
        if($Linestatus == 1)
        {
            $LS = 1;
        }
        else
        {
            $LS = 0;
        }
    }
    else
    {
            $LS = 0;
    }
}else
{
    $LS = 0;
}
        //Insert to data base

        $total = new sum_of_z50info();
        
        $total->Site_ID           = $Site_IDSUPPA;
        $total->Powerout_Total            = $RT_poweroutTotal ;
        $total->Poweraccum_Total           = $RT_poweraccumTotal;
        $total->Tranfer_status          = implode(",",$Tranfer_statusArray); 
        $total->SerialNolist         = implode(",",$SerialNolist); 
        $total->RT_powerout         = implode(",",$RT_poweroutArray); 
        $total->RT_poweraccum         = implode(",",$RT_poweraccumArray); 
        $total->Pcs_status         = implode(",",$Pcs_statusArray);
        $total->Zeroexport        = implode(",",$ZeroexportArray);
        // $total->ZeroexportControll         = implode(",",$ZeroexportControllArray);
        $total->Linestatus        = $LS;


        $total->save();
        // เช็คข้อมูลและส่งข้อความไปแจ้งเตือน       
        $COUNT  = z50_site::count(); //จำนวน record ใน Site_Z50

        $Siteid = DB::table('z50_site') //ดึง SiteID ออกมาเป้น array เพื่อใช้วนลูป
                ->select('Site_ID')
                ->get();
                foreach ($Siteid as $Siteids) 
                {
                $Site_IDF[] = $Siteids->Site_ID;
                }
        // return($Site_ID);

        for($i = 0 ; $i < $COUNT ; $i++)
        {
            // echo("Site".$Site_IDF[$i]."<br>");
            //เตรียมข้อมูลจากตาราง Sum_of_z50info
            $data = DB::table('sum_of_z50info')
            ->where('Site_ID','=', $Site_IDF[$i])
            ->selectRaw('Site_ID, Tranfer_status ,SerialNolist ,Created_at, Linestatus ' )
            ->latest()
            ->LIMIT(1)
            ->get();

            foreach ($data as $datas) 
            {
                $Tranferstatus = explode(",",$datas->Tranfer_status); 
                $serialnolist = explode(",",$datas->SerialNolist); 
                $createtime  = $datas->Created_at;
                $Line  = $datas->Linestatus;
            

            $date = new DateTime;
            $date->modify('-5 minutes');
            $formatted_date = $date->format('Y-m-d H:i:s');
            if($createtime < $formatted_date || in_array('B', $Tranferstatus)) 
            {
                    if($Line == 1)
                    {
                        // echo("ไม่ปกติ"." at site".$Site_IDF[$i]."<br>");
                        // echo("ไม่ส่งไลน์"."<br>");
                        
                    }else
                    {
                        // echo("ไม่ปกติ"." at site".$Site_IDF[$i]."<br>");
                        // echo("ส่งไลน์"."<br>");
                        // echo array_search('B', $Tranferstatus);
                        // dump($Tranferstatus);
                        //ตรวจสอบข้อมูล serial no ที่ผิดพลาด และส่งข้อความไปยังไลน์
                        for($r = 0 ; $r < count($Tranferstatus) ; $r++)
                        {
                            if($Tranferstatus[$r] == 'B')
                            {
                                $statusTA[] = $r;
                            }
                        }
                        // print_r($statusTA);
                        // echo"<br>";
                        // // ทำการดึง SerialNo ทีมีปัญหา
                        for($SR = 0 ; $SR < count($statusTA) ; $SR++)
                        {
                            $Srt[] = $serialnolist[$statusTA[$SR]];
                        }
                        $SROK = implode(",",$Srt); 
                        // print_r($SROK);
                        // echo"<br>";
                        
                        // // เตรียมข้อมูลสำหรับส่งไลน์
                        $Ltoken = DB::table('z50_site') 
                        ->where('Site_ID','=', $datas->Site_ID)
                        ->select('Notifytoken' , 'SiteName')
                        ->get();
                        foreach ($Ltoken as $Ltokens) 
                            {
                            $Ltoken= $Ltokens->Notifytoken;
                            $SiteName= $Ltokens->SiteName;
                            }
                        // // ขั้นตอนการส่งไลน์
                        $access_token = $Ltoken;
                        // require_once('DB/line.php'); 
                        
                    // echo($access_token."<br>");
                
                    // $lineapi = "xFGFmntepnEZtjJ7BedzZRntvYOf42LctKGLy0LcQMW"; // ใส่ token key ที่ได้มา
                    $lineapi = $access_token;
                    $message = "การส่งข้อมูลผิดพลาดกรุณาตรวจสอบ Site: ".$SiteName." รายการ Inverter ที่ข้อมูลขาดหาย :".$SROK." สามารถตรวจสอบได้ที่ : www.ttemonitoring.com";
                    // $message = "การส่งข้อมูลผิดพลาดกรุณาตรวจสอบ Site: ".$SiteName." สามารถตรวจสอบได้ที่ : www.ttemonitoring.com";
                    $mms =  trim($message); // ข้อความที่ต้องการส่ง
                    date_default_timezone_set("Asia/Bangkok");
                            $chOne = curl_init(); 
                            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
                            // SSL USE 
                            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
                            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
                            //POST 
                            curl_setopt( $chOne, CURLOPT_POST, 1); 
                            
                            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms"); 
                            
                            curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
                            
                            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', ); 
                        
                            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
                            
                            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
                            $result = curl_exec( $chOne ); 
                            //Check error 
                            if(curl_error($chOne)) 
                                { 
                                // echo 'error:' . curl_error($chOne); 
                            } 
                            else { 
                                // $result_ = json_decode($result, true); 
                                // echo "status : ".$result_['status']; echo "message : ". $result_['message'];
                    } 
                            curl_close( $chOne ); 
                            unset($statusTA);
            $statusTA = array();
                            
                            unset($Srt);
            $Srt = array();
            // update status line of this record
            $data = sum_of_z50info::where('Site_ID','=',$datas->Site_ID )
            ->latest()
            ->LIMIT(1)
            ->update([
                'Linestatus' => 1,
            ]);
                    }    
            }else
            {
                // echo("ปกติ"." at site".$Site_IDF[$i]."<br>");
            }
        }
        }
       
        } //close function

    public function Linenotify()
    {
        $COUNT  = z50_site::count(); //จำนวน record ใน Site_Z50

        $Siteid = DB::table('z50_site') //ดึง SiteID ออกมาเป้น array เพื่อใช้วนลูป
          ->select('Site_ID')
          ->get();
        foreach ($Siteid as $Siteids) 
        {
            $Site_IDF[] = $Siteids->Site_ID;
        }
        // dump($Site_IDF);
        for($i = 1 ; $i < $COUNT ; $i++)
        {
            // echo("Site".$Site_IDF[$i]."<br>");
            //เตรียมข้อมูลจากตาราง Sum_of_z50info
            $data = DB::table('sum_of_z50info')
            ->where('Site_ID','=', $Site_IDF[$i])
            ->selectRaw('Site_ID, Tranfer_status ,SerialNolist ,Created_at, Linestatus ,Powerout_Total' )
            ->latest()
            ->LIMIT(1)
            ->get();

            foreach ($data as $datas) 
            {
                $Tranferstatus = explode(",",$datas->Tranfer_status); 
                $serialnolist = explode(",",$datas->SerialNolist); 
                $createtime  = $datas->Created_at;
                $Powerout_Total  = $datas->Powerout_Total;
                $Line  = $datas->Linestatus;
            

            $date = new DateTime;
            $date->modify('-25 minutes');
            $formatted_date = $date->format('Y-m-d H:i:s');
            if($createtime < $formatted_date || in_array('B', $Tranferstatus)) 
            {
                    if($Line == 1)
                    {
                        // echo("ไม่ปกติ"." at site".$Site_IDF[$i]."<br>");
                        // echo("ไม่ส่งไลน์"."<br>");
                        
                    }else
                    {
                        if($Powerout_Total == 0)
                        {

                        }else{
                        // echo("ไม่ปกติ"." at site".$Site_IDF[$i]."<br>");
                        // echo("ส่งไลน์"."<br>");
                        // echo array_search('B', $Tranferstatus);
                        // dump($Tranferstatus);
                        //ตรวจสอบข้อมูล serial no ที่ผิดพลาด และส่งข้อความไปยังไลน์
                        for($r = 0 ; $r < count($Tranferstatus) ; $r++)
                        {
                            if($Tranferstatus[$r] == 'B')
                            {
                                $statusTA[] = $r;
                            }
                            else
                            {
                                $statusTA =  array();

                            }
                        }
                        // print_r($statusTA);
                        // echo"<br>";

                        //เช็คเงื่อนไขว่ามันมีข้อมูล Serialno ที่ผิดพลาดไม๊
                        if(empty($statusTA))
                        {
                                    // // เตรียมข้อมูลสำหรับส่งไลน์
                        $Ltoken = DB::table('z50_site') 
                        ->where('Site_ID','=', $datas->Site_ID)
                        ->select('Notifytoken' , 'SiteName')
                        ->get();
                        foreach ($Ltoken as $Ltokens) 
                            {
                            $Ltoken= $Ltokens->Notifytoken;
                            $SiteName= $Ltokens->SiteName;
                            }
                        // // ขั้นตอนการส่งไลน์
                                $access_token = $Ltoken;
                                $lineapi = $access_token;
                                $message = "การส่งข้อมูลผิดพลาดกรุณาตรวจสอบ Site: ".$SiteName." สามารถตรวจสอบได้ที่ : www.ttemonitoring.com";
                                // $message = "การส่งข้อมูลผิดพลาดกรุณาตรวจสอบ Site: ".$SiteName." สามารถตรวจสอบได้ที่ : www.ttemonitoring.com";
                                $mms =  trim($message); // ข้อความที่ต้องการส่ง
                                date_default_timezone_set("Asia/Bangkok");
                                        $chOne = curl_init(); 
                                        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
                                        // SSL USE 
                                        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
                                        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
                                        //POST 
                                        curl_setopt( $chOne, CURLOPT_POST, 1); 
                                        
                                        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms"); 
                                        
                                        curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
                                        
                                        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', ); 
                                    
                                        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
                                        
                                        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
                                        $result = curl_exec( $chOne ); 
                                        //Check error 
                                        if(curl_error($chOne)) 
                                            { 
                                            // echo 'error:' . curl_error($chOne); 
                                        } 
                                        else { 
                                            // $result_ = json_decode($result, true); 
                                            // echo "status : ".$result_['status']; echo "message : ". $result_['message'];
                                } 
                                        curl_close( $chOne ); 
                                        unset($statusTA);
                        $statusTA = array();
                                        
                                        unset($Srt);
                        $Srt = array();
                        // update status line of this record
                        $data = sum_of_z50info::where('Site_ID','=',$datas->Site_ID )
                        ->latest()
                        ->LIMIT(1)
                        ->update([
                            'Linestatus' => 1,
                        ]);
                        }
                        else
                        {
                        // // ทำการดึง SerialNo ทีมีปัญหา
                        for($SR = 0 ; $SR < count($statusTA) ; $SR++)
                        {
                            $Srt[] = $serialnolist[$statusTA[$SR]];
                        }
                        $SROK = implode(",",$Srt); 
                        // print_r($SROK);
                        // echo"<br>";
                        
                        // // เตรียมข้อมูลสำหรับส่งไลน์
                        $Ltoken = DB::table('z50_site') 
                        ->where('Site_ID','=', $datas->Site_ID)
                        ->select('Notifytoken' , 'SiteName')
                        ->get();
                        foreach ($Ltoken as $Ltokens) 
                            {
                            $Ltoken= $Ltokens->Notifytoken;
                            $SiteName= $Ltokens->SiteName;
                            }
                        // // ขั้นตอนการส่งไลน์
                        $access_token = $Ltoken;
                        // require_once('DB/line.php'); 
                        
                    // echo($access_token."<br>");
                
                    // $lineapi = "xFGFmntepnEZtjJ7BedzZRntvYOf42LctKGLy0LcQMW"; // ใส่ token key ที่ได้มา
                    $lineapi = $access_token;
                    $message = "การส่งข้อมูลผิดพลาดกรุณาตรวจสอบ Site: ".$SiteName." รายการ Inverter ที่ข้อมูลขาดหาย :".$SROK." สามารถตรวจสอบได้ที่ : www.ttemonitoring.com";
                    // $message = "การส่งข้อมูลผิดพลาดกรุณาตรวจสอบ Site: ".$SiteName." สามารถตรวจสอบได้ที่ : www.ttemonitoring.com";
                    $mms =  trim($message); // ข้อความที่ต้องการส่ง
                    date_default_timezone_set("Asia/Bangkok");
                            $chOne = curl_init(); 
                            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
                            // SSL USE 
                            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
                            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
                            //POST 
                            curl_setopt( $chOne, CURLOPT_POST, 1); 
                            
                            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms"); 
                            
                            curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
                            
                            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', ); 
                        
                            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
                            
                            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
                            $result = curl_exec( $chOne ); 
                            //Check error 
                            if(curl_error($chOne)) 
                                { 
                                // echo 'error:' . curl_error($chOne); 
                            } 
                            else { 
                                // $result_ = json_decode($result, true); 
                                // echo "status : ".$result_['status']; echo "message : ". $result_['message'];
                    } 
                            curl_close( $chOne ); 
                            unset($statusTA);
            $statusTA = array();
                            
                            unset($Srt);
            $Srt = array();
            // update status line of this record
            $data = sum_of_z50info::where('Site_ID','=',$datas->Site_ID )
            ->latest()
            ->LIMIT(1)
            ->update([
                'Linestatus' => 1,
            ]);
            }
        }
                    } // ตรงนี้
                    
            }else
            {
                // echo("ปกติ"." at site".$Site_IDF[$i]."<br>");
            }
            
        

        }



        }
            }


    public function TestNotify()
    {
       
            $Ltoken = DB::table('z50_site') 
            ->where('Site_ID','=', Auth::user()->Site_ID)
            ->select('Notifytoken' , 'SiteName')
            ->get();
            foreach ($Ltoken as $Ltokens) 
                {
                $Ltoken= $Ltokens->Notifytoken;
                $SiteName= $Ltokens->SiteName;
                }
        
            $access_token = $Ltoken;
    
        $lineapi = $access_token;
        $message = "ข้อความทดสอบการทำงานระบบแจ้งเตือน MCOTAlert จาก Site: ".$SiteName." ขณะนี้ระบบแจ้งเตือนสามารถใช้งานได้แล้ว!";
        
        $mms =  trim($message); 
        date_default_timezone_set("Asia/Bangkok");
                $chOne = curl_init(); 
                curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
                // SSL USE 
                curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
                curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
                //POST 
                curl_setopt( $chOne, CURLOPT_POST, 1); 
                
                curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms"); 
                
                curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
                
                $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', ); 
            
                curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
                
                curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
                $result = curl_exec( $chOne ); 
                //Check error 
                if(curl_error($chOne)) 
                    { 
                       return redirect::back();
                } 
                else { 
                    return redirect::back();
        } 
        
        // $Monthdata = DB::table('sum_of_z50info')
        //     ->where('Site_ID', '=', Auth::user()->Site_ID)
        //     ->whereYear('created_at' ,'=',2018)         
        //     ->whereMonth('created_at' ,'=',6)
        //     ->select(DB::Raw('DAY(created_at) as x , MAX(Poweraccum_Total) - MIN(Poweraccum_Total)  as y'))
        //     ->groupBy(DB::Raw('UNIX_TIMESTAMP(DATE(created_at))*1000'))
        //     ->get();

        //     return($Monthdata);

        //    $PoweraccumTOTAL = DB::table('sum_of_z50info')
        //     ->where('Site_ID', '=', Auth::user()->Site_ID)
        //     ->whereYear('created_at' ,'=',2018)         
        //     ->whereMonth('created_at' ,'=',6)
        //     ->select(DB::Raw('MAX(Poweraccum_Total) - MIN(Poweraccum_Total)  as y'))
        //     ->get();
        //     foreach ($PoweraccumTOTAL as $PoweraccumTOTALs) {
        //         $PoweraccumTOTAL = $PoweraccumTOTALs->y;
        //     }
        //     return($PoweraccumTOTAL);

        //  $Losedatalist = DB::table('sum_of_z50info')
        //      ->where('Site_ID', '=', Auth::user()->Site_ID)
        //      ->whereYear('created_at' ,'=',2018)         
        //      ->whereMonth('created_at' ,'=',6)
        //      ->where('Linestatus','=',1)
        //      ->select('Tranfer_status','SerialNolist','Created_at')
        //      ->get();
        // // return($Losedatalist);
        // foreach ($Losedatalist as $Losedatalists) 
        //     {
        //         $Tranferstatus = explode(",",$Losedatalists->Tranfer_status); 
        //         $serialnolist = explode(",",$Losedatalists->SerialNolist); 
        //         $createtime  = $Losedatalists->Created_at;
            

        //     for($r = 0 ; $r < count($Tranferstatus) ; $r++)
        //     {
        //         if($Tranferstatus[$r] == 'B')
        //         {
        //             $statusTA[] = $r;
        //         }
        //         else
        //         {
        //             // $statusTA =  array();
        //         }
        //     }
        //     // ทำการดึง SerialNo ทีมีปัญหา
        //     for($SR = 0 ; $SR < count($statusTA) ; $SR++)
        //     {
        //         $Srt[] = $serialnolist[$statusTA[$SR]];
        //     }
        //     $SROK = implode(",",$Srt);

        //     // dump($Tranferstatus);
        //     // dump($statusTA);
        //     // dump($SROK);

        //     $Date_time[] = $createtime;
        //     $SerialNo[] = $SROK;


        //     unset($Srt);
        //     $Srt = array();

        //     unset($statusTA);
        //     $statusTA = array();
                            
        //     unset($SROK);
        //     $SROK = array();
        // }

        // dump($Date_time);
        // dump($SerialNo);
        // $ret = array($Date_time, $SerialNo);
        // dump($ret);

        // $response = Geocode::make()->address('1 Infinite Loop');

if ($response) {
	echo $response->latitude();
	echo $response->longitude();
	echo $response->formattedAddress();
	echo $response->locationType();
}else
{
    echo("none response");
}


    }

    public function Modulerestart()
    {
        $Time     = Input::get('time');
        $restart                = new z50restarthistory();
        $restart->Time          = $Time;
        $restart->save();
  
    }


    public function AlertModuleRestart()
    {
        $lineapi = "xFGFmntepnEZtjJ7BedzZRntvYOf42LctKGLy0LcQMW";
        $message = "ข้อความจากระบบแจ้งเตือน MCOTAlert : แจ้งเตือนการ Restart Module ในระหว่างการทดสอบ!";
    
        $mms =  trim($message); 
            date_default_timezone_set("Asia/Bangkok");
            $chOne = curl_init(); 
            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
            // SSL USE 
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
            //POST 
            curl_setopt( $chOne, CURLOPT_POST, 1); 
            
            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms"); 
            
            curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
            
            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', ); 
        
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
            
            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
            $result = curl_exec( $chOne ); 
            //Check error 
            if(curl_error($chOne)) 
            { 
                   echo 'error:' . curl_error($chOne); 
            } 
            else { 
            $result_ = json_decode($result, true); 
               echo "status : ".$result_['status']; echo "message : ". $result_['message'];
                } 
            curl_close( $chOne );
    }


    public function IntervalSumofZ50info()  //เพื่อจัดการตาราง Sumofz50 เป็นวงรอบตามเวลาที่กำหนดโดยใช้ CronJob
    {

        // ส่วนของการยืนยัน Site_ID
// $SerialNo; //Serial No ที่จะเอามาหา Site_ID

// $COUNT  = z50_site::count(); //จำนวน record ใน Site_Z50

$Siteid = DB::table('z50_site') //ดึง SiteID ออกมาเป้น array เพื่อใช้วนลูป
          ->select('Site_ID')
          ->get();
        foreach ($Siteid as $Siteids) 
        {
        $Site_IDF[] = $Siteids->Site_ID;
        }
        // return($Site_IDF);

for($i = 1 ; $i < sizeof($Site_IDF) ; $i++)
{
        $serialnolist = DB::table('z50_site') //ดึงรายชื่อ Serialno
                    ->where('Site_ID', '=', $Site_IDF[$i])
                    ->select('SerialNolist')
                    ->get();
        foreach ($serialnolist as $serialnolists) 
        {
            $SerialNolist = explode(",",$serialnolists->SerialNolist);
        }
        
    // ส่วนของการอัปเดตข้อมูลในตาราง Sum_of_z50info
    // ดึงข้อมูลชุดสุดท้ายออกมา
    // $z50user = User::find(Auth::user()->id)
    $Tranfer_statusArray = [];
    $RT_poweroutArray  = [];
    $RT_poweraccumArray = [];
    $Pcs_statusArray = [];

        for($j = 0 ; $j <= sizeof($SerialNolist)-1 ; $j++)
        {
           

                    $result = DB::table('z50pcs_info')
                    ->where('Site_ID', '=', $Site_IDF[$i])
                    ->where('SerialNo','=',$SerialNolist[$j])
                    ->select('RT_powerout','RT_poweraccum','created_at','Pcs_status','SerialNo')
                    ->latest()
                    ->limit(1)
                    ->get();

        //การจัดเตรียมข้อมูล Status
        //Status Description of tranfer system.
            // A : Normal work
            // B : Don't receive data over than 10 minute
            // C : Never received
                foreach ($result as $results) 
                {
                   
                    $date = new DateTime;
                    $date->modify('-10 minutes');
                    $formatted_date = $date->format('Y-m-d H:i:s');

                    if($results->created_at < $formatted_date )
                    {
                        $RT_powerout = 0;
                        $RT_poweraccum = $results->RT_poweraccum;
                        $Pcs_status = $results->Pcs_status;
                        $Tranfer_status = "B";
                    }
                    else
                    {
                        $RT_powerout = $results->RT_powerout;
                        $RT_poweraccum = $results->RT_poweraccum;
                        $Pcs_status = $results->Pcs_status;
                        $Tranfer_status = "A";
                    }
                }

                $Tranfer_statusArray[] = $Tranfer_status;
                $RT_poweroutArray[] = $RT_powerout;
                $RT_poweraccumArray[] = $RT_poweraccum;
                $Pcs_statusArray[] = $Pcs_status;

        //เซ็ตค่า Default ในกรณีที่ไม่มีข้อมูลของ Serialno นั้นเข้ามา

                $RT_powerout = 0;
                $RT_poweraccum = 0;
                $Tranfer_status = "C";
                $Pcs_status = "I";

                $RT_poweroutTotal = array_sum($RT_poweroutArray);
                $RT_poweraccumTotal = array_sum($RT_poweraccumArray);
            
        }
        // ส่วนของการจัดการ Line status ก่อนบันทึก
        $Linestatus = DB::table('sum_of_z50info')
        ->where('Site_ID','=', $Site_IDF[$i])
        ->select('Linestatus','Tranfer_status')
        ->latest()
        ->LIMIT(1)
        ->get();
        
        foreach ($Linestatus as $Linestatuss) 
                        {
                        $Linestatus = $Linestatuss->Linestatus;
                        $TS = $Linestatuss->Tranfer_status;
                        }
                        $TS = explode(",",$TS); 
    if(in_array('B', $TS))
    {
        if($Linestatus == 1)
        {
            $LS = 1;
        }
        else
        {
            $LS = 0;
        }
    }
    else
    {
            $LS = 0;
    }
        //Insert to data base

        $total = new sum_of_z50info();
        
        $total->Site_ID           = $Site_IDF[$i];
        $total->Powerout_Total            = $RT_poweroutTotal ;
        $total->Poweraccum_Total           = $RT_poweraccumTotal;
        $total->Tranfer_status          = implode(",",$Tranfer_statusArray); 
        $total->SerialNolist         = implode(",",$SerialNolist); 
        $total->RT_powerout         = implode(",",$RT_poweroutArray); 
        $total->RT_poweraccum         = implode(",",$RT_poweraccumArray); 
        $total->Pcs_status         = implode(",",$Pcs_statusArray);
        $total->Linestatus        = $LS;


        $total->save();
        // เช็คข้อมูลและส่งข้อความไปแจ้งเตือน       
        // $COUNT  = z50_site::count(); //จำนวน record ใน Site_Z50

        // $Siteid = DB::table('z50_site') //ดึง SiteID ออกมาเป้น array เพื่อใช้วนลูป
        //         ->select('Site_ID')
        //         ->get();
        //         foreach ($Siteid as $Siteids) 
        //         {
        //         $Site_IDF[] = $Siteids->Site_ID;
        //         }
        // // return($Site_ID);

        // for($i = 0 ; $i < $COUNT ; $i++)
        // {
            // echo("Site".$Site_IDF[$i]."<br>");
            //เตรียมข้อมูลจากตาราง Sum_of_z50info
            $data = DB::table('sum_of_z50info')
            ->where('Site_ID','=', $Site_IDF[$i])
            ->selectRaw('Site_ID, Tranfer_status ,SerialNolist ,Created_at, Linestatus ' )
            ->latest()
            ->LIMIT(1)
            ->get();

            foreach ($data as $datas) 
            {
                $Tranferstatus = explode(",",$datas->Tranfer_status); 
                $serialnolist = explode(",",$datas->SerialNolist); 
                $createtime  = $datas->Created_at;
                $Line  = $datas->Linestatus;
            

            $date = new DateTime;
            $date->modify('-5 minutes');
            $formatted_date = $date->format('Y-m-d H:i:s');
            if($createtime < $formatted_date || in_array('B', $Tranferstatus)) 
            {
                    if($Line == 1)
                    {
                        // echo("ไม่ปกติ"." at site".$Site_IDF[$i]."<br>");
                        // echo("ไม่ส่งไลน์"."<br>");
                        
                    }else
                    {
                        // echo("ไม่ปกติ"." at site".$Site_IDF[$i]."<br>");
                        // echo("ส่งไลน์"."<br>");
                        // echo array_search('B', $Tranferstatus);
                        // dump($Tranferstatus);
                        //ตรวจสอบข้อมูล serial no ที่ผิดพลาด และส่งข้อความไปยังไลน์
                        for($r = 0 ; $r < count($Tranferstatus) ; $r++)
                        {
                            if($Tranferstatus[$r] == 'B')
                            {
                                $statusTA[] = $r;
                            }
                        }
                        // print_r($statusTA);
                        // echo"<br>";
                        // // ทำการดึง SerialNo ทีมีปัญหา
                        for($SR = 0 ; $SR < count($statusTA) ; $SR++)
                        {
                            $Srt[] = $serialnolist[$statusTA[$SR]];
                        }
                        $SROK = implode(",",$Srt); 
                        // print_r($SROK);
                        // echo"<br>";
                        
                        // // เตรียมข้อมูลสำหรับส่งไลน์
                        $Ltoken = DB::table('z50_site') 
                        ->where('Site_ID','=', $Site_IDF[$i])
                        ->select('Notifytoken' , 'SiteName')
                        ->get();
                        foreach ($Ltoken as $Ltokens) 
                            {
                            $Ltoken= $Ltokens->Notifytoken;
                            $SiteName= $Ltokens->SiteName;
                            }
                        // // ขั้นตอนการส่งไลน์
                        $access_token = $Ltoken;
                        // require_once('DB/line.php'); 
                        
                    // echo($access_token."<br>");
                
                    // $lineapi = "xFGFmntepnEZtjJ7BedzZRntvYOf42LctKGLy0LcQMW"; // ใส่ token key ที่ได้มา
                    $lineapi = $access_token;
                    $message = "การส่งข้อมูลผิดพลาดกรุณาตรวจสอบ Site: ".$SiteName." รายการ Inverter ที่ข้อมูลขาดหาย :".$SROK." สามารถตรวจสอบได้ที่ : www.ttemonitoring.com";
                    // $message = "การส่งข้อมูลผิดพลาดกรุณาตรวจสอบ Site: ".$SiteName." สามารถตรวจสอบได้ที่ : www.ttemonitoring.com";
                    $mms =  trim($message); // ข้อความที่ต้องการส่ง
                    date_default_timezone_set("Asia/Bangkok");
                            $chOne = curl_init(); 
                            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
                            // SSL USE 
                            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
                            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
                            //POST 
                            curl_setopt( $chOne, CURLOPT_POST, 1); 
                            
                            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms"); 
                            
                            curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
                            
                            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', ); 
                        
                            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
                            
                            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
                            $result = curl_exec( $chOne ); 
                            //Check error 
                            if(curl_error($chOne)) 
                                { 
                                // echo 'error:' . curl_error($chOne); 
                            } 
                            else { 
                                // $result_ = json_decode($result, true); 
                                // echo "status : ".$result_['status']; echo "message : ". $result_['message'];
                    } 
                            curl_close( $chOne ); 
                            unset($statusTA);
            $statusTA = array();
                            
                            unset($Srt);
            $Srt = array();
            // update status line of this record
            $data = sum_of_z50info::where('Site_ID','=',$Site_IDF[$i] )
            ->latest()
            ->LIMIT(1)
            ->update([
                'Linestatus' => 1,
            ]);
                    }    
            }else
            {
                // echo("ปกติ"." at site".$Site_IDF[$i]."<br>");
            }
        }
        }

    }
    
    
    }

// $Energytoday = DB::table('sum_of_z50info')
// ->where('Site_ID','=',Auth::user()->Site_ID)
// ->whereDate('created_at' ,'=', date('Y-m-d'))
// ->selectRaw('MAX(Poweraccum_Total) - MIN(Poweraccum_Total)  as y')
// ->get();

// ->select(DB::Raw('DAY(x) as x , SUM(y) as y'))
