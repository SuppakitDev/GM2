<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbPCSInfo;
use App\User;
use Auth;
use App\Http\Requests\UpdateProfilesRequest;
use Image;
use File;
use App\tbpvinput;
use App\tbUserID;
use App\tbPcsStatusDescript;
use DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
class InverterController extends Controller
{
    public function InverterDashboard()
        {
            // ดึงรายชื่อ Masterbox  
            $MB = DB::table('tbPCSInfo')
            ->distinct()
            ->where('UserID','=',Auth::user()->Site_ID)
            ->select('MBxID')
            ->get();
            $Site = tbUserID::find(Auth::user()->Site_ID);

            // ดึงจำนวน Inv ทั้งหมด
            $Invnum = DB::table('tbPCSInfo')
            ->distinct()
            ->where('UserID','=',Auth::user()->Site_ID) //จำลองการกรองในอนาคต
            ->get(['SerialNo'])
            ->count();

        //Start ดึงข้อมูลเพื่อแสดงที่ Site Information
         // ดึง Power
         $Power = DB::table('tbPCSInfo')
         ->where('UserID','=',Auth::user()->Site_ID)
         ->latest()       
         ->limit($Invnum) 
         ->orderBy('PcsID','asc')
         ->selectRaw('Pac as y')                
         ->get();
             $tpp =0;
         foreach( $Power as $powers ){
             $tpp += $powers->y;
         }
         // ดึง Energy
         $Energy = DB::table('total_pconsumption')
         ->where('UserID','=',Auth::user()->Site_ID)
         ->whereDate('x' ,'=', date('Y-m-d'))
         ->selectRaw('SUM(y) as y')
         ->get();
         foreach( $Energy as $Energys ){
            $Energytoday = $Energys->y;
        }
        
      //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information

            return view('producttemplate.m250.content.Inverter_view',
            [
                // 'Inverter' => $Inv,
                // 'c' => $Cid,
                'MBX' => $MB,
                'Site' => $Site,
                'Power' => $tpp,
                'Energytoday' => $Energytoday,
            ]);
        }

    // **function get Yearly data from database
    public function getInvdata(){
        header("Content-type: text/json");
        $id = Input::get('pcsid');
        $mbxid = Input::get('mbxid');        
        $data = DB::table('tbPCSInfo')
                ->select('Pac')
                ->where('UserID','=',Auth::user()->Site_ID)
                ->where([['MBxID', '=', $mbxid],['PcsID' ,'=',$id]])
                ->orderBY('created_at','DESC')
                ->LIMIT(1)            
                ->get();
                
                foreach ($data as $datas) {
                    $x = $datas->Pac;
                    
                }
                $ret = array($x);
        // $data = 145;
            return Response::json($ret, 200, [], JSON_NUMERIC_CHECK);     
    }

    public function getPcsStatus(){
        header("Content-type: text/json");
        $id = Input::get('pcsid');
        $mbxid = Input::get('mbxid');
        $data = DB::table('tbPCSInfo')
                ->select('PcsStatus')
                ->where('UserID','=',Auth::user()->Site_ID)
                ->where([['MBxID', '=', $mbxid],['PcsID' ,'=',$id]])
                ->orderBY('created_at','DESC')
                ->LIMIT(1)            
                ->get();
                
                foreach ($data as $datas) {
                    $status = $datas->PcsStatus;   
                }
                
        // $data = 145;
            return Response::json($status, 200, [], JSON_NUMERIC_CHECK);     
    }

    // Inv Detail function

