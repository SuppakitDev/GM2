<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Excel;
use PHPExcel_Style_Alignment;
use DB;
use PHPExcel_Style_Border;
use PHPExcel_Chart_PlotArea;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Chart_DataSeries;
use PHPExcel_Chart_DataSeriesValues;
use PHPExcel_Style_Fill;
use PHPExcel_Chart_Legend;
use PHPExcel_Chart_Title;
use PHPExcel_Chart;
use App\sum_of_z50info;
use App\tbPCSInfo;
use App\z50pcs_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class Z50exportController extends Controller
{
    public function Z50Exportdaydetail()
    {
        $Daily = Input::get('Day');
        $serialnoz50 = Input::get('SerialNo');
        Excel::create('DailyExport('.$Daily.')', function($excel) 
        {
            $excel->sheet('New sheet', function($sheet) 
            {
                $FIT = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('FIT')
                ->get();
                foreach ($FIT as $FITs) {
                    $FIT = $FITs->FIT; 
                }

                $Co2 = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('Co2_Criterion')
                ->get();
                foreach ($Co2 as $Co2s) {
                    $Co2 = $Co2s->Co2_Criterion; 
                }

                $serialnoz50 = Input::get('SerialNo');
                $ZS0Site = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->get();
                $Daily = Input::get('Day');
                $info = z50pcs_info::with('error_codes')
                ->whereDate('created_at' ,'=', Date($Daily))
                ->where('SerialNo','=',$serialnoz50)
                ->select('created_at' ,'Pcs_status' ,'Errorcode' ,'RT_poweraccum' ,'RT_powerout')
                ->get();

                $sheet->mergeCells('A1:G1');
                $sheet->row(1, function ($row) 
            {
                $row->setFontFamily('Comic Sans MS');
                $row->setFontSize(30);
                $row->setAlignment('center');
            });
            $sheet->cell('A2', function($cell) 
                {
                    $cell->setValue('Site Information:');
                    $cell->setFontFamily('Comic Sans MS');                                                                            
                    $cell->setFontWeight('bold');                        
                });
                $sheet->cell('B3', function($cell) 
                {
                    $cell->setValue('Report type:');
                    $cell->setFontFamily('Comic Sans MS');
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C3', function($cell) 
            {
                $cell->setValue('Daily');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B4', function($cell) 
                {
                    $cell->setValue('Report Created:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C4', function($cell) 
            {
                $cell->setValue(date("Y-m-d"));
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

                $sheet->cell('B5', function($cell) 
                {
                    $cell->setValue('Data of:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C5', function($cell) 
            {
                $Daily = Input::get('Day');
                $cell->setValue($Daily);
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B6', function($cell) 
                {
                    $cell->setValue('Site name:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C6', function($cell) 
            {
                $cell->setValue('TTE');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D3', function($cell) 
            {
                $cell->setValue('Company:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E3', function($cell) 
            {
                $cell->setValue('75 kW');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D4', function($cell) 
            {
                $cell->setValue('Inverter model:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E4', function($cell) 
            {
                $cell->setValue('Solar Rooftop');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D5', function($cell) 
            {
                $cell->setValue('Co2_Criterion:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E5', function($cell) 
            {
                $cell->setValue('TPD-T250P6-TH');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D6', function($cell) 
            {
                $cell->setValue('Feed-in tariff:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E6', function($cell) 
            {
                $cell->setValue('10 THB');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('A8', function($cell) 
            {
                $cell->setValue('Equipment information:');
                $cell->setFontFamily('Comic Sans MS');                                                                                                    
                $cell->setFontWeight('bold');                        
            });
            
                $sheet->loadView('Z50templateexportexceldetail')
                ->with('ZS0Site', $ZS0Site)
                ->with('SerialNo',$serialnoz50)                    
                ->with('FIT',$FIT)                    
                ->with('Co2',$Co2)                    
                ->with('info', $info);
                
            });
        }
        )->export('xls');  
    }


    public function Z50Exportmonthdetail()
    {
        $Month = Input::get('Month');
        $Year = Input::get('Year');
        
        $Daily = Input::get('Day');
        $serialnoz50 = Input::get('SerialNo');
        Excel::create('MonthlyExport('.$Month.'/'.$Year.')', function($excel) 
        {
            $Month = Input::get('Month');
            $Year = Input::get('Year');
            $excel->sheet('New sheet', function($sheet) 
            {
                $FIT = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('FIT')
                ->get();
                foreach ($FIT as $FITs) {
                    $FIT = $FITs->FIT; 
                }

                $Co2 = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('Co2_Criterion')
                ->get();
                foreach ($Co2 as $Co2s) {
                    $Co2 = $Co2s->Co2_Criterion; 
                }

                $serialnoz50 = Input::get('SerialNo');
                $ZS0Site = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->get();
                $Month = Input::get('Month');
                $Year = Input::get('Year');
                $info = z50pcs_info::with('error_codes')
                ->whereMonth('created_at' ,'=', $Month)
                ->whereYear('created_at' ,'=', $Year)
                ->where('SerialNo','=',$serialnoz50)
                ->select('created_at' ,'Pcs_status' ,'Errorcode' ,'RT_poweraccum' ,'RT_powerout')
                ->get();

                $sheet->mergeCells('A1:G1');
                $sheet->row(1, function ($row) 
            {
                $row->setFontFamily('Comic Sans MS');
                $row->setFontSize(30);
                $row->setAlignment('center');
            });
            $sheet->cell('A2', function($cell) 
                {
                    $cell->setValue('Site Information:');
                    $cell->setFontFamily('Comic Sans MS');                                                                            
                    $cell->setFontWeight('bold');                        
                });
                $sheet->cell('B3', function($cell) 
                {
                    $cell->setValue('Report type:');
                    $cell->setFontFamily('Comic Sans MS');
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C3', function($cell) 
            {
                $cell->setValue('Monthly');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B4', function($cell) 
                {
                    $cell->setValue('Report Created:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C4', function($cell) 
            {
                $cell->setValue(date("Y-m-d"));
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

                $sheet->cell('B5', function($cell) 
                {
                    $cell->setValue('Data of:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C5', function($cell) 
            {
                $Month = Input::get('Month');
                $Year = Input::get('Year');
                $cell->setValue($Month.'-'.$Year);
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B6', function($cell) 
                {
                    $cell->setValue('Site name:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C6', function($cell) 
            {
                $cell->setValue('TTE');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D3', function($cell) 
            {
                $cell->setValue('Company:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E3', function($cell) 
            {
                $cell->setValue('75 kW');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D4', function($cell) 
            {
                $cell->setValue('Inverter model:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E4', function($cell) 
            {
                $cell->setValue('Solar Rooftop');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D5', function($cell) 
            {
                $cell->setValue('Co2_Criterion:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E5', function($cell) 
            {
                $cell->setValue('TPD-T250P6-TH');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D6', function($cell) 
            {
                $cell->setValue('Feed-in tariff:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E6', function($cell) 
            {
                $cell->setValue('10 THB');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('A8', function($cell) 
            {
                $cell->setValue('Equipment information:');
                $cell->setFontFamily('Comic Sans MS');                                                                                                    
                $cell->setFontWeight('bold');                        
            });
            
                $sheet->loadView('Z50templateexportexceldetail')
                ->with('ZS0Site', $ZS0Site)
                ->with('SerialNo',$serialnoz50)                    
                ->with('FIT',$FIT)                    
                ->with('Co2',$Co2)                    
                ->with('info', $info);
                
            });
        }
        )->export('xls');
    }


    public function Z50Exportyeardetail()
    {
        $serialnoz50 = Input::get('SerialNo');
        
        $Year = Input::get('Year');
        
        $Daily = Input::get('Day');
        $serialnoz50 = Input::get('SerialNo');
        Excel::create('YearlyExport('.$Daily.')', function($excel) 
        {
            $Month = Input::get('Month');
            $Year = Input::get('Year');
            $excel->sheet('New sheet', function($sheet) 
            {
                $FIT = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('FIT')
                ->get();
                foreach ($FIT as $FITs) {
                    $FIT = $FITs->FIT; 
                }

                $Co2 = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('Co2_Criterion')
                ->get();
                foreach ($Co2 as $Co2s) {
                    $Co2 = $Co2s->Co2_Criterion; 
                }

                $serialnoz50 = Input::get('SerialNo');
                $ZS0Site = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->get();
                $Month = Input::get('Month');
                $Year = Input::get('Year');
                $info = z50pcs_info::with('error_codes')
                
                ->whereYear('created_at' ,'=', $Year)
                ->where('SerialNo','=',$serialnoz50)
                ->select('created_at' ,'Pcs_status' ,'Errorcode' ,'RT_poweraccum' ,'RT_powerout')
                ->get();

                $sheet->mergeCells('A1:G1');
                $sheet->row(1, function ($row) 
            {
                $row->setFontFamily('Comic Sans MS');
                $row->setFontSize(30);
                $row->setAlignment('center');
            });
            $sheet->cell('A2', function($cell) 
                {
                    $cell->setValue('Site Information:');
                    $cell->setFontFamily('Comic Sans MS');                                                                            
                    $cell->setFontWeight('bold');                        
                });
                $sheet->cell('B3', function($cell) 
                {
                    $cell->setValue('Report type:');
                    $cell->setFontFamily('Comic Sans MS');
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C3', function($cell) 
            {
                $cell->setValue('Yearly');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B4', function($cell) 
                {
                    $cell->setValue('Report Created:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C4', function($cell) 
            {
                $cell->setValue(date("Y-m-d"));
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

                $sheet->cell('B5', function($cell) 
                {
                    $cell->setValue('Data of:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C5', function($cell) 
            {
                $Year = Input::get('Year');
                $cell->setValue($Year);
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B6', function($cell) 
                {
                    $cell->setValue('Site name:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C6', function($cell) 
            {
                $cell->setValue('TTE');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D3', function($cell) 
            {
                $cell->setValue('Company:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E3', function($cell) 
            {
                $cell->setValue('75 kW');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D4', function($cell) 
            {
                $cell->setValue('Inverter model:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E4', function($cell) 
            {
                $cell->setValue('Solar Rooftop');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D5', function($cell) 
            {
                $cell->setValue('Co2_Criterion:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E5', function($cell) 
            {
                $cell->setValue('TPD-T250P6-TH');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D6', function($cell) 
            {
                $cell->setValue('Feed-in tariff:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E6', function($cell) 
            {
                $cell->setValue('10 THB');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('A8', function($cell) 
            {
                $cell->setValue('Equipment information:');
                $cell->setFontFamily('Comic Sans MS');                                                                                                    
                $cell->setFontWeight('bold');                        
            });
            
                $sheet->loadView('Z50templateexportexceldetail')
                ->with('ZS0Site', $ZS0Site)
                ->with('SerialNo',$serialnoz50)                    
                ->with('FIT',$FIT)                    
                ->with('Co2',$Co2)                    
                ->with('info', $info);
                
            });
        }
        )->export('xls');
    }



    public function Z50ZExportday()
    {
        $Daily = Input::get('ZDay');
        // $serialnoz50 = Input::get('SerialNo');
        Excel::create('DailyExport('.$Daily.')', function($excel) 
        {
            $excel->sheet('New sheet', function($sheet) 
            {
                $FIT = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('FIT')
                ->get();
                foreach ($FIT as $FITs) {
                    $FIT = $FITs->FIT; 
                }

                $Co2 = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('Co2_Criterion')
                ->get();
                foreach ($Co2 as $Co2s) {
                    $Co2 = $Co2s->Co2_Criterion; 
                }

                // $serialnoz50 = Input::get('SerialNo');
                $ZS0Site = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->get();
                
                // แทรกส่วนการดึง SerialNOListและSerialNOItem เพื่อ ใช้ในการกรองข้อมูล
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
                // แทรกส่วนการดึง SerialNOListและSerialNOItem เพื่อ ใช้ในการกรองข้อมูล
                $Daily = Input::get('ZDay');
                $info = DB::table('sum_of_z50info')
                ->whereDate('created_at' ,'=', Date($Daily))
                ->where('Site_ID','=',Auth::user()->Site_ID)  //ของเก่าใช้ Site_ID ในการหรองข้อมูล จากตาราง Sum_of_z50
                ->select('created_at','RT_powerout' ,'RT_poweraccum')
                ->get();

                // แทรกส่วนการวนลูปเช็คตำแหน่งของ Item เพื่อเลือกคำนวณ
                             // Loop check
                            $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
                            
                            // $Poweroutresult = array();
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
                // แทรกส่วนการวนลูปเช็คตำแหน่งของ Item เพื่อเลือกคำนวณ

                // แทรกการวนลูปเพื่อกำหนดค่าใหม่ที่ได้จากการคำนวณ
                            for($l = 0 ; $l < sizeof($info); $l++)
                            {
                                $poweroutarray = explode(",",$info[$l]->RT_powerout);
                                $poweraccumarray = explode(",",$info[$l]->RT_poweraccum);
                                $poweroutsum = 0;
                                $poweraccumsum = 0;
                                for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
                                {
                                    if($ArrRef[$y] == 1)
                                    {
                                        $poweroutsum += $poweroutarray[$y];
                                        $poweraccumsum += $poweraccumarray[$y];
                                    }
                            
                                }
                                $info[$l]->RT_powerout =  number_format($poweroutsum, 2, '.', ' ');
                                $info[$l]->RT_poweraccum =  number_format($poweraccumsum, 2, '.', ' ');
                            
                            }
                            
                // แทรกการวนลูปเพื่อกำหนดค่าใหม่ที่ได้จากการคำนวณ

                
                $sheet->mergeCells('A1:G1');
                $sheet->row(1, function ($row) 
            {
                $row->setFontFamily('Comic Sans MS');
                $row->setFontSize(30);
                $row->setAlignment('center');
            });
            $sheet->cell('A2', function($cell) 
                {
                    $cell->setValue('Site Information:');
                    $cell->setFontFamily('Comic Sans MS');                                                                            
                    $cell->setFontWeight('bold');                        
                });
                $sheet->cell('B3', function($cell) 
                {
                    $cell->setValue('Report type:');
                    $cell->setFontFamily('Comic Sans MS');
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C3', function($cell) 
            {
                $cell->setValue('Daily');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B4', function($cell) 
                {
                    $cell->setValue('Report Created:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C4', function($cell) 
            {
                $cell->setValue(date("Y-m-d"));
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

                $sheet->cell('B5', function($cell) 
                {
                    $cell->setValue('Data of:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C5', function($cell) 
            {
                $Daily = Input::get('ZDay');
                $cell->setValue($Daily);
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B6', function($cell) 
                {
                    $cell->setValue('Site name:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C6', function($cell) 
            {
                $cell->setValue('TTE');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D3', function($cell) 
            {
                $cell->setValue('Company:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E3', function($cell) 
            {
                $cell->setValue('75 kW');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D4', function($cell) 
            {
                $cell->setValue('Inverter model:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E4', function($cell) 
            {
                $cell->setValue('Solar Rooftop');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D5', function($cell) 
            {
                $cell->setValue('Co2_Criterion:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E5', function($cell) 
            {
                $cell->setValue('TPD-T250P6-TH');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D6', function($cell) 
            {
                $cell->setValue('Feed-in tariff:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E6', function($cell) 
            {
                $cell->setValue('10 THB');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('A8', function($cell) 
            {
                $cell->setValue('Equipment information:');
                $cell->setFontFamily('Comic Sans MS');                                                                                                    
                $cell->setFontWeight('bold');                        
            });
            foreach ($ZS0Site as $ZS0Sites) {
                $Z50serial = $ZS0Sites->SerialNolist;
               
            }
            $Z50serialnolist = explode(",",$Z50serial); 

                $sheet->loadView('Z50templateexportexcel')
                ->with('ZS0Site', $ZS0Site)                   
                ->with('FIT',$FIT)
                // ->with('SerialNo',$serialnoz50)                      
                ->with('Co2',$Co2)                    
                ->with('Z50serialnolist',$SerialNoitem)                    
                ->with('info', $info);
                
            });
        }
        )->export('xls');  
    }


    public function Z50ZExportmonth()
    {
        $Site_ID = Auth::user()->Site_ID;

            

        $ZMonth = Input::get('ZMonth');
        $ZYear = Input::get('ZYear');
        Excel::create('MonthlyExport('.$ZMonth.'/'.$ZYear.')', function($excel) 
        {
            
            $excel->sheet('New sheet', function($sheet) 
            {
                $ZMonth = Input::get('ZMonth');
            $ZYear = Input::get('ZYear');
                $FIT = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('FIT')
                ->get();
                foreach ($FIT as $FITs) {
                    $FIT = $FITs->FIT; 
                }

                $Co2 = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('Co2_Criterion')
                ->get();
                foreach ($Co2 as $Co2s) {
                    $Co2 = $Co2s->Co2_Criterion; 
                }

                $serialnoz50 = Input::get('SerialNo');
                $ZS0Site = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->get();
                
                // $Daily = Input::get('ZDay');
                 // แทรกส่วนการดึง SerialNOListและSerialNOItem เพื่อ ใช้ในการกรองข้อมูล
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
                // แทรกส่วนการดึง SerialNOListและSerialNOItem เพื่อ ใช้ในการกรองข้อมูล
                $info = DB::table('sum_of_z50info')
                ->whereMonth('created_at' ,'=', $ZMonth)
                ->whereYear('created_at' ,'=', $ZYear)
                ->where('Site_ID','=',Auth::user()->Site_ID)
                ->select('created_at','RT_powerout' ,'RT_poweraccum')
                ->get();

                // แทรกส่วนการวนลูปเช็คตำแหน่งของ Item เพื่อเลือกคำนวณ
                             // Loop check
                             $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
                            
                             // $Poweroutresult = array();
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
                 // แทรกส่วนการวนลูปเช็คตำแหน่งของ Item เพื่อเลือกคำนวณ
 
                 // แทรกการวนลูปเพื่อกำหนดค่าใหม่ที่ได้จากการคำนวณ
                             for($l = 0 ; $l < sizeof($info); $l++)
                             {
                                 $poweroutarray = explode(",",$info[$l]->RT_powerout);
                                 $poweraccumarray = explode(",",$info[$l]->RT_poweraccum);
                                 $poweroutsum = 0;
                                 $poweraccumsum = 0;
                                 for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
                                 {
                                     if($ArrRef[$y] == 1)
                                     {
                                         $poweroutsum += $poweroutarray[$y];
                                         $poweraccumsum += $poweraccumarray[$y];
                                     }
                             
                                 }
                                 $info[$l]->RT_powerout =  number_format($poweroutsum, 2, '.', ' ');
                                 $info[$l]->RT_poweraccum =  number_format($poweraccumsum, 2, '.', ' ');
                             
                             }
                             
                 // แทรกการวนลูปเพื่อกำหนดค่าใหม่ที่ได้จากการคำนวณ

                $sheet->mergeCells('A1:G1');
                $sheet->row(1, function ($row) 
            {
                $row->setFontFamily('Comic Sans MS');
                $row->setFontSize(30);
                $row->setAlignment('center');
            });
            $sheet->cell('A2', function($cell) 
                {
                    $cell->setValue('Site Information:');
                    $cell->setFontFamily('Comic Sans MS');                                                                            
                    $cell->setFontWeight('bold');                        
                });
                $sheet->cell('B3', function($cell) 
                {
                    $cell->setValue('Report type:');
                    $cell->setFontFamily('Comic Sans MS');
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C3', function($cell) 
            {
                $cell->setValue('Monthly');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B4', function($cell) 
                {
                    $cell->setValue('Report Created:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C4', function($cell) 
            {
                $cell->setValue(date("Y-m-d"));
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

                $sheet->cell('B5', function($cell) 
                {
                    $cell->setValue('Data of:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C5', function($cell) 
            {
                $ZMonth = Input::get('ZMonth');
                $ZYear = Input::get('ZYear');
                $cell->setValue($ZMonth.'-'.$ZYear);
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B6', function($cell) 
                {
                    $cell->setValue('Site name:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C6', function($cell) 
            {
                $cell->setValue('TTE');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D3', function($cell) 
            {
                $cell->setValue('Company:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E3', function($cell) 
            {
                $cell->setValue('75 kW');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D4', function($cell) 
            {
                $cell->setValue('Inverter model:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E4', function($cell) 
            {
                $cell->setValue('Solar Rooftop');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D5', function($cell) 
            {
                $cell->setValue('Co2_Criterion:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E5', function($cell) 
            {
                $cell->setValue('TPD-T250P6-TH');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D6', function($cell) 
            {
                $cell->setValue('Feed-in tariff:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E6', function($cell) 
            {
                $cell->setValue('10 THB');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('A8', function($cell) 
            {
                $cell->setValue('Equipment information:');
                $cell->setFontFamily('Comic Sans MS');                                                                                                    
                $cell->setFontWeight('bold');                        
            });
            foreach ($ZS0Site as $ZS0Sites) {
                $Z50serial = $ZS0Sites->SerialNolist;
               
            }
            $Z50serialnolist = explode(",",$Z50serial); 

                $sheet->loadView('Z50templateexportexcel')
                ->with('ZS0Site', $ZS0Site)                   
                ->with('FIT',$FIT)
                // ->with('SerialNo',$serialnoz50)                      
                ->with('Co2',$Co2)                    
                ->with('Z50serialnolist',$SerialNoitem)    //ต้องเปลี่ยนเป็น Serial Item                  
                ->with('info', $info);
                
            });
        }
        )->export('xls');  
    }


    public function Z50ZExportyear()
    {
        $Site_ID = Auth::user()->Site_ID;
     
        $ZYear = Input::get('ZYear');
        Excel::create('YearlyExport('.$ZYear.')', function($excel) 
        {
            
            $excel->sheet('New sheet', function($sheet) 
            {
                
            $ZYear = Input::get('ZYear');
                $FIT = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('FIT')
                ->get();
                foreach ($FIT as $FITs) {
                    $FIT = $FITs->FIT; 
                }

                $Co2 = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->select('Co2_Criterion')
                ->get();
                foreach ($Co2 as $Co2s) {
                    $Co2 = $Co2s->Co2_Criterion; 
                }

                $serialnoz50 = Input::get('SerialNo');
                $ZS0Site = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->get();
                
                // $Daily = Input::get('ZDay');
                 // แทรกส่วนการดึง SerialNOListและSerialNOItem เพื่อ ใช้ในการกรองข้อมูล
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
                // แทรกส่วนการดึง SerialNOListและSerialNOItem เพื่อ ใช้ในการกรองข้อมูล
                $info = DB::table('sum_of_z50info')
              
                ->whereYear('created_at' ,'=', $ZYear)
                ->where('Site_ID','=',Auth::user()->Site_ID)
                ->select('created_at','RT_powerout' ,'RT_poweraccum')
                ->get();

                 // แทรกส่วนการวนลูปเช็คตำแหน่งของ Item เพื่อเลือกคำนวณ
                             // Loop check
                             $ArrRef = array_fill ( 0, sizeof($SerialNolist), 0 ); // อาร์เรย์อ้างอิงค์เพื่อเก็บตำแหน่งที่มีข้อมูลของ Serial
                            
                             // $Poweroutresult = array();
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
                 // แทรกส่วนการวนลูปเช็คตำแหน่งของ Item เพื่อเลือกคำนวณ
 
                 // แทรกการวนลูปเพื่อกำหนดค่าใหม่ที่ได้จากการคำนวณ
                             for($l = 0 ; $l < sizeof($info); $l++)
                             {
                                 $poweroutarray = explode(",",$info[$l]->RT_powerout);
                                 $poweraccumarray = explode(",",$info[$l]->RT_poweraccum);
                                 $poweroutsum = 0;
                                 $poweraccumsum = 0;
                                 for($y = 0 ; $y < sizeof($ArrRef) ; $y++)
                                 {
                                     if($ArrRef[$y] == 1)
                                     {
                                         $poweroutsum += $poweroutarray[$y];
                                         $poweraccumsum += $poweraccumarray[$y];
                                     }
                             
                                 }
                                 $info[$l]->RT_powerout =  number_format($poweroutsum, 2, '.', ' ');
                                 $info[$l]->RT_poweraccum =  number_format($poweraccumsum, 2, '.', ' ');
                             
                             }
                             
                 // แทรกการวนลูปเพื่อกำหนดค่าใหม่ที่ได้จากการคำนวณ

                $sheet->mergeCells('A1:G1');
                $sheet->row(1, function ($row) 
            {
                $row->setFontFamily('Comic Sans MS');
                $row->setFontSize(30);
                $row->setAlignment('center');
            });
            $sheet->cell('A2', function($cell) 
                {
                    $cell->setValue('Site Information:');
                    $cell->setFontFamily('Comic Sans MS');                                                                            
                    $cell->setFontWeight('bold');                        
                });
                $sheet->cell('B3', function($cell) 
                {
                    $cell->setValue('Report type:');
                    $cell->setFontFamily('Comic Sans MS');
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C3', function($cell) 
            {
                $cell->setValue('Yearly');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B4', function($cell) 
                {
                    $cell->setValue('Report Created:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C4', function($cell) 
            {
                $cell->setValue(date("Y-m-d"));
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

                $sheet->cell('B5', function($cell) 
                {
                    $cell->setValue('Data of:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C5', function($cell) 
            {
                $ZYear = Input::get('ZYear');
                $cell->setValue($ZYear);
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });
                $sheet->cell('B6', function($cell) 
                {
                    $cell->setValue('Site name:');
                    $cell->setFontFamily('Comic Sans MS');                            
                    $cell->setFontWeight('bold');                        
                });
            $sheet->cell('C6', function($cell) 
            {
                $cell->setValue('TTE');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D3', function($cell) 
            {
                $cell->setValue('Company:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E3', function($cell) 
            {
                $cell->setValue('75 kW');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D4', function($cell) 
            {
                $cell->setValue('Inverter model:');
                $cell->setFontFamily('Comic Sans MS');                                                    
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E4', function($cell) 
            {
                $cell->setValue('Solar Rooftop');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D5', function($cell) 
            {
                $cell->setValue('Co2_Criterion:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E5', function($cell) 
            {
                $cell->setValue('TPD-T250P6-TH');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('D6', function($cell) 
            {
                $cell->setValue('Feed-in tariff:');
                $cell->setFontFamily('Comic Sans MS');                                                                            
                $cell->setFontWeight('bold');                        
            });
            $sheet->cell('E6', function($cell) 
            {
                $cell->setValue('10 THB');
                $cell->setFontWeight('solid');                        
                $cell->setAlignment('center');
                
            });

            $sheet->cell('A8', function($cell) 
            {
                $cell->setValue('Equipment information:');
                $cell->setFontFamily('Comic Sans MS');                                                                                                    
                $cell->setFontWeight('bold');                        
            });
            foreach ($ZS0Site as $ZS0Sites) {
                $Z50serial = $ZS0Sites->SerialNolist;
               
            }
            $Z50serialnolist = explode(",",$Z50serial); 

                $sheet->loadView('Z50templateexportexcel')
                ->with('ZS0Site', $ZS0Site)                   
                ->with('FIT',$FIT)
                // ->with('SerialNo',$serialnoz50)                      
                ->with('Co2',$Co2)                    
                ->with('Z50serialnolist',$SerialNoitem)                    
                ->with('info', $info);
                
            });
        }
        )->export('xls');  
    }


    public function MCOTmonthly()
    {
        $excel= Excel::create('TABUCHI MCOT Monthly report', function($excel){
            
        $excel->sheet('Worksheetdata', function($sheet) {
            
            $Monthly = Input::get('Monthly');
            $Y = Input::get('YY');
            $Monthdata = DB::table('sum_of_z50info')
            ->where('Site_ID', '=', Auth::user()->Site_ID)
            ->whereYear('created_at' ,'=',$Y)         
            ->whereMonth('created_at' ,'=',$Monthly)
            ->select(DB::Raw('DAY(created_at) as x , MAX(Poweraccum_Total) - MIN(Poweraccum_Total)  as y'))
            ->groupBy(DB::Raw('UNIX_TIMESTAMP(DATE(created_at))*1000'))
            ->get();

            

        $sheet->loadView('MCOTdata')
                ->with('Monthdata', $Monthdata);

    });
    $excel->sheet('Worksheetchart', function($sheet) {
        $sheet->getStyle('A1')->applyFromArray(array(
            'fill' => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                // 'color' => array('rgb' => 'ccffcc')
            )
        ));
        $sheet->getStyle('G7')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('H7')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('I7')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('J7')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        // $sheet->getStyle('A34')->applyFromArray(array(
        //     'borders' => array(
        //         'allborders' => array(
        //             'style' => PHPExcel_Style_Border::BORDER_THIN,
        //             'color' => array('rgb' => '000000')
        //         )
        //     )
        // ));
        // $sheet->getStyle('C34')->applyFromArray(array(
        //     'borders' => array(
        //         'allborders' => array(
        //             'style' => PHPExcel_Style_Border::BORDER_THIN,
        //             'color' => array('rgb' => '000000')
        //         )
        //     )
        // ));
        // $sheet->getStyle('E34')->applyFromArray(array(
        //     'borders' => array(
        //         'allborders' => array(
        //             'style' => PHPExcel_Style_Border::BORDER_THIN,
        //             'color' => array('rgb' => '000000')
        //         )
        //     )
        // ));
        // $sheet->getStyle('G34')->applyFromArray(array(
        //     'borders' => array(
        //         'allborders' => array(
        //             'style' => PHPExcel_Style_Border::BORDER_THIN,
        //             'color' => array('rgb' => '000000')
        //         )
        //     )
        // ));

        //Row1
        $sheet->getStyle('A36')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C36')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('E36')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('G36')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        //Row1
        
        //Row2
        $sheet->getStyle('A38')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C38')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C38')->getAlignment()->setWrapText(true);
        $sheet->getStyle('E38')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('G38')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        //Row2
        //Row3
        $sheet->getStyle('A40')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C40')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C40')->getAlignment()->setWrapText(true);
        $sheet->getStyle('E40')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('G40')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        //Row3
        //Row4
        $sheet->getStyle('A42')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C42')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('E42')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('G42')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        //Row4
        //Row5
        $sheet->getStyle('A44')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C44')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('E44')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('G44')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        //Row5
          //Row6
          $sheet->getStyle('A46')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C46')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('E46')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('G46')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        //Row6
          //Row7
          $sheet->getStyle('A48')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C48')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('E48')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('G48')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        //Row7
          //Row8
          $sheet->getStyle('A50')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C50')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('E50')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('G50')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        //Row8
                  //Row9
          $sheet->getStyle('A52')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('C52')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('E52')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        $sheet->getStyle('G52')->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        ));
        //Row9
        $sheet->cell('G9', function($cell) 
        {
           
            $cell->setValue("APPROVE");
            $cell->setFontWeight('bold');                                                                                                                        
            $cell->setFontSize(11); 
                      
        });
        $sheet->cell('H9', function($cell) 
        {
           
            $cell->setValue("APPROVE");
            $cell->setFontWeight('bold');                                                                                                                        
            $cell->setFontSize(11); 
                      
        });
        $sheet->cell('I9', function($cell) 
        {
           
            $cell->setValue("CONFIRM");
            $cell->setFontWeight('bold');                                                                                                                        
            $cell->setFontSize(11); 
                      
        });
        $sheet->cell('J9', function($cell) 
        {
           
            $cell->setValue("CONFIRM");
            $cell->setFontWeight('bold');                                                                                                                        
            $cell->setFontSize(11); 
                      
        });
        $sheet->cell('A9', function($cell) 
        {
            $cell->setValue('Co2_Criterion:');
                                                                                    
            $cell->setFontWeight('bold');                        
        });
      
        $month = Input::get('Monthly');
        $year = Input::get('YY');
        $mbxinfo = DB::table('tbmbxinfo')
        ->where('UserID', '=', Auth::user()->Site_ID)
        ->whereMonth('Time' ,'=', $month)
        ->whereYear('Time' ,'=', $year)
        ->select(DB::Raw('AVG(OutsideTemp) as Temp, Max(SRI) as Irr'))
        ->get();
        
        $totalmonth = DB::table('total_pconsumption')
        ->where('UserID', '=', Auth::user()->Site_ID)
        ->whereMonth('x' ,'=', $month)            
        ->whereYear('x' ,'=',$year)         
        ->select(DB::raw('SUM(y) AS y '))                    
        ->groupBy(DB::Raw('MONTH(x)-1'))
        ->get();
        $Site = DB::table('z50_site')
        ->where('Site_ID', '=', Auth::user()->Site_ID)
        ->get(); 

        $PoweraccumTOTAL = DB::table('sum_of_z50info')
        ->where('Site_ID', '=', Auth::user()->Site_ID)
        ->whereYear('created_at' ,'=',$year)         
        ->whereMonth('created_at' ,'=',$month)
        ->select(DB::Raw('MAX(Poweraccum_Total) - MIN(Poweraccum_Total)  as y'))
        ->get();
        foreach ($PoweraccumTOTAL as $PoweraccumTOTALs) {
            $PoweraccumTOTAL = number_format($PoweraccumTOTALs->y,2);
        }
        //Lose data list
        $Losedatalist = DB::table('sum_of_z50info')
        ->where('Site_ID', '=', Auth::user()->Site_ID)
        ->whereYear('created_at' ,'=',$year)         
        ->whereMonth('created_at' ,'=',$month)
        ->where('Linestatus','=',1)
        ->where('Tranfer_status','like','%B%')
        ->where('Powerout_Total','!=',0)
        ->select('Tranfer_status','SerialNolist','Created_at')
        ->get();
   // return($Losedatalist);
   foreach ($Losedatalist as $Losedatalists) 
       {
           $Tranferstatus = explode(",",$Losedatalists->Tranfer_status); 
           $serialnolist = explode(",",$Losedatalists->SerialNolist); 
           $createtime  = $Losedatalists->Created_at;
       

       for($r = 0 ; $r < count($Tranferstatus) ; $r++)
       {
           if($Tranferstatus[$r] == 'B')
           {
               $statusTA[] = $r;
           }
           else
           {
            //    $statusTA =  array();
           }
       }
       // ทำการดึง SerialNo ทีมีปัญหา
       for($SR = 0 ; $SR < count($statusTA) ; $SR++)
       {
           $Srt[] = $serialnolist[$statusTA[$SR]];
       }
       $SROK = implode(",",$Srt);

       // dump($Tranferstatus);
       // dump($statusTA);
       // dump($SROK);

       $Date_time[] = $createtime;
       $SerialNo[] = $SROK;


       unset($Srt);
       $Srt = array();

       unset($statusTA);
       $statusTA = array();
                       
       unset($SROK);
       $SROK = array();
   }
   $ret = array($Date_time, $SerialNo);
   
   if(!isset($Date_time) && !isset($SerialN) )
    {
    $Date_time = array();
    $SerialNo = array();
    }  

//    dump($Date_time);
//    dump($SerialNo);

        $sheet->loadView('MCOTreport')
        ->with('Site', $Site)
        ->with('totalmonth', $totalmonth)
        ->with('PoweraccumTOTAL', $PoweraccumTOTAL)
        ->with('Date_time', $Date_time)
        ->with('SerialNo', $SerialNo)
        // ->with('ret', $ret)
        ->with('mbxinfo', $mbxinfo);
      
    
            $sheet->mergeCells('A1:J2');
            $sheet->getStyle('A1')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
            );
            $sheet->Cells('A1', function($cell) 
            {
                $Site = DB::table('z50_site')
                ->where('Site_ID', '=', Auth::user()->Site_ID)
                ->get(); 
                foreach ($Site as $ZS0Sites) {
                    $SiteName = $ZS0Sites->SiteName;
                }
                $cell->setValue('MCOT Monthly test Report '.$SiteName);                                                                                                    
                $cell->setFontWeight('bold');                        
                $cell->setFontSize(20);                      
            });

            $objDrawing = new PHPExcel_Worksheet_Drawing;
       
        $img = "THAITABUCHI.png";
            // $img = Input::get('simg');
            $path = 'img\\'.$img;
            
        $objDrawing->setPath(public_path($path)); //your image path
        $objDrawing->setCoordinates('G3');
        $objDrawing->setHeight(150);
        $objDrawing->setWidth(250);
        

        $objDrawing->setWorksheet($sheet);

  

            $sheet->cell('I1', function($cell) 
            {
                $cell->setValue('Information');
                $cell->setFontFamily('Comic Sans MS');                                                                                                    
                $cell->setFontWeight('bold');                        
                $cell->setFontSize(15);                      
            });

            $sheet->cell('A4', function($cell) 
            {
                $cell->setFontWeight('bold');                        
                $cell->setFontSize(11);               
            });
            $sheet->cell('A5', function($cell) 
            {
                $cell->setFontWeight('bold');                        
                $cell->setFontSize(11);               
            });
            $sheet->cell('A7', function($cell) 
            {
                $cell->setFontWeight('bold');                        
                $cell->setFontSize(11);               
            });
            $sheet->cell('A8', function($cell) 
            {
                $cell->setFontWeight('bold');                        
                $cell->setFontSize(11);               
            });

            $sheet->mergeCells('A11:B11');
            $sheet->getStyle('A11')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
            );
            $sheet->Cells('A11', function($cell) 
            {
               
                $cell->setValue('Monthly Chart');
                                                                                                                   
                $cell->setFontWeight('bold');                        
                $cell->setFontSize(15);                      
            });

            $sheet->mergeCells('A32:C33');
            $sheet->getStyle('A32')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
            );
            $sheet->Cells('A32', function($cell) 
            {
               
                $cell->setValue('Monthly Alert data lose');
                                                                                                                   
                $cell->setFontWeight('bold');                        
                $cell->setFontSize(15);                      
            });

            $sheet->cell('D11', function($cell) 
            {
                $cell->setValue('Revenue');
                                                                                                            
                $cell->setFontWeight('bold');                        
                $cell->setFontSize(10);                      
            });

            
            $sheet->cell('H11', function($cell) 
            {
                $cell->setValue('CO2 avoided');
                                                                                                            
                $cell->setFontWeight('bold');                        
                $cell->setFontSize(10);                      
            });
            
           
            $sheet->cell('B4', function($cell) 
            {
                $month = Input::get('Monthly');
                $year = Input::get('YY');
                $cell->setValue(": ".$month."-".$year);
                $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                $cell->setFontSize(10); 
                $cell->setAlignment('left');                        
            });
            $sheet->cell('B5', function($cell) 
            {
                $cell->setValue(": ".date("Y-m-d"));
                $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                $cell->setFontSize(10);                         
            });
           
            $sheet->mergeCells('G3:J4');
            $sheet->mergeCells('G7:G8');
            $sheet->mergeCells('H7:H8');
            $sheet->mergeCells('I7:I8');
            $sheet->mergeCells('J7:J8');
            // $sheet->mergeCells('A34:B35');
            // $sheet->getStyle('A34')->getAlignment()->applyFromArray(
            //     array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            //             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            // );
            // $sheet->mergeCells('C34:F35');
            // $sheet->getStyle('C34')->getAlignment()->applyFromArray(
            //     array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            //             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            // );
            // // $sheet->mergeCells('E34:F35');
            // // $sheet->getStyle('E34')->getAlignment()->applyFromArray(
            // //     array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            // //             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            // // );
            // $sheet->mergeCells('G34:J35');
            // $sheet->getStyle('G34')->getAlignment()->applyFromArray(
            //     array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            //             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            // );

            //Row1
            $sheet->mergeCells('A36:B37');
            $sheet->getStyle('A36')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
            $sheet->mergeCells('C36:F37');
            $sheet->getStyle('C36')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
            // $sheet->mergeCells('E36:F37');
            // $sheet->getStyle('E36')->getAlignment()->applyFromArray(
            //     array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            //             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            // );
            $sheet->mergeCells('G36:J37');
            $sheet->getStyle('G36')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
      
            //Row1
            //Row2
            $sheet->mergeCells('A38:B39');
            $sheet->getStyle('A38')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
            $sheet->mergeCells('C38:F39');
            $sheet->getStyle('C38')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
            // $sheet->mergeCells('E38:F39');
            // $sheet->getStyle('E38')->getAlignment()->applyFromArray(
            //     array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            //             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            // );
            $sheet->mergeCells('G38:J39');
            $sheet->getStyle('G38')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
      
            //Row2
          //Row3
          $sheet->mergeCells('A40:B41');
          $sheet->getStyle('A40')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
          $sheet->mergeCells('C40:F41');
          $sheet->getStyle('C40')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
        //   $sheet->mergeCells('E40:F41');
        //   $sheet->getStyle('E40')->getAlignment()->applyFromArray(
        //       array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        //               'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        //   );
          $sheet->mergeCells('G40:J41');
          $sheet->getStyle('G40')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
    
          //Row3
          //Row4
          $sheet->mergeCells('A42:B43');
          $sheet->getStyle('A42')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
          $sheet->mergeCells('C42:F43');
          $sheet->getStyle('C42')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
        //   $sheet->mergeCells('E42:F43');
        //   $sheet->getStyle('E42')->getAlignment()->applyFromArray(
        //       array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        //               'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        //   );
          $sheet->mergeCells('G42:J43');
          $sheet->getStyle('G42')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
    
          //Row4
        //Row5
          $sheet->mergeCells('A44:B45');
          $sheet->getStyle('A44')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
          $sheet->mergeCells('C44:F45');
          $sheet->getStyle('C44')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
        //   $sheet->mergeCells('E44:F45');
        //   $sheet->getStyle('E44')->getAlignment()->applyFromArray(
        //       array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        //               'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        //   );
          $sheet->mergeCells('G44:J45');
          $sheet->getStyle('G44')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
    
          //Row5
                  //Row6
          $sheet->mergeCells('A46:B47');
          $sheet->getStyle('A46')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
          $sheet->mergeCells('C46:F47');
          $sheet->getStyle('C46')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
        //   $sheet->mergeCells('E46:F47');
        //   $sheet->getStyle('E46')->getAlignment()->applyFromArray(
        //       array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        //               'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        //   );
          $sheet->mergeCells('G46:J47');
          $sheet->getStyle('G46')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
    
          //Row6
        //Row7
          $sheet->mergeCells('A48:B49');
          $sheet->getStyle('A48')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
          $sheet->mergeCells('C48:F49');
          $sheet->getStyle('C48')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
        //   $sheet->mergeCells('E48:F49');
        //   $sheet->getStyle('E48')->getAlignment()->applyFromArray(
        //       array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        //               'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        //   );
          $sheet->mergeCells('G48:J49');
          $sheet->getStyle('G48')->getAlignment()->applyFromArray(
              array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
          );
    
          //Row7  
        //Row8
        $sheet->mergeCells('A50:B51');
        $sheet->getStyle('A50')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        );
        $sheet->mergeCells('C50:F51');
        $sheet->getStyle('C50')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        );
        // $sheet->mergeCells('E50:F51');
        // $sheet->getStyle('E50')->getAlignment()->applyFromArray(
        //     array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        //             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        // );
        $sheet->mergeCells('G50:J51');
        $sheet->getStyle('G50')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        );
  
        //Row8   
        //Row9
        $sheet->mergeCells('A52:B53');
        $sheet->getStyle('A52')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        );
        $sheet->mergeCells('C52:F53');
        $sheet->getStyle('C52')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        );
        // $sheet->mergeCells('E52:F53');
        // $sheet->getStyle('E52')->getAlignment()->applyFromArray(
        //     array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        //             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        // );
        $sheet->mergeCells('G52:J53');
        $sheet->getStyle('G52')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
        );
  
        //Row9   
        $dataSeriesLabels = array(
        new PHPExcel_Chart_DataSeriesValues('String', 'Worksheetdata!$B$1', NULL, 1), 
       
        );
        $xAxisTickValues = array(
        new PHPExcel_Chart_DataSeriesValues('String', 'Worksheetdata!$A$2:$A$32', NULL, 31),
        );
        $dataSeriesValues = array(
        new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheetdata!$B$2:$B$32', NULL, 31),
        );
        $series = new PHPExcel_Chart_DataSeries(
        PHPExcel_Chart_DataSeries::TYPE_BARCHART, // plotType
        PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED, // plotGrouping
        range(0, count($dataSeriesValues)-1), // plotOrder
        $dataSeriesLabels, // plotLabel
        $xAxisTickValues, // plotCategory
        $dataSeriesValues // plotValues
        );
        $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COLUMN);
        
                        $plotArea = new PHPExcel_Chart_PlotArea(NULL, array($series));
                        $legend = new PHPExcel_Chart_Legend('Date');
                        $month = Input::get('Monthly');
                $m = date('F', strtotime('2012-' . $month . '-01'));
                        $title = new PHPExcel_Chart_Title('Data of '.$m);
                        $xAxisLabel = new PHPExcel_Chart_Title('Energy (kwh)');
                        $yAxisLabel = new PHPExcel_Chart_Title('Date');
                        //    Create the chart
                        $chart = new PHPExcel_Chart(
                            'chart1',       // name
                            $title,         // title
                            $legend,        // legend
                            $plotArea,      // plotArea
                            true,           // plotVisibleOnly
                            0,              // displayBlanksAs
                            $yAxisLabel  ,   // yAxisLabel
                            $xAxisLabel     // yAxisLabel
                        );
        
                        //    Set the position where the chart should appear in the worksheet
                        $chart->setTopLeftPosition('A13');
                        $chart->setBottomRightPosition('K30');
        
                        //    Add the chart to the worksheet
                        $sheet->addChart($chart);
                    });
                });
                $excel->export('xlsx');

            }

    
}
