<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbPCSInfo;
use Excel;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;
class powerchartController extends Controller
{

    
    public function getDashboard()
        {
        //Start ดึงข้อมูลเพื่อแสดงที่ Site Information
        // ดึงจำนวน Inv ทั้งหมด
        $Invnum = DB::table('tbPCSInfo')
        ->distinct()
        ->where('UserID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->get(['SerialNo'])
        ->count();

       
        // ดึง Power
        $Power = DB::table('tbPCSInfo')
        ->where('UserID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
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
        ->where('UserID', '=',  Auth::user()->Site_ID)
        ->whereDate('x' ,'=', date('Y-m-d'))
        ->selectRaw('SUM(y) as y')
        ->get();
        foreach( $Energy as $Energys ){
           $Energytoday = $Energys->y;
       }
       
     //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information
            $view = view("producttemplate.M250.content.dashboard",[
                'Power' => $tpp,
                'Energy' => $Energy,
            ])->render();
            return response()->json(['html'=>$view]);
        }
    
    public function getDaily()
        {
            $view = view("producttemplate.M250.content.daily")->render();
            return response()->json(['html'=>$view]);
        }
    
    public function getMonthly()
        {
            $view = view("producttemplate.M250.content.monthly")->render();
            return response()->json(['html'=>$view]);
        }

    public function getYearly()
        {
            $view = view("producttemplate.M250.content.yearly")->render();
            return response()->json(['html'=>$view]);
        }

    public function InvDetaildaily()
        {
            $MB = Input::get('MB');
            $INV = Input::get('INV');
           
            $view = view("producttemplate.M250.content.InvDetaildaily",['MB' => $MB, 'INV' => $INV])->render();
            return response()->json(['html'=>$view]);
        }

    public function InvDetailmonthly()
        {
            $MB = Input::get('MB');
            $INV = Input::get('INV');
            $view = view("producttemplate.M250.content.InvDetailmonthly",['MB' => $MB, 'INV' => $INV])->render();
            return response()->json(['html'=>$view]);
        }

    public function InvDetailyearly()
        {
            $MB = Input::get('MB');
            $INV = Input::get('INV');
            $view = view("producttemplate.M250.content.InvDetailyearly",['MB' => $MB, 'INV' => $INV])->render();
            return response()->json(['html'=>$view]);
        }


    

}
