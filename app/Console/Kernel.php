<?php

namespace App\Console;

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
        $schedule->call(function (){

            $users = \App\User::where('bank',1)->pluck('id')->toArray();
            $filename = "access-bank-transactions-".\Carbon\Carbon::now()->subDay()->format('Y-m-d').".csv";
            \App\Transaction::whereDate('created_at',\Carbon\Carbon::now()->subDay()->format('Y-m-d'))->whereIn('bank_officer',$users)->chunk(100, function($transactions) use ($filename){
                foreach ($transactions as $transaction){
                    $user = \App\User::find($transaction->bank_officer);
                    if (!empty($user)) {
                        $bank = \App\Bank::find($user->bank_id);
                    }
                    $content = $transaction->id.",".$transaction->created_at.",".$transaction->rec_name.",".$transaction->rec_country.",".$transaction->mobile_account.",".$transaction->transaction_id.",".$transaction->s_name.",".$transaction->extra_id.",".$transaction->rec_currency.",".$transaction->amount.",".(!empty($bank) ? $bank->name: "");
                    \Storage::disk('local')->append($filename,$content);
                }
            });

            \Mail::raw("Daily Transaction Dump", function ($message) use ($filename) {
                $message->to("Harriet.Agyekum@accessbankplc.com")->cc("eugene.afeti@myzeepay.com")->attach(storage_path("app/".$filename))->subject("Access Transactions Dump Transaction Dump - ".\Carbon\Carbon::now()->subDay()->format("Y-m-d"));
            });
        })->dailyAt("06");
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