    public function InvDetail(){
        $Id = Input::get('id'); //PCSID
        $MbId = Input::get('mbid'); //MBXID
        $Site = tbUserID::find(Auth::user()->Site_ID);
        
        //จำนวนล่าสุดของ PV
        $Cpv = DB::table('tbpvinput')
        ->distinct()
        ->where('UserID','=',Auth::user()->Site_ID)
        ->where('MBxID','=',$MbId)
        ->where('PcsID','=',$Id)
        ->get(['StringNo'])
        ->count();
        //ข้อมูล pv ชุดล่าสุด
        $Pvinfo = tbpvinput::with('tbDDCStatusDescripts')
        ->where('UserID','=',Auth::user()->Site_ID)
        ->where('PcsID','=',$Id)        
        ->where('MBxID', '=', $MbId)
        ->latest()  
        ->orderBY('StringNo','asc')  
        ->limit($Cpv) 
        //  ->orderBy('PcsID','asc')                
        ->get();

        // ดึงข้อมูล Inv ตัวนั้นๆออกมา
        $Inv = tbPCSInfo::with('tbPcsStatusDescripts')
        ->where('UserID','=',Auth::user()->Site_ID)
        ->where('MBxID', '=', $MbId)
        ->where('PcsID','=',$Id) 
        ->latest()       
        ->limit(1)             
        ->get(); 

        $MB = DB::table('tbPCSInfo')
            ->distinct()
            ->where('UserID','=',Auth::user()->Site_ID)
            ->select('MBxID')
            ->get();
        
             //Start ดึงข้อมูลเพื่อแสดงที่ Site Information
        // ดึงจำนวน Inv ทั้งหมด
         $Invnum = DB::table('tbPCSInfo')
         ->distinct()
         ->where('UserID','=',Auth::user()->Site_ID) //จำลองการกรองในอนาคต
         ->get(['SerialNo'])
         ->count();

        
         // ดึง Power
         $Power = DB::table('tbPCSInfo')
         ->where('UserID','=',Auth::user()->Site_ID)
         ->latest()       
         ->limit($Invnum) 
         ->orderBy('PcsID','asc')
         ->selectRaw('Pac as y')                
         ->get();
             $tpp =0;
         foreach( $Power as $powers ){
             $tpp += $powers->y;
         }
         // ดึง Energy
         $Energy = DB::table('total_pconsumption')
         ->where('UserID','=',Auth::user()->Site_ID)
         ->whereDate('x' ,'=', date('Y-m-d'))
         ->selectRaw('SUM(y) as y')
         ->get();
         foreach( $Energy as $Energys ){
            $Energytoday = $Energys->y;
        }
        
      //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information
        
      //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information
        return view('producttemplate.M250.content.InvDetail',
                    [
                        'Pvinfo' => $Pvinfo,
                        'pvNo' => $Cpv,
                        'Inverter' => $Inv,
                        'INV' => $Id,
                        'MB' => $MB,
                        'Site' => $Site,
                        'Power' => $tpp,   
                        'Energytoday' => $Energytoday,   
                    ]);
    }

    public function AllInv()
    {
        $mbxid = Input::get('MBxID'); 
        
         // ดึงจำนวน Inv จิงๆที่มี  ***ยังมีโอกาสเกิดความผิดพลาดได้ ในกรณีที่ข้อมูลเขียนลงฐานข้อมูลไม่ครบทั้งชุด ข้อมูลอาจเพี้ยนได้
         $Cid = DB::table('tbPCSInfo')
         ->where('UserID','=',Auth::user()->Site_ID)
         ->distinct()
         ->where('MBxID','=',$mbxid)
         ->orderBy('PcsID','asc')                         
         ->get(['PcsID'])
         ->count();
         // ดึงรายชื่อ Masterbox  
         $MB = DB::table('tbPCSInfo')
         ->distinct()
         ->where('UserID','=',Auth::user()->Site_ID) //จำลองการกรองในอนาคต
         ->select('MBxID')
         ->get();

         // ดึงข้อมูลชุดสุดท้ายออกมา
         $Inv = tbPCSInfo::with('tbPcsStatusDescripts')
         ->where('UserID','=',Auth::user()->Site_ID)
         ->where('MBxID', '=', $mbxid)
         ->latest()       
         ->limit($Cid) 
         ->orderBy('PcsID','asc')                
         ->get();
         //Start ดึงข้อมูลเพื่อแสดงที่ Site Information
        // ดึงจำนวน Inv ทั้งหมด
         $Invnum = DB::table('tbPCSInfo')
         ->where('UserID','=',Auth::user()->Site_ID)
         ->distinct()
         ->where('UserID','=',Auth::user()->Site_ID) //จำลองการกรองในอนาคต
         ->get(['SerialNo'])
         ->count();

        
         // ดึง Power
         $Power = DB::table('tbPCSInfo')
         ->where('UserID','=',Auth::user()->Site_ID)
         ->latest()       
         ->limit($Invnum) 
         ->orderBy('PcsID','asc')
         ->selectRaw('Pac as y')                
         ->get();
             $tpp =0;
         foreach( $Power as $powers ){
             $tpp += $powers->y;
         }
         // ดึง Energy
         $Energy = DB::table('total_pconsumption')
         ->where('UserID','=',Auth::user()->Site_ID)
         ->whereDate('x' ,'=', date('Y-m-d'))
         ->selectRaw('SUM(y) as y')
         ->get();
         foreach( $Energy as $Energys ){
            $Energytoday = $Energys->y;
        }
        
      //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information
        $view = view("producttemplate.M250.content.AllInv",[
            'Inverter' => $Inv,
                'c' => $Cid,
                'MBX' => $MB,
                'MBXID' => $mbxid,
                'Power' => $tpp,
                'Energytoday' => $Energytoday,
                'Invnum' => $Invnum,
        ])->render();
        return response()->json(['html'=>$view]);
    }

