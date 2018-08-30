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
use Eycel;
use DateTime;
use DB;
use Auth;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class Z50PeriodGraphController extends Controller
{

public function getMonthlydataZ50()
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

        $month = Input::get('Monthly');
        $year = Input::get('YY');
        $data = DB::table('sum_of_z50info')
        ->where('Site_ID','=',Auth::user()->Site_ID)
        ->whereYear('created_at' , $year)
        ->whereMonth('created_at' , $month)
        
        // ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 as x , RT_powerout as y')
        ->selectRaw('created_at as x , 	RT_poweraccum as y')
        // ->orderBY('x')
        ->get();

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

        $day1 = [];
        $day2 = [];
        $day3 = [];
        $day4 = [];
        $day5 = [];
        $day6 = [];
        $day7 = [];
        $day8 = [];
        $day9 = [];
        $day10 = [];
        $day11 = [];
        $day12 = [];
        $day13 = [];
        $day14 = [];
        $day15 = [];
        $day16 = [];
        $day17 = [];
        $day18 = [];
        $day19 = [];
        $day20 = [];
        $day21 = [];
        $day22 = [];
        $day23 = [];
        $day24 = [];
        $day25 = [];
        $day26 = [];
        $day27 = [];
        $day28 = [];
        $day29 = [];
        $day30 = [];
        $day31 = [];

        foreach ($data  as $datas) 
        {
            $datetime = new DateTime($datas->x);
            // $interval = $datetime2->diff($datetime2);
            switch ($datetime->format('d')) {
      
                case 1:
                
                      array_push($day1,$datas->y); 
                      break;
                case 2:
                      array_push($day2,$datas->y);
                      break;
                case 3:
                      array_push($day3,$datas->y);
                      break;
                case 4:
                      array_push($day4,$datas->y);
                      break;
                case 5:
                      array_push($day5,$datas->y);
                      break;
                case 6:
                      array_push($day6,$datas->y);
                      break;
                case 7:
                      array_push($day7,$datas->y);
                      break;
                case 8:
                      array_push($day8,$datas->y);
                      break;
                case 9:
                      array_push($day9,$datas->y);
                      break;
                case 10:
                      array_push($day10,$datas->y);
                      break;
                case 11:
                      array_push($day11,$datas->y);
                      break;
                case 12:
                      array_push($day12,$datas->y);
                      break;
                case 13:
                      array_push($day13,$datas->y);
                      break;
                case 14:
                      array_push($day14,$datas->y);
                      break;
                case 15:
                      array_push($day15,$datas->y);
                      break;
                case 16:
                      array_push($day16,$datas->y);
                      break;
                case 17:
                      array_push($day17,$datas->y);
                      break;
                case 18:
                      array_push($day18,$datas->y);
                      break;
                case 19:
                      array_push($day19,$datas->y);
                      break;
                case 20:
                      array_push($day20,$datas->y);
                      break;
                case 21:
                      array_push($day21,$datas->y);
                      break;
                case 22:
                      array_push($day22,$datas->y);
                      break;
                case 23:
                      array_push($day23,$datas->y);
                      break;
                case 24:
                      array_push($day24,$datas->y);
                      break;
                case 25:
                      array_push($day25,$datas->y); 
                      break;
                case 26:
                      array_push($day26,$datas->y); 
                      break;
                case 27:
                      array_push($day27,$datas->y); 
                      break;
                case 28:
                      array_push($day28,$datas->y); 
                      break;
                case 29:
                      array_push($day29,$datas->y); 
                      break;
                case 30:
                      array_push($day30,$datas->y); 
                      break;
                case 31:
                      array_push($day31,$datas->y); 
                      break;
             }
   
                
        }

        if(empty($day1))
        {
            array_push($day1,0);
        }
        if(empty($day2))
        {
            array_push($day2,0);
        }
        if(empty($day3))
        {
            array_push($day3,0);
        }
        if(empty($day4))
        {
            array_push($day4,0);
        }
        if(empty($day5))
        {
            array_push($day5,0);
        }
        if(empty($day6))
        {
            array_push($day6,0);
        }
        if(empty($day7))
        {
            array_push($day7,0);
        }
        if(empty($day8))
        {
            array_push($day8,0);
        }
        if(empty($day9))
        {
            array_push($day9,0);
        }
        if(empty($day10))
        {
            array_push($day10,0);
        }
        if(empty($day11))
        {
            array_push($day11,0);
        }
        if(empty($day12))
        {
            array_push($day12,0);
        } 
        if(empty($day13))
        {
            array_push($day13,0);
        }
        if(empty($day14))
        {
            array_push($day14,0);
        }
        if(empty($day15))
        {
            array_push($day15,0);
        }
        if(empty($day16))
        {
            array_push($day16,0);
        }
        if(empty($day17))
        {
            array_push($day17,0);
        }
        if(empty($day18))
        {
            array_push($day18,0);
        }
        if(empty($day19))
        {
            array_push($day19,0);
        }
        if(empty($day20))
        {
            array_push($day20,0);
        }
        if(empty($day21))
        {
            array_push($day21,0);
        }
        if(empty($day22))
        {
            array_push($day22,0);
        }
        if(empty($day23))
        {
            array_push($day23,0);
        }
        if(empty($day24))
        {
            array_push($day24,0);
        }
        
        if(empty($day25))
        {
            array_push($day25,0);
        }
        if(empty($day26))
        {
            array_push($day26,0);
        }
        if(empty($day27))
        {
            array_push($day27,0);
        }
        if(empty($day28))
        {
            array_push($day28,0);
        }
        if(empty($day29))
        {
            array_push($day29,0);
        }
        if(empty($day30))
        {
            array_push($day30,0);
        }
        if(empty($day31))
        {
            array_push($day31,0);
        }

        
        $result1 = max($day1) - min($day1);   
        $result2 = max($day2) - min($day2);   $result3 = max($day3) - min($day3);   $result4 = max($day4) - min($day4);
        $result5 = max($day5) - min($day5);   $result6 = max($day6) - min($day6);   $result7 = max($day7) - min($day7);   $result8 = max($day8) - min($day8);
        $result9 = max($day9) - min($day9);   $result10 = max($day10) - min($day10);   $result11 = max($day11) - min($day11);   $result12 = max($day12) - min($day12);
        $result13 = max($day13) - min($day13);   $result14 = max($day14) - min($day14);   $result15 = max($day15) - min($day15);   $result16 = max($day16) - min($day16);
        $result17 = max($day17) - min($day17);   $result18 = max($day18) - min($day18);   $result19 = max($day19) - min($day19);   $result20 = max($day20) - min($day20);
        $result21 = max($day21) - min($day21);   $result22 = max($day22) - min($day22);   $result23 = max($day23) - min($day23);   $result24 = max($day24) - min($day24);
        $result25 = max($day25) - min($day25);   $result26 = max($day26) - min($day26);   $result27 = max($day27) - min($day27);   $result28 = max($day28) - min($day28);
        $result29 = max($day29) - min($day29);   $result30 = max($day30) - min($day30);   $result31 = max($day31) - min($day31);  
        

        $Finalout = array(number_format($result1, 2, '.', ''),number_format($result2, 2, '.', ''),number_format($result3, 2, '.', ''),number_format($result4, 2, '.', ''),number_format($result5, 2, '.', ''),number_format($result6, 2, '.', ''),number_format($result7, 2, '.', ''),
                   number_format($result8, 2, '.', ''),number_format($result9, 2, '.', ''),number_format($result10, 2, '.', ''),number_format($result11, 2, '.', ''),number_format($result12, 2, '.', ''),number_format($result13, 2, '.', ''),number_format($result14, 2, '.', ''),
                      number_format($result15, 2, '.', ''),number_format($result16, 2, '.', ''),number_format($result17, 2, '.', ''),number_format($result18, 2, '.', ''),number_format($result19, 2, '.', ''),number_format($result20, 2, '.', ''),number_format($result21, 2, '.', ''),
                      number_format($result22, 2, '.', ''),number_format($result23, 2, '.', ''),number_format($result24, 2, '.', ''),number_format($result25, 2, '.', ''),number_format($result26, 2, '.', ''),number_format($result27, 2, '.', ''),number_format($result28, 2, '.', ''),
                      number_format($result29, 2, '.', ''),number_format($result30, 2, '.', ''),number_format($result31, 2, '.', ''));

        return Response::json($Finalout, 200, [], JSON_NUMERIC_CHECK);
 
    } 

