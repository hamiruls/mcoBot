<?php

namespace App\Console;

use App\Models\Telegram;
use Illuminate\Support\Facades\Http;
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
        // $schedule->command('inspire')->hourly();
        

        $schedule->call(function(){

       
        $jadual = Telegram::all();

        foreach ($jadual as $jaduals) {
            $str_time = $jaduals->masa;
            sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
            $masa = isset($hours) ? $hours * 3600 + $minutes * 60 + $seconds : $minutes * 60 + $seconds;
            $apiToken = "";
            $jawapan = $jaduals->answer;
            $jawapan = explode(',', $jawapan);
            $jawapan = json_encode($jawapan);
           
           
            $data = ['chat_id' => $jaduals->chatid,   'question' => $jaduals->question,  'options' => $jawapan, 'is_anonymous' => 'False', 'open_period' => $masa];
            Http::post("https://api.telegram.org/bot$apiToken/sendPoll?" . http_build_query($data));
        }
            
        })->weekdays()->timezone('Asia/Kuala_Lumpur')->at('02:11');
        

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
