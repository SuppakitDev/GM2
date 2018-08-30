<?php

namespace App\Http\Controllers;
use App\tbPCSInfo;
use App\tbErrorDescript;
use App\tbErrorLog;
use Excel;
use DB;
use Auth;
use PHPExcel_Chart_PlotArea;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Chart_DataSeries;
use PHPExcel_Chart_DataSeriesValues;
use PHPExcel_Style_Fill;
use PHPExcel_Chart_Legend;
use PHPExcel_Chart_Title;
use PHPExcel_Chart;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ExportController extends Controller
{
        public function exportexcelDay()
        {
            $Daily = Input::get('date');
            
            Excel::create('DailyExport('.$Daily.')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')
                    ->where('UserID', '=', Auth::user()->Site_ID)
                    ->get();
                    $Daily = Input::get('date');
                    $info = DB::table('tbPCSInfo')
                    ->whereDate('Time' ,'=', Date($Daily))
                    ->selectRaw(' Time , SUM(Pac) as power,SUM(PConsumption) as energy')
                    ->groupby('Time')
                    ->get();

                    $INV = tbPCSInfo::distinct()
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->groupby('SerialNo')
                    ->orderby('PcsID')
                    ->get();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',1)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    $Daily = Input::get('date');
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexportexcel')
                    ->with('INV', $INV)
                    ->with('Site', $Site)
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            }
            )->export('xls');
        }


        public function exporterrorday()
        {
            $Daily = Input::get('date');
            
            Excel::create('ErrorlogDaily('.$Daily.')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')                    
                    ->where('UserID', '=', Auth::user()->Site_ID)                   
                    ->get();
                    $Daily = Input::get('date');
                    $info = tbErrorLog::with('tbErrorDescripts')
                    ->whereDate('Time' ,'=', Date($Daily))
                    ->selectRaw(' Time ,PcsID,MBxID,SerialNo,ErrorCode')
                    ->get();

                    $INV = tbPCSInfo::distinct()
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->groupby('SerialNo')
                    ->orderby('PcsID')
                    ->get();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',Auth::user()->Site_ID)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    $Daily = Input::get('date');
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexporterrorlog')
                    ->with('INV', $INV)
                    ->with('Site', $Site)   
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            })->export('xls');
        }

        public function exportexcelDaydetail()
        {
            $Daily = Input::get('date');
            
            Excel::create('DailyExport('.$Daily.')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')
                    ->where('UserID', '=', Auth::user()->Site_ID)
                    ->get();
                    $MB = Input::get('MB');
                    $INV = Input::get('INV');
                    
                    $Daily = Input::get('date');
                    $info = DB::table('tbPCSInfo')
                    ->whereDate('Time' ,'=', Date($Daily))
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->selectRaw(' Time , Pac as power,PConsumption as energy')
                    ->get();

                    
                    $INV = DB::table('tbPCSInfo')
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->first();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',Auth::user()->Site_ID)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    $Daily = Input::get('date');
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexportexceldetail')
                    ->with('INV', $INV)
                    ->with('Site', $Site)                    
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            }
            )->export('xls');  
        }

        public function exporterrordaydetail()
        {
            $Daily = Input::get('date');
            $MB = Input::get('MB');
            $INV = Input::get('INV');
            
            Excel::create('ErrorlogDaily('.$Daily.')Masterbox('.$MB .')INV('.$INV .')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')
                    ->where('UserID', '=', Auth::user()->Site_ID)                  
                    ->get();
                    $MB = Input::get('MB');
                    $INV = Input::get('INV');
                    $Daily = Input::get('date');
                    $info = tbErrorLog::with('tbErrorDescripts')
                    ->whereDate('Time' ,'=', Date($Daily))
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->selectRaw(' Time ,PcsID,MBxID,SerialNo,ErrorCode')
                    ->get();

                    $INV = tbPCSInfo::distinct()
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->first();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',1)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    $Daily = Input::get('date');
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexporterrorlogdetail')
                    ->with('INV', $INV)
                    ->with('Site', $Site)       
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            })->export('xls');
        }

        public function exportexcelMonth()
        {
            $month = Input::get('Monthly');
            $year = Input::get('YY');
            
            Excel::create('MonthlyExport('.$month.'-'.$year.')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')
                    ->where('UserID', '=', 1)
                    ->get();
                    $month = Input::get('Monthly');
                    $year = Input::get('YY');
                    $info = DB::table('tbPCSInfo')
                    ->whereMonth('Time' ,'=', $month)
                    ->whereYear('Time' ,'=', $year)
                    ->selectRaw(' Time , SUM(Pac) as power,SUM(PConsumption) as energy')
                    ->groupby('Time')
                    ->get();

                    $INV = tbPCSInfo::distinct()
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->groupby('SerialNo')
                    ->orderby('PcsID')
                    ->get();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',Auth::user()->Site_ID)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    $month = Input::get('Monthly');
                    $year = Input::get('YY');
                    $cell->setValue($month.'-'.$year);
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexportexcel')
                    ->with('INV', $INV)
                    ->with('Site', $Site)                    
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            })->export('xls');
        }

        public function exporterrormonth()
        {
            $month = Input::get('Monthly');
            $year = Input::get('YY');
            
            Excel::create('ErrorlogMonth('.$month.'-'.$year.')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')          
                    ->where('UserID', '=', Auth::user()->Site_ID)                   
                    ->get();
                    $month = Input::get('Monthly');
                    $year = Input::get('YY');
                    $info = tbErrorLog::with('tbErrorDescripts')
                    ->whereMonth('Time' ,'=', $month)
                    ->whereYear('Time' ,'=', $year)
                    ->selectRaw(' Time ,PcsID,MBxID,SerialNo,ErrorCode')
                    ->get();

                    $INV = tbPCSInfo::distinct()
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->groupby('SerialNo')
                    ->orderby('PcsID')
                    ->get();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',Auth::user()->Site_ID)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    $month = Input::get('Monthly');
                    $year = Input::get('YY');
                    $cell->setValue($month.'-'.$year);
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexporterrorlog')
                    ->with('INV', $INV)
                    ->with('Site', $Site) 
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            })->export('xls');
        }

        public function exportexcelMonthdetail()
        {
            $month = Input::get('Monthly');
            $year = Input::get('YY');
            
            Excel::create('MonthlyExport('.$month.'-'.$year.')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')                    
                    ->where('UserID', '=', Auth::user()->Site_ID)                   
                    ->get();
                    $MB = Input::get('MB');
                    $INV = Input::get('INV');
                    $month = Input::get('Monthly');
                    $year = Input::get('YY');
                    $info = DB::table('tbPCSInfo')
                    ->whereMonth('Time' ,'=', $month)
                    ->whereYear('Time' ,'=', $year)
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->selectRaw(' Time , Pac as power,PConsumption as energy')
                    ->get();

                    $INV = DB::table('tbPCSInfo')
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->first();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',Auth::user()->Site_ID)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    $month = Input::get('Monthly');
                    $year = Input::get('YY');
                    $cell->setValue($month.'-'.$year);
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexportexceldetail')
                    ->with('INV', $INV)
                    ->with('Site', $Site)    
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            })->export('xls');
        }

        public function exporterrormonthdetail()
        {
            $month = Input::get('Monthly');
            $year = Input::get('YY');
            $MB = Input::get('MB');
                    $INV = Input::get('INV');
            
            Excel::create('ErrorlogMonth('.$month.'-'.$year.')Masterbox('.$MB .')INV('.$INV .')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')                  
                    ->where('UserID', '=', Auth::user()->Site_ID)                
                    ->get();
                    $MB = Input::get('MB');
                    $INV = Input::get('INV');
                    $month = Input::get('Monthly');
                    $year = Input::get('YY');
                    
                    $info = tbErrorLog::with('tbErrorDescripts')
                    ->whereMonth('Time' ,'=', $month)
                    ->whereYear('Time' ,'=', $year)
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->selectRaw(' Time ,PcsID,MBxID,SerialNo,ErrorCode')
                    ->get();

                    $INV = tbPCSInfo::distinct()
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->first();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',Auth::user()->Site_ID)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    $month = Input::get('Monthly');
                    $year = Input::get('YY');
                    $cell->setValue($month.'-'.$year);
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexporterrorlogdetail')
                    ->with('INV', $INV)
                    ->with('Site', $Site)  
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            })->export('xls');
        }

        public function exportexcelYear()
        {
            
            $year = Input::get('year');
            
            Excel::create('YearlyExport('.$year.')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')                   
                    ->where('UserID', '=', Auth::user()->Site_ID)                    
                    ->get();
                    $year = Input::get('year');
                    $info = DB::table('tbPCSInfo')
                    ->whereYear('Time' ,'=', $year)
                    ->selectRaw(' Time , SUM(Pac) as power,SUM(PConsumption) as energy')
                    ->groupby('Time')
                    ->get();

                    $INV = tbPCSInfo::distinct()
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->groupby('SerialNo')
                    ->orderby('PcsID')
                    ->get();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',Auth::user()->Site_ID)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    
                    $year = Input::get('year');
                    $cell->setValue($year);
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexportexcel')
                    ->with('INV', $INV)
                    ->with('Site', $Site)     
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            })->export('xls');
        }

        public function exporterroryear()
        {
            $year = Input::get('year');
            
            Excel::create('ErrorlogYear('.$year.')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')                   
                    ->where('UserID', '=', Auth::user()->Site_ID)                 
                    ->get();
                    $year = Input::get('year');
                    $info = tbErrorLog::with('tbErrorDescripts')
                    ->whereYear('Time' ,'=', $year)
                    ->selectRaw(' Time ,PcsID,MBxID,SerialNo,ErrorCode')
                    ->get();

                    $INV = tbPCSInfo::distinct()
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->groupby('SerialNo')
                    ->orderby('PcsID')
                    ->get();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',Auth::user()->Site_ID)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    $year = Input::get('year');
                    $cell->setValue($year);
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexporterrorlog')
                    ->with('INV', $INV)
                    ->with('Site', $Site)              
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            })->export('xls');
        }

        public function exportexcelYeardetail()
        {
            
            $year = Input::get('year');
            
            Excel::create('YearlyExport('.$year.')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')                  
                    ->where('UserID', '=', Auth::user()->Site_ID)                  
                    ->get();
                    $MB = Input::get('MB');
                    $INV = Input::get('INV');
                    $year = Input::get('year');
                    $info = DB::table('tbPCSInfo')
                    ->whereYear('Time' ,'=', $year)
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->selectRaw(' Time , Pac as power,PConsumption as energy')
                    ->get();

                    $INV = DB::table('tbPCSInfo')
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->first();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',Auth::user()->Site_ID)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    
                    $year = Input::get('year');
                    $cell->setValue($year);
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexportexceldetail')
                    ->with('INV', $INV)
                    ->with('Site', $Site) 
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            })->export('xls');
        }
   
        public function exporterrorYeardetail()
        {
            $year = Input::get('year');
            $MB = Input::get('MB');
            $INV = Input::get('INV');
            Excel::create('ErrorlogYear('.$year.')', function($excel) 
            {
                $excel->sheet('New sheet', function($sheet) 
                {
                    $Site = DB::table('tbuserid')                
                ->where('UserID', '=', Auth::user()->Site_ID)                 
                ->get();
                    $MB = Input::get('MB');
                    $INV = Input::get('INV');
                    $year = Input::get('year');
                    $info = tbErrorLog::with('tbErrorDescripts')
                    ->whereYear('Time' ,'=', $year)
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->selectRaw(' Time ,PcsID,MBxID,SerialNo,ErrorCode')
                    ->get();

                    $INV = tbPCSInfo::distinct()
                    ->select('MBxID','SerialNo','PcsID','PConsumption')
                    ->where('MBxID','=',$MB)
                    ->where('PcsID','=',$INV)
                    ->first();
                    
                    $MB = tbPCSInfo::distinct()
                    ->where('UserID','=',Auth::user()->Site_ID)
                    ->select('MBxID')
                    ->get();
                    $sheet->mergeCells('A1:E1');
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
                    $year = Input::get('year');
                    $cell->setValue($year);
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
                    $cell->setValue('Site capacity:');
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
                    $cell->setValue('Installation Type:');
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
                    $cell->setValue('Inverter model:');
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
                
                    $sheet->loadView('templateexporterrorlogdetail')
                    ->with('INV', $INV)
                    ->with('Site', $Site)     
                    ->with('info', $info)
                    ->with('MB', $MB);
                });
            })->export('xls');
        }


        public function Summary()
        {
            $excel= Excel::create('TABUCHI ELECTRIC Monthly report', function($excel){
                
            $excel->sheet('Worksheetdata', function($sheet) {
                
                $Monthly = Input::get('Monthly');
                $Y = Input::get('YY');
                $Monthdata = DB::table('total_pconsumption')
                ->where('UserID', '=', Auth::user()->Site_ID)
                ->whereYear('x' ,'=',$Y)         
                ->whereMonth('x' ,'=',$Monthly)
                ->select(DB::Raw('DAY(x) as x , SUM(y) as y'))
                ->groupBy(DB::Raw('UNIX_TIMESTAMP(DATE(x))*1000'))
                ->get();

            $sheet->loadView('summarydata')
                    ->with('Monthdata', $Monthdata);
 
        });
        $excel->sheet('Worksheetchart', function($sheet) {
            $sheet->getStyle('A1:L1')->applyFromArray(array(
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'ccffcc')
                )
            ));
            $sheet->getStyle('A15:L15')->applyFromArray(array(
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'ffd9b3')
                )
            ));
          
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
            $Site = DB::table('tbuserid')
            ->where('UserID', '=', Auth::user()->Site_ID)
            ->get();    
            $sheet->loadView('summaryreport')
            ->with('Site', $Site)
            ->with('totalmonth', $totalmonth)
            ->with('mbxinfo', $mbxinfo);
          
                $sheet->cell('B1', function($cell) 
                {
                    $cell->setValue('LogoSite');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                    
                    $cell->setFontWeight('bold');                        
                    $cell->setFontSize(15);                      
                });

                $objDrawing = new PHPExcel_Worksheet_Drawing;
           
                // $img = "eb76ZxgQ1Q.png";
                $img = Input::get('simg');
                $path = 'M250\\img\\siteimage\\'.$img;
                
            $objDrawing->setPath(public_path($path)); //your image path
            $objDrawing->setCoordinates('B4');
            $objDrawing->setHeight(200);
            $objDrawing->setWidth(200);
            $objDrawing->setWorksheet($sheet);

                $sheet->cell('I1', function($cell) 
                {
                    $cell->setValue('Information');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                    
                    $cell->setFontWeight('bold');                        
                    $cell->setFontSize(15);                      
                });

                $sheet->cell('I3', function($cell) 
                {
                    // $cell->setValue('Report date :');
                    $cell->setFontFamily('Comic Sans MS'); 
                    $cell->setFontWeight('bold');                                                                                                                                                                       
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('I5', function($cell) 
                {
                    $cell->setValue('Site name :');
                    $cell->setFontFamily('Comic Sans MS');   
                    $cell->setFontWeight('bold');                        
                                                                                                                                             
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('I7', function($cell) 
                {
                    // $cell->setValue('Feed-in tariff :');
                    $cell->setFontFamily('Comic Sans MS'); 
                    $cell->setFontWeight('bold');                        
                                                                                                                                               
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('I9', function($cell) 
                {
                    $cell->setValue('Capacity :');
                    $cell->setFontFamily('Comic Sans MS'); 
                    $cell->setFontWeight('bold');                        
                                                                                                                                               
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('I11', function($cell) 
                {
                    $cell->setValue('Installation type :');
                    $cell->setFontWeight('bold');                        
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('I13', function($cell) 
                {
                    $cell->setValue('Inverter model :');
                    $cell->setFontWeight('bold');                        
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });

                $sheet->cell('J3', function($cell) 
                {
                    $cell->setValue(date("Y-m-d"));
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('J5', function($cell) 
                {
                    $cell->setValue('Site name :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('J7', function($cell) 
                {
                    $cell->setValue('Feed-in tariff :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('J9', function($cell) 
                {
                    $cell->setValue('Capacity :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('J11', function($cell) 
                {
                    $cell->setValue('Installation type :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('J13', function($cell) 
                {
                    $cell->setValue('Inverter model :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                
                $sheet->cell('B15', function($cell) 
                {
                    $cell->setValue('Data of Month :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                    
                    $cell->setFontWeight('bold');                        
                    $cell->setFontSize(15);                      
                });

                $sheet->cell('D15', function($cell) 
                {
                    $month = Input::get('Monthly');
                    $cell->setValue(date('F', strtotime('2012-' . $month . '-01')));
                    $cell->setFontFamily('Comic Sans MS');                                                                                                    
                    $cell->setFontWeight('bold');                        
                    $cell->setFontSize(15);                      
                });

                $sheet->cell('B17', function($cell) 
                {
                    $cell->setValue('Monthly energy :');
                    $cell->setFontWeight('bold');                        
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                       
                    $cell->setFontSize(10);                      
                });

                $sheet->cell('B19', function($cell) 
                {
                    $cell->setValue('Return money :');
                    $cell->setFontWeight('bold');                        
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('B21', function($cell) 
                {
                    $cell->setValue('Average temp :');
                    $cell->setFontWeight('bold');                        
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('B23', function($cell) 
                {
                    $cell->setFontWeight('bold');                        
                    $cell->setValue('Irradiant (Max) :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
               

                $sheet->cell('D17', function($cell) 
                {
                    $cell->setValue('Report date :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('D19', function($cell) 
                {
                    $cell->setValue('Site name :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('D21', function($cell) 
                {
                    $cell->setValue('Feed-in tariff :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
                $sheet->cell('D23', function($cell) 
                {
                    $cell->setValue('Capacity :');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                                            
                    $cell->setFontSize(10);                      
                });
               
                $sheet->cell('B26', function($cell) 
                {
                    $cell->setValue('Monthly chart');
                    $cell->setFontFamily('Comic Sans MS');                                                                                                    
                    $cell->setFontWeight('bold');                        
                    $cell->setFontSize(11);                      
                });
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
                            $chart->setTopLeftPosition('B27');
                            $chart->setBottomRightPosition('L42');
            
                            //    Add the chart to the worksheet
                            $sheet->addChart($chart);
                        });
                    });
                    $excel->export('xlsx');

                }

        }
    
