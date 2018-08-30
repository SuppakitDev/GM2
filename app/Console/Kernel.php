<?php

namespace App\Console;
use Illuminate\Support\Facades\DB;
// use DB;
use App\product_list;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
         // the call method
    $schedule->call(function () {
        $product = new product_list();
        $product->P_Name = "TESTP";
        $product->P_Model = "TESTM";
        $product->Comment = "from sleep10";
        $product->save();
      })->everyMinute();
      
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

    
}
