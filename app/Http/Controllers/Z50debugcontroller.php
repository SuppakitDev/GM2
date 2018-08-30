<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\product_list;
use App\tbPCSInfo;
use App\client_company;
use Auth;
use DB;
use App\Building;
use App\Department;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
class Z50debugcontroller extends Controller
{
    public function index(){
        return view('Debug.z50debug');
    }

    public function Debugdaily()
    {
        $MB = Input::get('MB');
        $INV = Input::get('INV');
       
        $view = view("Debug.Debugdaily",['MB' => $MB, 'INV' => $INV])->render();
        return response()->json(['html'=>$view]);
    }

public function Debugmonthly()
    {
        $MB = Input::get('MB');
        $INV = Input::get('INV');
        $view = view("Debug.Debugmonthly",['MB' => $MB, 'INV' => $INV])->render();
        return response()->json(['html'=>$view]);
    }

public function Debugyearly()
    {
        $MB = Input::get('MB');
        $INV = Input::get('INV');
        $view = view("Debug.Debugyearly",['MB' => $MB, 'INV' => $INV])->render();
        return response()->json(['html'=>$view]);
    }



public function getDailyDebug(){
         
        header("Content-type: text/json");
        $Daily = Input::get('Daily');
        $data = DB::table('z50pcs_info')
        ->whereDate('created_at' ,'=', Date($Daily))
        ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 AS x ,RT_powerout as y')
        ->get();
    
        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
        }

public function getMonthlyDebug(){      
    
            header("Content-type: text/json");
            $Daily = Input::get('Daily');
            $data = DB::table('z50pcs_info')
            ->where('Site_ID','=',Auth::user()->Site_ID) 
            ->whereDate('created_at' ,'=', Date($Daily))
            ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 AS x ,RT_powerout as y')
            ->get();
        
            return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
        }

public function getYearlyDebug(){
                header("Content-type: text/json");
                $MB = Input::get('MB');
                $INV = Input::get('INV');
                $Yearly = Input::get('Yearly');
                $data = DB::table('tbPCSInfo')
                ->where('UserID', '=', Auth::user()->Site_ID)
                ->where('MBxID' ,'=',$MB)
                ->where('PcsID' ,'=', $INV)
                ->whereYear('time' ,'=',$Yearly)         
                ->select(DB::raw('MONTH(time)-1 AS x ,MAX(PConsumption) - MIN(PConsumption) AS y'))                    
                ->groupBy('x')
                ->get();

                    return Response::json($data, 200, [], JSON_NUMERIC_CHECK);     
        }

}
