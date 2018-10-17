<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\z50pcs_info;
use App\z50_site;
use App\sum_of_z50info;
use App\error_code;
use App\model_type;
use App\tbUserID;
use App\User;
use Excel;
use DateTime;
use DB;
use Auth;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class Z50Controller extends Controller
{
    public function z50getDashboard()
    {
        // ดึง ALL DATA
    $z50user = User::find(Auth::user()->id);
    $serialnolist = DB::table('z50_site')
                    ->where('Site_ID', '=', $z50user->Site_ID)
                    ->select('SerialNolist')
                    ->get();
    foreach ($serialnolist as $serialnolists) 
        {
            $SerialNolist = explode(",",$serialnolists->SerialNolist);
        }
    $SiteName = DB::table('z50_site')
        ->where('Site_ID', '=', $z50user->Site_ID)
        ->select('SiteName')
        ->get();
    foreach ($SiteName as $SiteNames) 
    {
        $SiteName = $SiteNames->SiteName;
    }
    $result = DB::table('z50pcs_info')
            ->whereIn('SerialNo',$SerialNolist)
            ->select('RT_poweraccum')
            ->latest()
            ->limit(2)
            ->get();

    $DATA = DB::table('sum_of_z50info')
    
    ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
    ->latest() 
    ->limit(1)                
    ->get();

    $DATA2 = z50pcs_info::with('suppression_descripts')
    ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
    ->latest() 
    ->limit(1)                
    ->get();

    $serialnolist = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNolist')
        ->limit(1)  
        ->get();          
        foreach ($serialnolist as $serialnolists) {
            $serialnolist = $serialnolists->SerialNolist;
            
        }
        $serialnolist = explode(",",$serialnolist); 
       
        $Address = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('Address')
                ->get();
                foreach ($Address as $Addresss) {
                    $Address = $Addresss->Address; 
                }

        $FIT = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('FIT')
                ->get();
                foreach ($FIT as $FITs) {
                    $FIT = $FITs->FIT; 
                }
         $Capacity = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('Capacity')
                ->get();
                foreach ($Capacity as $Capacitys) {
                    $Capacity = $Capacitys->Capacity; 
                }

        $Co2_Criterion = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('Co2_Criterion')
                ->get();
                foreach ($Co2_Criterion as $Co2_Criterions) {
                    $Co2_Criterion = $Co2_Criterions->Co2_Criterion; 
                }
        // จัดการข้อมูล Power Accum
                 // All SerialNo Item
    $SerialNoitem = DB::table('users')
    ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
    ->latest() 
    ->select('SerialNoitem')
    ->limit(1)  
    ->get();          
    foreach ($SerialNoitem as $SerialNoitems) {
        $SerialNoitem = $SerialNoitems->SerialNoitem;  
    }
    $SerialNoitem = explode(",",$SerialNoitem); 

   // All SerialNo list
   $SerialNolist = DB::table('sum_of_z50info')
    ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
    ->latest() 
    ->select('SerialNolist')
    ->limit(1)  
    ->get();          
    foreach ($SerialNolist  as $SerialNolists) {
        $SerialNolist = $SerialNolists->SerialNolist;  
    }
    $SerialNolist = explode(",",$SerialNolist); 

    $accum = DB::table('sum_of_z50info')
    ->where('Site_ID','=', Auth::user()->Site_ID) 
    ->latest() 
    ->select('RT_poweraccum as y')
    ->limit(1)  
    ->get();          

// Loop check
$ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial

$StatusTranferresult = array();
$result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);


    for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
    {
        for($j = 0 ; $j < sizeof($result) ; $j++ )
        {
            if($SerialNolist[$i] == $result[$j] )
            {
                $ArrRef[$i] = 1;
            }
           
        }      
    }


for($l = 0 ; $l < sizeof($accum); $l++)
{
    $poweroutarray = explode(",",$accum[$l]->y);
    $poweroutsum = 0;
    for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
    {
        if($ArrRef[$y] == 1)
        {
            $poweroutsum += $poweroutarray[$y];
        }

    }
    $accum[$l]->y =  number_format($poweroutsum, 2, '.', ' ');
   
}
foreach ($accum as $accums) {
   $accum = $accums->y;
   
}

   
// return $accum;
        // จัดการข้อมูล Power Accum
 //Stop ดึงข้อมูลเพื่อแสดงที่ Site Information
        $view = view("producttemplate.Z50-GW.content.dashboard",[
            'DATA' => $DATA,
            'accum' => $accum,
            'DATA2' => $DATA2,
            'Z50siteAddress' => $Address,
            'Co2_Criterion' => $Co2_Criterion,
            'FIT' => $FIT,
            'Capacity' => $Capacity,
            'result' => $result,
            'SiteName' => $SiteName,
            'serialnolist' => $serialnolist,
        ])->render();
        return response()->json(['html'=>$view]);
    }

    public function z50getlastpower()
    {
        header("Content-type: text/json");

        // All SerialNo Item
         $SerialNoitem = DB::table('users')
         ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
         ->latest() 
         ->select('SerialNoitem')
         ->limit(1)  
         ->get();          
         foreach ($SerialNoitem as $SerialNoitems) {
             $SerialNoitem = $SerialNoitems->SerialNoitem;  
         }
         $SerialNoitem = explode(",",$SerialNoitem); 

        // All SerialNo list
        $SerialNolist = DB::table('sum_of_z50info')
         ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
         ->latest() 
         ->select('SerialNolist')
         ->limit(1)  
         ->get();          
         foreach ($SerialNolist  as $SerialNolists) {
             $SerialNolist = $SerialNolists->SerialNolist;  
         }
         $SerialNolist = explode(",",$SerialNolist); 

        $data = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) 
        ->latest() 
        ->select('RT_powerout as y')
        ->limit(1)  
        ->get();
        
         // Loop check
         $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
        
         $StatusTranferresult = array();
         $result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);
 
 
             for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
             {
                 for($j = 0 ; $j < sizeof($result) ; $j++ )
                 {
                     if($SerialNolist[$i] == $result[$j] )
                     {
                         $ArrRef[$i] = 1;
                     }
                    
                 }      
             }
         
 
         for($l = 0 ; $l < sizeof($data); $l++)
         {
             $poweroutarray = explode(",",$data[$l]->y);
             $poweroutsum = 0;
             for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
             {
                 if($ArrRef[$y] == 1)
                 {
                     $poweroutsum += $poweroutarray[$y];
                 }
 
             }
             $data[$l]->y = number_format($poweroutsum, 2, '.', ' ');;
             
         }
        foreach ($data as $datas) {
            $data = $datas->y;
            
        }
        $data = array($data);

        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }


    public function z50getlastpowerchart()
    {
        header("Content-type: text/json");

                 // All SerialNo Item
                 $SerialNoitem = DB::table('users')
                 ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
                 ->latest() 
                 ->select('SerialNoitem')
                 ->limit(1)  
                 ->get();          
                 foreach ($SerialNoitem as $SerialNoitems) {
                     $SerialNoitem = $SerialNoitems->SerialNoitem;  
                 }
                 $SerialNoitem = explode(",",$SerialNoitem); 
        
                // All SerialNo list
                $SerialNolist = DB::table('sum_of_z50info')
                 ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
                 ->latest() 
                 ->select('SerialNolist')
                 ->limit(1)  
                 ->get();          
                 foreach ($SerialNolist  as $SerialNolists) {
                     $SerialNolist = $SerialNolists->SerialNolist;  
                 }
                 $SerialNolist = explode(",",$SerialNolist); 

        $data = DB::table('sum_of_z50info')
        ->where('Site_ID','=',Auth::user()->Site_ID) 
        ->whereDate('created_at' ,'=', date('Y-m-d'))        
        ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 as x , RT_powerout as y')
        ->latest()    
        ->limit(5)
        ->get();
    

         // Loop check
         $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
        
         $StatusTranferresult = array();
         $result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);
 
 
             for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
             {
                 for($j = 0 ; $j < sizeof($result) ; $j++ )
                 {
                     if($SerialNolist[$i] == $result[$j] )
                     {
                         $ArrRef[$i] = 1;
                     }
                    
                 }      
             }
         
 
         for($l = 0 ; $l < sizeof($data); $l++)
         {
             $poweroutarray = explode(",",$data[$l]->y);
             $poweroutsum = 0;
             for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
             {
                 if($ArrRef[$y] == 1)
                 {
                     $poweroutsum += $poweroutarray[$y];
                 }
 
             }
             $data[$l]->y = $poweroutsum;
         }


        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }


    public function z50getlastpoweraccum()
    {
        header("Content-type: text/json");

             // All SerialNo Item
             $SerialNoitem = DB::table('users')
             ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
             ->latest() 
             ->select('SerialNoitem')
             ->limit(1)  
             ->get();          
             foreach ($SerialNoitem as $SerialNoitems) {
                 $SerialNoitem = $SerialNoitems->SerialNoitem;  
             }
             $SerialNoitem = explode(",",$SerialNoitem); 
    
            // All SerialNo list
            $SerialNolist = DB::table('sum_of_z50info')
             ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
             ->latest() 
             ->select('SerialNolist')
             ->limit(1)  
             ->get();          
             foreach ($SerialNolist  as $SerialNolists) {
                 $SerialNolist = $SerialNolists->SerialNolist;  
             }
             $SerialNolist = explode(",",$SerialNolist); 

        $data = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) 
        ->latest() 
        ->select('RT_poweraccum as y')
        ->limit(1)  
        ->get();          
        
         // Loop check
         $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
        
         $StatusTranferresult = array();
         $result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);
 
 
             for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
             {
                 for($j = 0 ; $j < sizeof($result) ; $j++ )
                 {
                     if($SerialNolist[$i] == $result[$j] )
                     {
                         $ArrRef[$i] = 1;
                     }
                    
                 }      
             }
         
 
         for($l = 0 ; $l < sizeof($data); $l++)
         {
             $poweroutarray = explode(",",$data[$l]->y);
             $poweroutsum = 0;
             for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
             {
                 if($ArrRef[$y] == 1)
                 {
                     $poweroutsum += $poweroutarray[$y];
                 }
 
             }
             $data[$l]->y =  number_format($poweroutsum, 2, '.', ' ');
            
         }
        foreach ($data as $datas) {
            $data = $datas->y;
            
        }
        $data = array($data);
            
        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }


    public function z50getlastpoweraccumchart()
    {
        header("Content-type: text/json");

         // All SerialNo Item
         $SerialNoitem = DB::table('users')
         ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
         ->latest() 
         ->select('SerialNoitem')
         ->limit(1)  
         ->get();          
         foreach ($SerialNoitem as $SerialNoitems) {
             $SerialNoitem = $SerialNoitems->SerialNoitem;  
         }
         $SerialNoitem = explode(",",$SerialNoitem); 

        // All SerialNo list
        $SerialNolist = DB::table('sum_of_z50info')
         ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
         ->latest() 
         ->select('SerialNolist')
         ->limit(1)  
         ->get();          
         foreach ($SerialNolist  as $SerialNolists) {
             $SerialNolist = $SerialNolists->SerialNolist;  
         }
         $SerialNolist = explode(",",$SerialNolist);

        $data = DB::table('sum_of_z50info')
        ->where('Site_ID','=',Auth::user()->Site_ID) 
        ->whereDate('created_at' ,'=', date('Y-m-d'))  
        // ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 AS x ,Poweraccum_Total as y')
        ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 as x , RT_poweraccum as y')
        ->latest()    
        ->limit(5)
        ->get();

        // Loop check
        $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
        
        $StatusTranferresult = array();
        $result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);


            for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
            {
                for($j = 0 ; $j < sizeof($result) ; $j++ )
                {
                    if($SerialNolist[$i] == $result[$j] )
                    {
                        $ArrRef[$i] = 1;
                    }
                   
                }      
            }
        

        for($l = 0 ; $l < sizeof($data); $l++)
        {
            $poweroutarray = explode(",",$data[$l]->y);
            $poweraccumsum = 0;
            for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
            {
                if($ArrRef[$y] == 1)
                {
                    $poweraccumsum += $poweroutarray[$y];
                }

            }
            $data[$l]->y = $poweraccumsum;
        }

    
        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }


    public function z50getlastRevenue()
    {
        header("Content-type: text/json");

        // All SerialNo Item
        $SerialNoitem = DB::table('users')
        ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNoitem')
        ->limit(1)  
        ->get();          
        foreach ($SerialNoitem as $SerialNoitems) {
            $SerialNoitem = $SerialNoitems->SerialNoitem;  
        }
        $SerialNoitem = explode(",",$SerialNoitem); 

       // All SerialNo list
       $SerialNolist = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNolist')
        ->limit(1)  
        ->get();          
        foreach ($SerialNolist  as $SerialNolists) {
            $SerialNolist = $SerialNolists->SerialNolist;  
        }
        $SerialNolist = explode(",",$SerialNolist); 

   $data = DB::table('sum_of_z50info')
   ->where('Site_ID','=', Auth::user()->Site_ID) 
   ->latest() 
   ->select('RT_poweraccum as y')
   ->limit(1)  
   ->get();          
   
    // Loop check
    $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
   
    $StatusTranferresult = array();
    $result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);


        for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
        {
            for($j = 0 ; $j < sizeof($result) ; $j++ )
            {
                if($SerialNolist[$i] == $result[$j] )
                {
                    $ArrRef[$i] = 1;
                }
               
            }      
        }
    

    for($l = 0 ; $l < sizeof($data); $l++)
    {
        $poweroutarray = explode(",",$data[$l]->y);
        $poweroutsum = 0;
        for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
        {
            if($ArrRef[$y] == 1)
            {
                $poweroutsum += $poweroutarray[$y];
            }

        }
        $data[$l]->y =  number_format($poweroutsum, 2, '.', ' ');
       
    }
   foreach ($data as $datas) {
       $data = $datas->y;
       
   }
   $data = array($data);
       
   return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }

    public function z50gettodayenergy()
    {
        header("Content-type: text/json");
        // Serial Item
        $SerialNoitem = DB::table('users')
        ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNoitem')
        ->limit(1)  
        ->get();          
        foreach ($SerialNoitem as $SerialNoitems) 
        {
            $SerialNoitem = $SerialNoitems->SerialNoitem;  
        }
        $SerialNoitem = explode(",",$SerialNoitem); 
        $result = array();
        for($p = 0 ; $p < sizeof($SerialNoitem) ; $p++)
        {
            
            $Energytoday = DB::table('z50pcs_info')
            ->where('Site_ID','=',Auth::user()->Site_ID)
            ->where('SerialNo','=',$SerialNoitem[$p]) 
            ->whereDate('created_at' ,'=', date('Y-m-d'))
            ->selectRaw('MAX(RT_poweraccum) - MIN(RT_poweraccum)  as y')
            ->get();
            foreach( $Energytoday as $Energytodays ){
               $Energytoday = number_format($Energytodays->y,2);
           }
           $result[$p] = $Energytoday;
           
        }
        
        $Energytoday = array_sum($result);
        $Energytoday = array(number_format($Energytoday, 2, '.', ''));
          
        return Response::json($Energytoday, 200, [], JSON_NUMERIC_CHECK); 
       
    }

        public function z50getlastdata()
    {
        header("Content-type: text/json");
         // All SerialNo Item
         $SerialNoitem = DB::table('users')
         ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
         ->latest() 
         ->select('SerialNoitem')
         ->limit(1)  
         ->get();          
         foreach ($SerialNoitem as $SerialNoitems) {
             $SerialNoitem = $SerialNoitems->SerialNoitem;  
         }
         $SerialNoitem = explode(",",$SerialNoitem); 

        // All SerialNo list
        $SerialNolist = DB::table('sum_of_z50info')
         ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
         ->latest() 
         ->select('SerialNolist')
         ->limit(1)  
         ->get();          
         foreach ($SerialNolist  as $SerialNolists) {
             $SerialNolist = $SerialNolists->SerialNolist;  
         }
         $SerialNolist = explode(",",$SerialNolist); 

        $Daily = Input::get('date');
        $data = DB::table('sum_of_z50info')
        ->where('Site_ID','=',Auth::user()->Site_ID)
        ->whereDate('created_at' ,'=', Date($Daily))
        ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 as x , RT_powerout as y')
        // ->orderBY('x')
        ->get();

        // Loop check
        $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
        
        $StatusTranferresult = array();
        $result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);


            for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
            {
                for($j = 0 ; $j < sizeof($result) ; $j++ )
                {
                    if($SerialNolist[$i] == $result[$j] )
                    {
                        $ArrRef[$i] = 1;
                    }
                   
                }      
            }
        

        for($l = 0 ; $l < sizeof($data); $l++)
        {
            $poweroutarray = explode(",",$data[$l]->y);
            $poweroutsum = 0;
            for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
            {
                if($ArrRef[$y] == 1)
                {
                    $poweroutsum += $poweroutarray[$y];
                }

            }
            $data[$l]->y = $poweroutsum;
        }
        // return $poweroutarray;

        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);