public function getYearlydataZ50()

    {
        header("Content-type: text/json");
        // All SerialNo Item
        $Monthresult = [];
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
        $year = Input::get('Yearly');
    for($m = 1 ; $m <= 12 ; $m++){
    // START LOOP FOR MONTH RESULT
       
       $data = DB::table('sum_of_z50info')
       ->where('Site_ID','=',Auth::user()->Site_ID)
       ->whereYear('created_at' , $year)
        ->whereMonth('created_at' , $m)
 
       
       // ->selectRaw('(UNIX_TIMESTAMP(created_at))*1000 as x , RT_powerout as y')
       ->selectRaw('created_at as x , 	RT_poweraccum as y')
       // ->orderBY('x')
       ->get();

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

       $day1 = [];
       $day2 = [];
       $day3 = [];
       $day4 = [];
       $day5 = [];
       $day6 = [];
       $day7 = [];
       $day8 = [];
       $day9 = [];
       $day10 = [];
       $day11 = [];
       $day12 = [];
       $day13 = [];
       $day14 = [];
       $day15 = [];
       $day16 = [];
       $day17 = [];
       $day18 = [];
       $day19 = [];
       $day20 = [];
       $day21 = [];
       $day22 = [];
       $day23 = [];
       $day24 = [];
       $day25 = [];
       $day26 = [];
       $day27 = [];
       $day28 = [];
       $day29 = [];
       $day30 = [];
       $day31 = [];

       foreach ($data  as $datas) 
       {
           $datetime = new DateTime($datas->x);
           // $interval = $datetime2->diff($datetime2);
           switch ($datetime->format('d')) {
     
               case 1:
               
                     array_push($day1,$datas->y); 
                     break;
               case 2:
                     array_push($day2,$datas->y);
                     break;
               case 3:
                     array_push($day3,$datas->y);
                     break;
               case 4:
                     array_push($day4,$datas->y);
                     break;
               case 5:
                     array_push($day5,$datas->y);
                     break;
               case 6:
                     array_push($day6,$datas->y);
                     break;
               case 7:
                     array_push($day7,$datas->y);
                     break;
               case 8:
                     array_push($day8,$datas->y);
                     break;
               case 9:
                     array_push($day9,$datas->y);
                     break;
               case 10:
                     array_push($day10,$datas->y);
                     break;
               case 11:
                     array_push($day11,$datas->y);
                     break;
               case 12:
                     array_push($day12,$datas->y);
                     break;
               case 13:
                     array_push($day13,$datas->y);
                     break;
               case 14:
                     array_push($day14,$datas->y);
                     break;
               case 15:
                     array_push($day15,$datas->y);
                     break;
               case 16:
                     array_push($day16,$datas->y);
                     break;
               case 17:
                     array_push($day17,$datas->y);
                     break;
               case 18:
                     array_push($day18,$datas->y);
                     break;
               case 19:
                     array_push($day19,$datas->y);
                     break;
               case 20:
                     array_push($day20,$datas->y);
                     break;
               case 21:
                     array_push($day21,$datas->y);
                     break;
               case 22:
                     array_push($day22,$datas->y);
                     break;
               case 23:
                     array_push($day23,$datas->y);
                     break;
               case 24:
                     array_push($day24,$datas->y);
                     break;
               case 25:
                     array_push($day25,$datas->y); 
                     break;
               case 26:
                     array_push($day26,$datas->y); 
                     break;
               case 27:
                     array_push($day27,$datas->y); 
                     break;
               case 28:
                     array_push($day28,$datas->y); 
                     break;
               case 29:
                     array_push($day29,$datas->y); 
                     break;
               case 30:
                     array_push($day30,$datas->y); 
                     break;
               case 31:
                     array_push($day31,$datas->y); 
                     break;
            }
  
               
       }

       if(empty($day1))
       {
           array_push($day1,0);
       }
       if(empty($day2))
       {
           array_push($day2,0);
       }
       if(empty($day3))
       {
           array_push($day3,0);
       }
       if(empty($day4))
       {
           array_push($day4,0);
       }
       if(empty($day5))
       {
           array_push($day5,0);
       }
       if(empty($day6))
       {
           array_push($day6,0);
       }
       if(empty($day7))
       {
           array_push($day7,0);
       }
       if(empty($day8))
       {
           array_push($day8,0);
       }
       if(empty($day9))
       {
           array_push($day9,0);
       }
       if(empty($day10))
       {
           array_push($day10,0);
       }
       if(empty($day11))
       {
           array_push($day11,0);
       }
       if(empty($day12))
       {
           array_push($day12,0);
       } 
       if(empty($day13))
       {
           array_push($day13,0);
       }
       if(empty($day14))
       {
           array_push($day14,0);
       }
       if(empty($day15))
       {
           array_push($day15,0);
       }
       if(empty($day16))
       {
           array_push($day16,0);
       }
       if(empty($day17))
       {
           array_push($day17,0);
       }
       if(empty($day18))
       {
           array_push($day18,0);
       }
       if(empty($day19))
       {
           array_push($day19,0);
       }
       if(empty($day20))
       {
           array_push($day20,0);
       }
       if(empty($day21))
       {
           array_push($day21,0);
       }
       if(empty($day22))
       {
           array_push($day22,0);
       }
       if(empty($day23))
       {
           array_push($day23,0);
       }
       if(empty($day24))
       {
           array_push($day24,0);
       }
       
       if(empty($day25))
       {
           array_push($day25,0);
       }
       if(empty($day26))
       {
           array_push($day26,0);
       }
       if(empty($day27))
       {
           array_push($day27,0);
       }
       if(empty($day28))
       {
           array_push($day28,0);
       }
       if(empty($day29))
       {
           array_push($day29,0);
       }
       if(empty($day30))
       {
           array_push($day30,0);
       }
       if(empty($day31))
       {
           array_push($day31,0);
       }

       
       $result1 = max($day1) - min($day1);   
       $result2 = max($day2) - min($day2);   $result3 = max($day3) - min($day3);   $result4 = max($day4) - min($day4);
       $result5 = max($day5) - min($day5);   $result6 = max($day6) - min($day6);   $result7 = max($day7) - min($day7);   $result8 = max($day8) - min($day8);
       $result9 = max($day9) - min($day9);   $result10 = max($day10) - min($day10);   $result11 = max($day11) - min($day11);   $result12 = max($day12) - min($day12);
       $result13 = max($day13) - min($day13);   $result14 = max($day14) - min($day14);   $result15 = max($day15) - min($day15);   $result16 = max($day16) - min($day16);
       $result17 = max($day17) - min($day17);   $result18 = max($day18) - min($day18);   $result19 = max($day19) - min($day19);   $result20 = max($day20) - min($day20);
       $result21 = max($day21) - min($day21);   $result22 = max($day22) - min($day22);   $result23 = max($day23) - min($day23);   $result24 = max($day24) - min($day24);
       $result25 = max($day25) - min($day25);   $result26 = max($day26) - min($day26);   $result27 = max($day27) - min($day27);   $result28 = max($day28) - min($day28);
       $result29 = max($day29) - min($day29);   $result30 = max($day30) - min($day30);   $result31 = max($day31) - min($day31);  
       

       $Finalout = array(number_format($result1, 2, '.', ''),number_format($result2, 2, '.', ''),number_format($result3, 2, '.', ''),number_format($result4, 2, '.', ''),number_format($result5, 2, '.', ''),number_format($result6, 2, '.', ''),number_format($result7, 2, '.', ''),
                  number_format($result8, 2, '.', ''),number_format($result9, 2, '.', ''),number_format($result10, 2, '.', ''),number_format($result11, 2, '.', ''),number_format($result12, 2, '.', ''),number_format($result13, 2, '.', ''),number_format($result14, 2, '.', ''),
                     number_format($result15, 2, '.', ''),number_format($result16, 2, '.', ''),number_format($result17, 2, '.', ''),number_format($result18, 2, '.', ''),number_format($result19, 2, '.', ''),number_format($result20, 2, '.', ''),number_format($result21, 2, '.', ''),
                     number_format($result22, 2, '.', ''),number_format($result23, 2, '.', ''),number_format($result24, 2, '.', ''),number_format($result25, 2, '.', ''),number_format($result26, 2, '.', ''),number_format($result27, 2, '.', ''),number_format($result28, 2, '.', ''),
                     number_format($result29, 2, '.', ''),number_format($result30, 2, '.', ''),number_format($result31, 2, '.', ''));
    //    STOP LOOP FOR MONTH RESULT
    //    array_push($month,$Finalout);
    
       $temp = array_sum($Finalout);
       $Total = number_format($temp, 2, '.', '');
       array_push($Monthresult,$Total);
    }
       

       return Response::json($Monthresult, 200, [], JSON_NUMERIC_CHECK);
    }   

  
}