    // get pv data
    public function getPvdata(){
        header("Content-type: text/json");

        $SRnum = Input::get('Serial'); 
        $MBxID = Input::get('mbxid'); 
        $PcsID = Input::get('pcsid'); 
        //ข้อมูล pv ชุดล่าสุด
        $Pvpower = DB::table('tbpvinput')
        ->select('Power')
        ->where('UserID','=',Auth::user()->Site_ID)
        ->where('MBxID','=',$MBxID)        
        ->where('PcsID','=',$PcsID)        
        ->where('StringNo','=',$SRnum)        
        ->orderBY('Time','DESC')
        ->LIMIT(1)                 
        ->get();

        foreach ($Pvpower as $Pvpowers) {
            $P = $Pvpowers->Power;
            
        }
        $ret = array($P);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK);        
    }

    public function getPvdetail(){
        header("Content-type: text/json");

        $SRnum = Input::get('Serial'); 
        $MBxID = Input::get('mbxid'); 
        $PcsID = Input::get('pcsid'); 
        //ข้อมูล pv ชุดล่าสุด
        $Pvpower = tbpvinput::with('tbErrorDescripts')
        ->select('Power','Vdc','ErrorCode','TempCtrl')
        ->where('UserID','=',Auth::user()->Site_ID)
        ->where('MBxID','=',$MBxID)        
        ->where('PcsID','=',$PcsID)        
        ->where('StringNo','=',$SRnum)        
        ->orderBY('Time','DESC')
        ->LIMIT(1)                 
        ->get();

        foreach ($Pvpower as $Pvpowers) {
            $Power = $Pvpowers->Power;
            $Vdc = $Pvpowers->Vdc;
            $ErrorCode = $Pvpowers->tbErrorDescripts->Descript;            
            $TempCtrl = $Pvpowers->tbDDC_TempCtrlDescripts->Descript; 
        }
            
        $Current = round(($Power*1000)/$Vdc);
        $ret = array($Vdc,$Current,$ErrorCode,$TempCtrl);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK);        
    }


    public function getInvinfo(){
        header("Content-type: text/json");

        $SRnum = Input::get('Serial'); 
        $MBxID = Input::get('mbxid'); 
        $PcsID = Input::get('pcsid'); 
        //ข้อมูล Inv ชุดล่าสุด
       
        $Inv = tbPCSInfo::with('tbPcsStatusDescripts')
        ->select('SerialNo',
                 'PcsStatus','Vac','Iac','Pac','AcFreq','VdcBus',
                 'PCtrlRate','PSuppression','VSuppression','TempSuppression',
                 'PConsumption','INVTemp')
        ->where('UserID','=',Auth::user()->Site_ID)
        ->where('MBxID', '=', $MBxID)
        ->where('SerialNo', '=', $SRnum)
        ->where('PcsID', '=', $PcsID)
        ->latest()       
        ->limit(1)                
        ->get();

        foreach ($Inv as $Invinfo) {
            $a = $Invinfo->Vac;
            $b = $Invinfo->Iac;
            $c = $Invinfo->AcFreq;
            $d = $Invinfo->VdcBus;
            $e = $Invinfo->PCtrlRate;
            $f = $Invinfo->tbSuppressionDescripts->Descript;
            $g = $Invinfo->tbSuppressionDescript_V->Descript;
            $h = $Invinfo->tbSuppressionDescript_T->Descript;
            $i = $Invinfo->PConsumption;
            $j = $Invinfo->INVTemp;
            $k = $Invinfo->Pac;
            $l = $Invinfo->SerialNo;
            $m = $Invinfo->tbPcsStatusDescripts->Descript;
            
            
        }
        $ret = array($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK);        
    }

    public function getmasterbox(){
        // header("Content-type: text/json");
 
        $MBxID = Input::get('MBXID'); 
        $INV = DB::table('tbPCSInfo')
            ->distinct()
            ->where('UserID','=',Auth::user()->Site_ID)
            ->where('MBxID','=',$MBxID)
            ->select('PcsID')
            ->get();
            return Response::json($INV);
                
    }

    // public function getsitepower(){
        
    //     //Start ดึงข้อมูลเพื่อแสดงที่ Site Information
    //     // ดึงจำนวน Inv ทั้งหมด
    //     $Invnum = DB::table('tbPCSInfo')
    //     ->distinct()
    //     ->where('UserID','=',1) //จำลองการกรองในอนาคต
    //     ->get(['SerialNo'])
    //     ->count();

       
    //     // ดึง Power
    //     $Power = DB::table('tbPCSInfo')
    //     ->latest()       
    //     ->limit($Invnum) 
    //     ->orderBy('PcsID','asc')
    //     ->selectRaw('Pac as y')                
    //     ->get();
    //         $tpp =0;
    //     foreach( $Power as $powers ){
    //         $tpp += $powers->y;
    //     }
    //     $tpp = number_format($tpp, 1, '.', '');
       
       
    //  //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information
    //     return Response::json($tpp, 200, [], JSON_NUMERIC_CHECK);        
        
    // }
    // public function getsiteenergy(){
    //     //Start ดึงข้อมูลเพื่อแสดงที่ Site Information
    //     // ดึงจำนวน Inv ทั้งหมด
    //     // ดึง Energy
    //     $Energy = DB::table('total_pconsumption')
    //     ->where('UserID', '=', 1)
    //     ->whereDate('x' ,'=', date('Y-m-d'))
    //     ->selectRaw('SUM(y) as y')
    //     ->get();
    //     foreach( $Energy as $Energys ){
    //        $Energytoday = $Energys->y;
    //    }
    //    $Energytoday = number_format($Energytoday, 1, '.', '');
    //  //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information
       
    //     return Response::json($Energytoday, 200, [], JSON_NUMERIC_CHECK);        
        
    // }

    public function getsiteinfo(){
        
        // ดึงจำนวน Inv ทั้งหมด
        $Invnum = DB::table('tbPCSInfo')
        ->distinct()
        ->where('UserID','=',Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->get(['SerialNo'])
        ->count();

       
        // ดึง Power
        $Power = DB::table('tbPCSInfo')
        ->latest()       
        ->limit($Invnum) 
        ->where('UserID','=',Auth::user()->Site_ID)
        ->orderBy('PcsID','asc')
        ->selectRaw('Pac as y')                
        ->get();
            $tpp =0;
        foreach( $Power as $powers ){
            $tpp += $powers->y;
        }
        $tpp = number_format($tpp, 1, '.', '');

        // ดึง Energy
        $Energy = DB::table('total_pconsumption')
        ->where('UserID','=',Auth::user()->Site_ID)
        ->whereDate('x' ,'=', date('Y-m-d'))
        ->selectRaw('SUM(y) as y')
        ->get();
        foreach( $Energy as $Energys ){
           $Energytoday = $Energys->y;
       }

        // ดึง Solar
        $ENV = DB::table('tbmbxinfo')
        ->where('UserID','=',Auth::user()->Site_ID)
        ->whereDate('Time' ,'=', date('Y-m-d'))
        ->selectRaw('Max(SRI) as SRI, AVG(OutsideTemp) as TEMP')
        ->get();
        foreach( $ENV as $ENVS ){
           $Solartoday = $ENVS->SRI;
           $Temptoday = $ENVS->TEMP;
       }

       $Solartoday = number_format($Solartoday, 1, '.', '');
       $Temptoday = number_format($Temptoday, 1, '.', '');
     
        //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information

        $siteinfo = array($tpp.' kW',$Energytoday.' kWh',$Solartoday.' W/m2',$Temptoday.' °C'); //รวม array

        return Response::json($siteinfo, 200, [], JSON_NUMERIC_CHECK);       

    }

    public function Profile()
    {
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        $Site = tbUserID::find(Auth::user()->Site_ID);
        return view('producttemplate.m250.content.profile',
        [
            'Site' => $Site,
            'profileinfo' => $userinfo,
            'userdatap' => $userinfo,
        ]);
    }

    public function m250changepass()
    {
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        $Site = tbUserID::find(Auth::user()->Site_ID);
        return view('producttemplate.m250.content.changepass',
        [
            'Site' => $Site,            
            'profileinfo' => $userinfo,
            'userdatap' => $userinfo,
        ]);
    }
}