// Old version
        // header("Content-type: text/json");
        // $Daily = Input::get('date');
        // $data = DB::table('sum_of_z50info')
        // ->where('Site_ID','=',Auth::user()->Site_ID)
        // ->whereDate('created_at' ,'=', Date($Daily))
        // ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 AS x , Powerout_Total as y')
        // ->orderBY('x')
        // ->get();

        // return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
// Old version
    }

    public function z50getlivedata()
    {
        header("Content-type: text/json");
        $data = DB::table('sum_of_z50info')
        ->where('Site_ID','=',Auth::user()->Site_ID)
        ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 AS x , Powerout_Total as y')
        ->orderBY('x','DESC')
        ->LIMIT(1)
        ->get();
        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }
       

    public function getInverror()
    {
        header("Content-type: text/json");
        $Invstatus = z50pcs_info::with('error_codes')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($Invstatus as $Invstatuss) {
            $a = $Invstatuss->error_codes->Descript;
            
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function getInvsuppression()
    {
        header("Content-type: text/json");
        $Invstatus = z50pcs_info::with('suppression_descripts')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($Invstatus as $Invstatuss) {
            $a = $Invstatuss->suppression_descripts->Descript;
            
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function getInvrecoverytime()
    {
        header("Content-type: text/json");
        $Invstatus = z50pcs_info::with('error_codes')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($Invstatus as $Invstatuss) {
            $a = $Invstatuss->Recoverytime;    
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }


    public function z50getlastmodel()
    {
        header("Content-type: text/json");
        $modeltype = z50pcs_info::with('model_types')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($modeltype as $modeltypes) {
            $a = $modeltypes->model_types->Descript;
            
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function z50getlastSerial()
    {
        header("Content-type: text/json");
        $serial = DB::table('z50pcs_info')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($serial as $serials) {
            $a = $serials->SerialNo;
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }

    
    public function z50getlaststatus()
    {
        header("Content-type: text/json");
        $modeltype = z50pcs_info::with('sts_pcss')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($modeltype as $modeltypes) {
            $a = $modeltypes->sts_pcss->Descript;
            
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }


    public function testfillter()
    {
        // ดึงข้อมูลชุดสุดท้ายออกมา
    $z50user = User::find(Auth::user()->id);
    $serialnolist = DB::table('z50_site')
                    ->where('Site_ID', '=', $z50user->Site_ID)
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
                    // ->whereDate('created_at', DB::raw('CURDATE()'))
                    ->select('RT_powerout','RT_poweraccum','created_at','SerialNo')
                    ->latest()
                    ->limit(1)
                    ->get();

        //การจัดเตรียมข้อมูล Status

        // Status Description of tranfer system.
            // A : Don't receive data over than 10 minute
            // B : Normal work
            // C : Never received

                foreach ($result as $results) 
                {
                    $date = new DateTime;
                    $date->modify('-5 minutes');
                    $formatted_date = $date->format('Y-m-d H:i:s');

                    if($results->created_at < $formatted_date )
                    {
                        $RT_powerout = 0;
                        $RT_poweraccum = 0;
                        $Tranfer_status = "A";
                    }
                    else
                    {
                        $RT_powerout = $results->RT_powerout;
                        $RT_poweraccum = $results->RT_poweraccum;
                        $Tranfer_status = "B";
                    }
                }
                $Tranfer_statusArray[] = $Tranfer_status;
                $RT_poweroutArray[] = $RT_powerout;
                $RT_poweraccumArray[] = $RT_poweraccum;

        //เซ็ตค่า Default ในกรณีที่ไม่มีข้อมูลของ Serialno นั้นเข้ามา    
                $RT_powerout = 0;
                $RT_poweraccum = 0;

                $Tranfer_status = "C";

                
                $RT_poweroutTotal = array_sum($RT_poweroutArray);
                $RT_poweraccumTotal = array_sum($RT_poweraccumArray);
            
        }
        dump($Tranfer_statusArray);
        dump($RT_poweroutArray);
        dump($RT_poweraccumArray);
        echo($formatted_date."<br>");
        echo($RT_poweroutTotal."<br>");
        echo($RT_poweraccumTotal);
        dump($SerialNolist);
    }




    public function Insertsumofdata()
    {
        // ดึงข้อมูลชุดสุดท้ายออกมา
    $z50user = User::find(Auth::user()->id);
    $serialnolist = DB::table('z50_site')
                    ->where('Site_ID', '=', $z50user->Site_ID)
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
                    ->select('RT_powerout','Pcs_status','RT_poweraccum','created_at','SerialNo')
                    ->latest()
                    ->limit(1)
                    ->get();

        //การจัดเตรียมข้อมูล Status

        // Status Description of tranfer system.
     
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
        //Insert to data base

        $total = new sum_of_z50info();
        
        $total->Site_ID           = $z50user->Site_ID;
        $total->Powerout_Total            = $RT_poweroutTotal ;
        $total->Poweraccum_Total           = $RT_poweraccumTotal;
        $total->Tranfer_status          = implode(",",$Tranfer_statusArray); 
        $total->Pcs_status          = implode(",",$Tranfer_statusArray); 
        $total->SerialNolist         = implode(",",$SerialNolist); 
        $total->RT_powerout         = implode(",",$RT_poweroutArray); 
        $total->RT_poweraccum         = implode(",",$RT_poweraccumArray); 
        $total->Pcs_status         = implode(",",$Pcs_statusArray); 


        $total->save();


    }

    public function getstatustranfer()
    {   

        header("Content-type: text/json");
        // All Tranfer status
        $statustranfer = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('Tranfer_status')
        ->limit(1)  
        ->get();          
        foreach ($statustranfer as $statustranfers) {
            $statustranfer = $statustranfers->Tranfer_status;
            
        }

        $statustranfer = explode(",",$statustranfer); 
        // Serial Item
        $SerialNoitem = DB::table('users')
        ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNoitem')
        ->limit(1)  
        ->get();          
        foreach ($SerialNoitem as $SerialNoitems) {
            $SerialNoitem = $SerialNoitems->SerialNoitem;  
        }
        $SerialNoitem = explode(",",$SerialNoitem); 
        // All SerialNo list
        $SerialNolist = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNolist')
        ->limit(1)  
        ->get();          
        foreach ($SerialNolist  as $SerialNolists) {
            $SerialNolist = $SerialNolists->SerialNolist;  
        }
        $SerialNolist = explode(",",$SerialNolist); 

        // Loop check
        $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
        
        $StatusTranferresult = array();
        $result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);


            for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
            {
                for($j = 0 ; $j < sizeof($result) ; $j++ )
                {
                    if($SerialNolist[$i] == $result[$j] )
                    {
                        $ArrRef[$i] = 1;
                    }
                   
                }      
            }
        

        for($l = 0 ; $l < sizeof($ArrRef); $l++)
        {
            if($ArrRef[$l] == 1 )
            {
                $StatusTranferresult[] = $statustranfer[$l];
            }
        }
        // $StatusTranferresult = array_filter($StatusTranferresult); 

       
        // Loop check
        // return $ArrRef;
        // return ($StatusTranferresult);
        return Response::json($StatusTranferresult, 200, [], JSON_NUMERIC_CHECK);        

    }

    public function getstatusInverter()
    {   

        header("Content-type: text/json");
        $statusInv = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('Pcs_status')
        ->limit(1)  
        ->get();          
        foreach ($statusInv as $statusInvs) {
            $statusInv = $statusInvs->Pcs_status;
            
        }

        $statusInv = explode(",",$statusInv); 

        // Serial Item
        $SerialNoitem = DB::table('users')
        ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNoitem')
        ->limit(1)  
        ->get();          
        foreach ($SerialNoitem as $SerialNoitems) {
            $SerialNoitem = $SerialNoitems->SerialNoitem;  
        }
        $SerialNoitem = explode(",",$SerialNoitem); 
        // All SerialNo list
        $SerialNolist = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNolist')
        ->limit(1)  
        ->get();          
        foreach ($SerialNolist  as $SerialNolists) {
            $SerialNolist = $SerialNolists->SerialNolist;  
        }
        $SerialNolist = explode(",",$SerialNolist); 

        // Loop check
        $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
        
        $StatusInvresult = array();
        $result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);


            for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
            {
                for($j = 0 ; $j < sizeof($result) ; $j++ )
                {
                    if($SerialNolist[$i] == $result[$j] )
                    {
                        $ArrRef[$i] = 1;
                    }
                   
                }      
            }
        

        for($l = 0 ; $l < sizeof($ArrRef); $l++)
        {
            if($ArrRef[$l] == 1 )
            {
                $StatusInvresult[] = $statusInv[$l];
            }
        }

        return Response::json($StatusInvresult, 200, [], JSON_NUMERIC_CHECK);        

    }

    public function getserialnolist()
    {   
        header("Content-type: text/json");
        $SerialNoitem = DB::table('users')
        ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNoitem')
        ->limit(1)  
        ->get();          
        foreach ($SerialNoitem as $SerialNoitems) {
            $SerialNoitem = $SerialNoitems->SerialNoitem;
            
        }
        $SerialNoitem = explode(",",$SerialNoitem); 
        return Response::json($SerialNoitem, 200, [], JSON_NUMERIC_CHECK);        

    }

    public function z50getinvoverview()
    {
        // ดึงข้อมูลชุดสุดท้ายออกมา
    $z50user = User::find(Auth::user()->id);
    $serialnolist = DB::table('users')
                    ->where('id', '=', Auth::user()->id)
                    ->select('SerialNoitem')
                    ->get();
    foreach ($serialnolist as $serialnolists) 
        {
            $SerialNolist = explode(",",$serialnolists->SerialNoitem);
        }
        for($i = 0 ; $i <= sizeof($SerialNolist)-1 ; $i++)
        {
                    $result = DB::table('z50pcs_info')
                    ->where('SerialNo','=',$SerialNolist[$i])
                    ->select('RT_powerout','RT_poweraccum','created_at','SerialNo')
                    ->latest()
                    ->limit(1)
                    ->get();

        //การจัดเตรียมข้อมูล Status

        // Status Description of tranfer system.
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
                        $RT_poweraccum = 0;
                        $Tranfer_status = "B";
                    }
                    else
                    {
                        $RT_powerout = $results->RT_powerout;
                        $RT_poweraccum = $results->RT_poweraccum;
                        $Tranfer_status = "A";
                    }
                }
                $Tranfer_statusArray[] = $Tranfer_status;
                $RT_poweroutArray[] = $RT_powerout;
                $RT_poweraccumArray[] = $RT_poweraccum;

        //เซ็ตค่า Default ในกรณีที่ไม่มีข้อมูลของ Serialno นั้นเข้ามา    
                $RT_powerout = 0;
                $RT_poweraccum = 0;

                $Tranfer_status = "C";

                
                $RT_poweroutTotal = array_sum($RT_poweroutArray);
                $RT_poweraccumTotal = array_sum($RT_poweraccumArray);
            
        }
        for($i = 0 ; $i <= sizeof($SerialNolist)-1 ; $i++)
        {
        $ret[] = array($SerialNolist[$i],$RT_poweroutArray[$i]);
        }
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK);    
    }  
    
    
    //ส่วนของ Z50 Overview
    public function GotothisSite()
    {
        $Site = z50_site::find(Auth::user()->Site_ID);
        $DATA = z50pcs_info::with('error_codes')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();

        $DATA2 = z50pcs_info::with('suppression_descripts')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();

       
        $Z50inverter = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->limit(1)  
        ->get();          
        foreach ($Z50inverter as $Z50inverters) {
            $RT_powerout = $Z50inverters->RT_powerout;
            $RT_poweraccum = $Z50inverters->RT_poweraccum;
        }

        // $Z50serial = explode(",",$Z50serial); 
        $RT_powerout = explode(",",$RT_powerout); 
        $RT_poweraccum = explode(",",$RT_poweraccum); 

        $SerialNoitem = DB::table('users')
        ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNoitem')
        ->limit(1)  
        ->get();          
        foreach ($SerialNoitem as $SerialNoitems) 
        {
            $SerialNoitem = $SerialNoitems->SerialNoitem;  
        }
        $SerialNoitem = explode(",",$SerialNoitem); 

        return view('producttemplate.Z50-GW.content.Z50Overview',
        [
            'Site' => $Site,
            'DATA' => $DATA,
            'DATA2' => $DATA2,
            'Z50serial' => $SerialNoitem,
            'RT_powerout' => $RT_powerout,
            'RT_poweraccum' => $RT_poweraccum
        ]);
        
    }

    public function getZ50power_out()
    {
        $SR = Input::get('Serialno'); 
        header("Content-type: text/json");
        $result = DB::table('z50pcs_info')
                    // ->where('Site_ID','=', Auth::user()->Site_ID)
                    ->where('SerialNo','=', $SR)
                    ->select('RT_powerout')
                    ->latest()
                    ->limit(1)
                    ->get();
        foreach ($result as $results) 
        {
            $RT_powerout = number_format($results->RT_powerout, 2, '.', '');    
                      
        }
        $RT_powerout = array($RT_powerout);
        return Response::json($RT_powerout, 200, [], JSON_NUMERIC_CHECK);    
                
    }

    public function getINVStatus()
    {
        $SR = Input::get('Serialno'); 
        header("Content-type: text/json");
        $result = DB::table('z50pcs_info')
                    // ->where('Site_ID','=', Auth::user()->Site_ID)
                    ->where('SerialNo','=', $SR)
                    ->select('Pcs_status')
                    ->latest()
                    ->limit(1)
                    ->get();
        foreach ($result as $results) 
        {
            $sts = $results->Pcs_status;    
                      
        }
        return Response::json($sts, 200, [], JSON_NUMERIC_CHECK);    
                
    }
// ส่วนของ INV Detial
    public function Z50detail()
    {
        $z50user = User::find(Auth::user()->id);
        $serialnoz50 = Input::get('SerialNo');
        $Site = z50_site::find(Auth::user()->Site_ID);
        $DATA = z50pcs_info::with('error_codes')
        // ->where('Site_ID','=', Auth::user()->Site_ID)
        ->where('SerialNo','=',$serialnoz50)
        ->latest() 
        ->limit(1)                
        ->get();
        $Address = DB::table('z50_site')
        ->where('Site_ID', '=', Auth::user()->Site_ID)
        ->select('Address')
        ->get();
        foreach ($Address as $Addresss) {
            $Address = $Addresss->Address; 
        }
        $SiteName = DB::table('z50_site')
        ->where('Site_ID', '=', $z50user->Site_ID)
        ->select('SiteName')
        ->get();
    foreach ($SiteName as $SiteNames) 
    {
        $SiteName = $SiteNames->SiteName;
    }
        $DATA2 = z50pcs_info::with('suppression_descripts')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->where('SerialNo','=',$serialnoz50)
        ->latest() 
        ->limit(1)                
        ->get();
        
        $Capacity = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('Capacity')
                ->get();
                foreach ($Capacity as $Capacitys) {
                    $Capacity = $Capacitys->Capacity; 
                }

                $FIT = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('FIT')
                ->get();
                foreach ($FIT as $FITs) {
                    $FIT = $FITs->FIT; 
                }               
        return view('producttemplate.Z50-GW.content.Z50Invdetail',
        [
            'Site' => $Site,
            'DATA' => $DATA,
            'DATA2' => $DATA2,
            'FIT' => $FIT,
            'Z50siteAddress' => $Address,
            'SiteName' => $SiteName,
            'Capacity' => $Capacity,
            'serialnoz50' => $serialnoz50,
            
        ]);
    }

    public function z50getlastpowerchartDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');
        $data = DB::table('z50pcs_info')
        // ->where('Site_ID','=',Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->whereDate('created_at' ,'=', date('Y-m-d')) 
        ->where('SerialNo','=',$serialnoz50)       
        ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 AS x ,RT_Powerout as y')
        ->latest()    
        ->limit(5)
        ->get();
    
        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }

    public function z50getlastpowerDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');        
        $lastpower = DB::table('z50pcs_info')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->where('SerialNo','=',$serialnoz50)     
        ->latest() 
        ->select('RT_Powerout')
        ->limit(1)  
        ->get();          
        foreach ($lastpower as $lastpowers) {
            $lastpower = $lastpowers->RT_Powerout;
            
        }
        $lastpower = array($lastpower);
        return Response::json($lastpower, 200, [], JSON_NUMERIC_CHECK);
    }

    public function z50getlastpoweraccumchartDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo'); 
        $data = DB::table('z50pcs_info')
        // ->where('Site_ID','=',Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->whereDate('created_at' ,'=', date('Y-m-d')) 
        ->where('SerialNo','=',$serialnoz50) 
        ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 AS x ,RT_poweraccum as y')
        ->latest()    
        ->limit(5)
        ->get();
    
        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }

    public function z50getlastpoweraccumDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');  
        $lastpoweraccum = DB::table('z50pcs_info')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->where('SerialNo','=',$serialnoz50) 
        ->latest() 
        ->select('RT_poweraccum')
        ->limit(1)  
        ->get();          
        foreach ($lastpoweraccum as $lastpoweraccums) {
            $lastpoweraccum = $lastpoweraccums->RT_poweraccum;
            
        }
        $lastpoweraccum = array($lastpoweraccum);
        return Response::json($lastpoweraccum, 200, [], JSON_NUMERIC_CHECK);
    }

    public function z50gettodayenergyDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo'); 
        $Energytoday = DB::table('z50pcs_info')
        // ->where('Site_ID','=',Auth::user()->Site_ID)
        ->where('SerialNo','=',$serialnoz50) 
        ->whereDate('created_at' ,'=', date('Y-m-d'))
        ->selectRaw('MAX(RT_poweraccum) - MIN(RT_poweraccum)  as y')
        ->get();
        foreach( $Energytoday as $Energytodays ){
           $Energytoday = number_format($Energytodays->y,2);
       }
       $Energytoday = array($Energytoday);
        return Response::json($Energytoday, 200, [], JSON_NUMERIC_CHECK);
    }

    public function z50getlivedataDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');         
        $data = DB::table('z50pcs_info')
        // ->where('Site_ID','=',Auth::user()->Site_ID)
        ->where('SerialNo','=',$serialnoz50) 
        ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 AS x , RT_Powerout as y')
        ->orderBY('x','DESC')
        ->LIMIT(1)
        ->get();
        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }

    public function z50getlastdataDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');                 
        $data = DB::table('z50pcs_info')
        // ->where('Site_ID','=',Auth::user()->Site_ID)
        ->where('SerialNo','=',$serialnoz50) 
        ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 AS x , RT_Powerout as y')
        ->orderBY('x','DESC')
        ->LIMIT(1)
        ->get();
        foreach ($data as $datas) {
            $x = $datas->x;
            $y = $datas->y;
        }
        $ret = array($x, $y);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK);
    }

    public function getInverrorDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');   
        $Invstatus = z50pcs_info::with('error_codes')
        ->where('SerialNo','=',$serialnoz50) 
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($Invstatus as $Invstatuss) {
            $a = $Invstatuss->error_codes->Descript;
            
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function getInvsuppressionDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');  
        $Invstatus = z50pcs_info::with('suppression_descripts')
        ->where('SerialNo','=',$serialnoz50) 
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($Invstatus as $Invstatuss) {
            $a = $Invstatuss->suppression_descripts->Descript;
            
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }


    public function getInvrecoverytimeDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo'); 
        $Invstatus = z50pcs_info::with('error_codes')
        ->where('SerialNo','=',$serialnoz50) 
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($Invstatus as $Invstatuss) {
            $a = $Invstatuss->Recoverytime;    
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function z50getlastdatalayoutdetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo'); 
        $data = DB::table('z50pcs_info')
        // ->where('Site_ID','=',Auth::user()->Site_ID)
        ->where('SerialNo','=',$serialnoz50) 
        ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 AS x , RT_Powerout as y')
        ->orderBY('x','DESC')
        ->LIMIT(1)
        ->get();
        foreach ($data as $datas) {
            $x = $datas->x;
            $y = $datas->y;
        }
        $ret = array($x, $y);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK);
    }

    public function z50getlastRevenueDetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo'); 
        $lastpoweraccum = DB::table('z50pcs_info')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->where('SerialNo','=',$serialnoz50) 
        ->latest() 
        ->select('RT_poweraccum')
        ->limit(1)  
        ->get();          
        foreach ($lastpoweraccum as $lastpoweraccums) {
            $lastpoweraccum = $lastpoweraccums->RT_poweraccum;
            
        }
        $lastpoweraccum = array($lastpoweraccum);
        return Response::json($lastpoweraccum, 200, [], JSON_NUMERIC_CHECK);
    }

    public function z50gettodayenergylayoutdetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');
        $Energytoday = DB::table('z50pcs_info')
        // ->where('Site_ID','=',Auth::user()->Site_ID)
        ->where('SerialNo','=',$serialnoz50) 
        ->whereDate('created_at' ,'=', date('Y-m-d'))
        ->selectRaw('MAX(RT_poweraccum) - MIN(RT_poweraccum)  as y')
        ->get();
        foreach( $Energytoday as $Energytodays ){
           $Energytoday = number_format($Energytodays->y,2);
       }
       $Energytoday = array($Energytoday);
        return Response::json($Energytoday, 200, [], JSON_NUMERIC_CHECK);
    }

    public function z50getlastmodellayoutdetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');
        $modeltype = z50pcs_info::with('model_types')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->where('SerialNo','=',$serialnoz50) 
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($modeltype as $modeltypes) {
            $a = $modeltypes->model_types->Descript;
            
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function z50getlastSeriallayoutdetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');
        $serial = DB::table('z50pcs_info')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->where('SerialNo','=',$serialnoz50) 
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($serial as $serials) {
            $a = $serials->SerialNo;
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function z50getlaststatuslayoutdetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');
        $modeltype = z50pcs_info::with('sts_pcss')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->where('SerialNo','=',$serialnoz50) 
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($modeltype as $modeltypes) {
            $a = $modeltypes->sts_pcss->Descript;
            
        }
        $ret = array($a);
        return Response::json($ret, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function getstring1()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');
        $string1 = DB::table('z50pcs_info')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->where('SerialNo','=',$serialnoz50) 
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($string1 as $string1s) {
            $V = $string1s->Input_Vstr1;
            $C = $string1s->Input_Cstr1;
            $P = number_format(($V*$C)/1000,2);
           
            
            
        }
        $outputstring1 = array($V,$C,$P);
        return Response::json($outputstring1, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function getstring2()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');
        $string2 = DB::table('z50pcs_info')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->where('SerialNo','=',$serialnoz50) 
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($string2 as $string2s) {
            $V = $string2s->Input_Vstr2;
            $C = $string2s->Input_Cstr2;
            $P = number_format(($V*$C)/1000,2);
           
            
            
        }
        $outputstring2 = array($V,$C,$P);
        return Response::json($outputstring2, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function getstring3()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');
        $string3 = DB::table('z50pcs_info')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->where('SerialNo','=',$serialnoz50) 
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($string3 as $string3s) {
            $V = $string3s->Input_Vstr3;
            $C = $string3s->Input_Cstr3;
            $P = number_format(($V*$C)/1000,2);
           
            
            
        }
        $outputstring3 = array($V,$C,$P);
        return Response::json($outputstring3, 200, [], JSON_NUMERIC_CHECK); 
    }



    public function checktranfertime()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');
        $Time = DB::table('z50pcs_info')
        ->where('SerialNo','=',$serialnoz50)
        ->select('created_at')
        ->latest()
        ->limit(1)
        ->get();


    foreach ($Time as $Times) 
    {
        $TimeTranfer = $Times->created_at;  
    }

    $date = new DateTime;
        $date->modify('-5 minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');
    if($TimeTranfer > $formatted_date )
        {
           $Timestatus = TRUE;
        }
        else
        {
           $Timestatus = FALSE;           
        }
        return Response::json($Timestatus, 200, [], JSON_NUMERIC_CHECK); 
    }


    public function Z50Profile()
    {
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        $Site = z50_site::find(Auth::user()->Site_ID);
        return view('producttemplate.Z50-GW.content.Z50profile',
        [
            'Site' => $Site,
            'profileinfo' => $userinfo,
            'userdatap' => $userinfo,
        ]);
    }

    public function Updatesumofdata()
    {
        // ดึงข้อมูลชุดสุดท้ายออกมา
    // $z50user = User::find(Auth::user()->id);
    $COUNT  = z50_site::count(); //จำนวน record ใน Site_Z50

        $Siteid = DB::table('z50_site') //ดึง SiteID ออกมาเป้น array เพื่อใช้วนลูป
          ->select('Site_ID')
          ->get();
        foreach ($Siteid as $Siteids) 
        {
            $Site_IDF[] = $Siteids->Site_ID;
        }
        // dump($Site_IDF);
        for($Sitei = 1 ; $Sitei < $COUNT ; $Sitei++)
        {
            $Tranfer_statusArray = [];
            $Pcs_statusArray = [];
            $serialnolist = DB::table('z50_site')
                    ->where('Site_ID', '=', $Site_IDF[$Sitei])
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
                    ->select('RT_powerout','Pcs_status','RT_poweraccum','created_at','Zeroexport','SerialNo')
                    ->latest()
                    ->limit(1)
                    ->get();

        //การจัดเตรียมข้อมูล Status

        // Status Description of tranfer system.
     
            // A : Normal work
            // B : Don't receive data over than 10 minute
            // C : Never received
                foreach ($result as $results) 
                {
                    $date = new DateTime;
                    $date->modify('-25 minutes');
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
        //Update to data base

        $updateDetails=array(
            'Tranfer_status' => implode(",",$Tranfer_statusArray),
            'Pcs_status' => implode(",",$Pcs_statusArray),
            'Zeroexport' => implode(",",$ZeroexportArray),
            // 'ZeroexportControll' => implode(",",$ZeroexportControllArray),
        );


        $data = sum_of_z50info::where('Site_ID','=',$Site_IDF[$Sitei])
        ->latest()
        ->LIMIT(1)
        ->update($updateDetails);

    }

    }

public function getlastaccumofallitem()
{
   
    // All SerialNo Item
    $SerialNoitem = DB::table('users')
    ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
    ->latest() 
    ->select('SerialNoitem')
    ->limit(1)  
    ->get();          
    foreach ($SerialNoitem as $SerialNoitems) {
        $SerialNoitem = $SerialNoitems->SerialNoitem;  
    }
    $SerialNoitem = explode(",",$SerialNoitem); 

   // All SerialNo list
   $SerialNolist = DB::table('sum_of_z50info')
    ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
    ->latest() 
    ->select('SerialNolist')
    ->limit(1)  
    ->get();          
    foreach ($SerialNolist  as $SerialNolists) {
        $SerialNolist = $SerialNolists->SerialNolist;  
    }
    $SerialNolist = explode(",",$SerialNolist); 

    $data = DB::table('sum_of_z50info')
    ->where('Site_ID','=', Auth::user()->Site_ID) 
    ->latest() 
    ->select('RT_poweraccum as y')
    ->limit(1)  
    ->get();          

// Loop check
$ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial

$StatusTranferresult = array();
$result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);


    for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
    {
        for($j = 0 ; $j < sizeof($result) ; $j++ )
        {
            if($SerialNolist[$i] == $result[$j] )
            {
                $ArrRef[$i] = 1;
            }
           
        }      
    }


for($l = 0 ; $l < sizeof($data); $l++)
{
    $poweroutarray = explode(",",$data[$l]->y);
    $poweroutsum = 0;
    for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
    {
        if($ArrRef[$y] == 1)
        {
            $poweroutsum += $poweroutarray[$y];
        }

    }
    $data[$l]->y =  number_format($poweroutsum, 2, '.', ' ');
   
}
foreach ($data as $datas) {
   $data = $datas->y;
   
}

   
return $data;

}

public function getstatuszeroexport()
    {   

        header("Content-type: text/json");
        $statusInv = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('Zeroexport')
        ->limit(1)  
        ->get();          
        foreach ($statusInv as $statusInvs) {
            $statusInv = $statusInvs->Zeroexport;
            
        }

        $statusInv = explode(",",$statusInv); 

        // Serial Item
        $SerialNoitem = DB::table('users')
        ->where('id','=', Auth::user()->id) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNoitem')
        ->limit(1)  
        ->get();          
        foreach ($SerialNoitem as $SerialNoitems) {
            $SerialNoitem = $SerialNoitems->SerialNoitem;  
        }
        $SerialNoitem = explode(",",$SerialNoitem); 
        // All SerialNo list
        $SerialNolist = DB::table('sum_of_z50info')
        ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต ต้องใช้ Serial NO
        ->latest() 
        ->select('SerialNolist')
        ->limit(1)  
        ->get();          
        foreach ($SerialNolist  as $SerialNolists) {
            $SerialNolist = $SerialNolists->SerialNolist;  
        }
        $SerialNolist = explode(",",$SerialNolist); 

        // Loop check
        $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
        
        $StatusInvresult = array();
        $result = array_pad ($SerialNoitem,sizeof($SerialNolist) , null);


            for($i = 0 ; $i < sizeof($SerialNolist) ; $i++)
            {
                for($j = 0 ; $j < sizeof($result) ; $j++ )
                {
                    if($SerialNolist[$i] == $result[$j] )
                    {
                        $ArrRef[$i] = 1;
                    }
                   
                }      
            }
        

        for($l = 0 ; $l < sizeof($ArrRef); $l++)
        {
            if($ArrRef[$l] == 1 )
            {
                $StatusInvresult[] = $statusInv[$l];
            }
        }

        return Response::json($StatusInvresult, 200, [], JSON_NUMERIC_CHECK);        

    }

    public function getzeroexportdetail()
    {
        header("Content-type: text/json");
        $serialnoz50 = Input::get('SerialNo');
        $zeroexport = DB::table('z50pcs_info')
        // ->where('Site_ID','=', Auth::user()->Site_ID) //จำลองการกรองในอนาคต
        ->where('SerialNo','=',$serialnoz50) 
        ->latest() 
        ->limit(1)                
        ->get();
    
        foreach ($zeroexport as $zeroexports) {
            $Zeroexport = $zeroexports->Zeroexport;
            
        }
        // $ret = array($a);
        return Response::json($Zeroexport, 200, [], JSON_NUMERIC_CHECK); 
    }

    
}
