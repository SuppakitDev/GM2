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

class OverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = product_list::all();
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        // $Build = DB::table('Building')->where('C_ID',Auth::user()->C_ID)->get();
        

        // $userlist = User::with('client_companys','buildings')
        // ->where([
        //     ['C_ID', '=', Auth::user()->C_ID],
        //     ['Status', '=', 'USER'],
        // ])->get();

        //test join table
        $userlist = DB::table('users')
        ->join('client_company', 'users.C_ID', '=', 'client_company.id')
        ->join('building', 'users.B_ID', '=', 'building.id')
        ->join('department', 'users.List_DeptID', '=', 'department.id')
        ->select('users.*', 'client_company.C_Name', 'building.B_Name', 'department.Dept_Name')
        ->where ('users.C_ID','=',Auth::user()->C_ID )
        ->where ('Status','=','USER' )
        ->get();


        
        return view('producttemplate.ems.content.managermonitor',
        [
            'userdatap' => $userinfo,
            'productdata' => $product,
            'usermember' => $userlist,
            // 'buildinglist' => $Build,
            
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getlivedata(){
        header("Content-type: text/json");
        $data = DB::table('tbPCSInfo')
        ->where('UserID','=',Auth::user()->Site_ID)
        ->groupBy('Time')
        ->selectRaw('(UNIX_TIMESTAMP(Time))*1000 AS x ,SUM(Pac) as y')
        ->orderBY('Time','DESC')
        ->LIMIT(1)
        ->get();
            // $d = strip_tags($date);
            // $date = [[1516763752000,15]];
        
        
            // $por = json_encode($data,JSON_NUMERIC_CHECK);
            // return Response::json($data);
            return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
            
    }

    //**function get data realtime from data base.
    public function getlastdata(){

        header("Content-type: text/json");
        $data = DB::table('tbPCSInfo')
        ->where('UserID','=',Auth::user()->Site_ID)
        ->groupBy('Time')
        ->selectRaw('(UNIX_TIMESTAMP(Time))*1000 AS x ,SUM(Pac) as y')
        ->orderBY('Time','DESC')
        ->LIMIT(1)
        ->get();
        foreach ($data as $datas) {
            $x = $datas->x;
            $y = $datas->y;
        }
        $ret = array($x, $y);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK);

        
        
    }


    // **function get Daily data from database
    public function getDailydata(){
    header("Content-type: text/json");
        $Daily = Input::get('Daily');
        $data = DB::table('tbPCSInfo')
        ->where('UserID','=',Auth::user()->Site_ID)
            ->groupBy('Time')
            ->whereDate('Time' ,'=', Date($Daily))
            ->selectRaw('(UNIX_TIMESTAMP(Time))*1000 AS x ,SUM(Pac) as y')            
            ->get();
            return Response::json($data, 200, [], JSON_NUMERIC_CHECK);     
    }

    // **function get Monthly data from database
    public function getMonthlydata(){

    
    header("Content-type: text/json");
    
    $Monthly = Input::get('Monthly');
    $Y = Input::get('YY');
    $Monthdata = DB::table('total_pconsumption')
    ->where('UserID', '=', Auth::user()->Site_ID)
    ->whereYear('x' ,'=',$Y)         
    ->whereMonth('x' ,'=',$Monthly)
    ->select(DB::Raw('DAY(x) as x , SUM(y) as y'))
    ->groupBy(DB::Raw('UNIX_TIMESTAMP(DATE(x))*1000'))
    ->get();

    
    return Response::json($Monthdata, 200, [], JSON_NUMERIC_CHECK);     
}



    // **function get Yearly data from database
    public function getYearlydata(){
        header("Content-type: text/json");
        $Yearly = Input::get('Yearly');
        $data = DB::table('total_pconsumption')
        ->where('UserID', '=', Auth::user()->Site_ID)
        ->whereYear('x' ,'=',$Yearly)         
        ->select(DB::raw('MONTH(x)-1 AS x ,SUM(y) AS y '))                    
        ->groupBy(DB::Raw('MONTH(x)-1'))
        ->get();

        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);     
    }




    public function getDailydataINV(){
       
        header("Content-type: text/json");
            $MB = Input::get('MB');
            $INV = Input::get('INV');
            $Daily = Input::get('Daily');
            $data = DB::table('tbPCSInfo')
                ->where('UserID','=',Auth::user()->Site_ID)
                ->where('MBxID' ,'=',$MB)
                ->where('PcsID' ,'=', $INV)
                ->whereDate('Time' ,'=', Date($Daily))
                ->selectRaw('(UNIX_TIMESTAMP(Time))*1000 AS x ,Pac as y')            
                ->get();
                return Response::json($data, 200, [], JSON_NUMERIC_CHECK);     
        }

        public function getMonthlydataINV(){
        
            header("Content-type: text/json");
            $MB = Input::get('MB');
            $INV = Input::get('INV');
            $Monthly = Input::get('Monthly');
            $Y = Input::get('YY');
            $data = DB::table('tbPCSInfo')
            ->where('UserID','=',Auth::user()->Site_ID)
            ->whereYear('Time' ,'=',$Y)  
            ->where('MBxID' ,'=',$MB)
            ->where('PcsID' ,'=', $INV)          
            ->whereMonth('Time' ,'=',$Monthly)
            ->select(DB::raw('DAY(Time) as x ,MAX(PConsumption) - MIN(PConsumption) AS y '))
            ->groupBy(DB::raw('UNIX_TIMESTAMP(DATE(Time))*1000') )
            ->get();
            return Response::json($data, 200, [], JSON_NUMERIC_CHECK);     
        }

        public function getYearlydataINV(){
                header("Content-type: text/json");
                $MB = Input::get('MB');
                $INV = Input::get('INV');
                $Yearly = Input::get('Yearly');
                // $Y = Input::get('YY');
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
