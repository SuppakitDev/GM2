<?php

namespace App\Http\Controllers;
use App\User;
use App\product_list;
use App\client_company;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Building;
use App\z50_site;
use App\tbUserID;
use App\Department;
class UserfilterController extends Controller
{
   public function filter(){
    $product = product_list::all();
    $userinfo = User::with('product_lists')->find(Auth::user()->id);
    if(Auth::user()->Status == "ADMIN")
    {
        return view('mastertemplate.admin.admin',
        [
            'userdatap' => $userinfo,
            'productdata' => $product,
        ]);

    }else
    {
        if(Auth::user()->P_ID == 99)
            {
                
                $Build = DB::table('Building')->where('C_ID',Auth::user()->C_ID)->get();
                $usercount = DB::table('users') ->where([
                    ['C_ID', '=', Auth::user()->C_ID],
                    ['Status', '=', 'USER'],
                ])->count();

                $userlist = DB::table('users')
                ->join('client_company', 'users.C_ID', '=', 'client_company.id')
                ->join('building', 'users.B_ID', '=', 'building.id')
                ->join('department', 'users.List_DeptID', '=', 'department.id')
                ->join('product_list', 'users.P_ID', '=', 'product_list.id')
                ->select('users.*', 'client_company.C_Name', 'building.B_Name', 'department.Dept_Name','product_list.P_Name')
                ->where ('users.C_ID','=',Auth::user()->C_ID )
                ->where ('Status','=','USER' )
                ->paginate(5);

                return view('producttemplate.ems.index',
                [
                    'userdatap' => $userinfo,
                    'usermember' => $userlist,
                    'buildinglist' => $Build,
                    'UC' => $usercount,

                ]);
            }
            if(Auth::user()->P_ID == 1)
            {
         //Start ดึงข้อมูลเพื่อแสดงที่ Site Information
        // ดึงจำนวน Inv ทั้งหมด
        $Invnum = DB::table('tbPCSInfo')
        ->distinct()
        ->where('UserID','=',1) //จำลองการกรองในอนาคต
        ->get(['SerialNo'])
        ->count();

       
        // ดึง Power
        $Power = DB::table('tbPCSInfo')
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
        ->where('UserID', '=', 1)
        ->whereDate('x' ,'=', date('Y-m-d'))
        ->selectRaw('SUM(y) as y')
        ->get();
        foreach( $Energy as $Energys ){
           $Energytoday = $Energys->y;
       }
       
     //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information

                $Site = tbUserID::find(1);
                return view('producttemplate.M250.index',
                [
                    'userdatap' => $userinfo,
                    'Site' => $Site,
                    'Power' => $tpp,
                    'Energytoday' => $Energytoday,
                ]);
            }

    if(Auth::user()->P_ID == 2)
            {
         //Start ดึงข้อมูลเพื่อแสดงที่ Site Information
        // ดึงจำนวน Inv ทั้งหมด
        $Invnum = DB::table('tbPCSInfo')
        ->distinct()
        ->where('UserID','=',1) //จำลองการกรองในอนาคต
        ->get(['SerialNo'])
        ->count();

       
        // ดึง Power
        $Power = DB::table('tbPCSInfo')
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
        ->where('UserID', '=', 1)
        ->whereDate('x' ,'=', date('Y-m-d'))
        ->selectRaw('SUM(y) as y')
        ->get();
        foreach( $Energy as $Energys ){
           $Energytoday = $Energys->y;
       }
       
     //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information

                $Site = z50_site::find(Auth::user()->Site_ID);
                return view('producttemplate.Z50-GW.index',
                [
                    'userdatap' => $userinfo,
                    'Site' => $Site,
                    'Power' => $tpp,
                    'Energytoday' => $Energytoday,
                ]);
            }
    }

    }

    public function admingotoems(){
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        $product = product_list::paginate(5);
  
       
        $managerlist = User::whereHas('client_companys', function($q){
            $q->where([
                     ['P_ID', '=', '1'],
                     ['Status', '=', 'MANAGER'],
                 ]);
        })->paginate(5);
        return view('producttemplate.ems.index',
        [
            'userdatap' => $userinfo,
            'productdata' => $product,
            'managermember' => $managerlist,
            
        ]);
    }

    public function admingotom250(){
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        return view('producttemplate.m250.index',
        [
            'userdatap' => $userinfo,
        ]);
    }

}
