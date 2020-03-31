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
            \Storage::disk('local')->put($filename, "Remit Portal ID, Zeepay Transaction ID, Receiver Name, ID Type, MSISDN, Receiver ID Number,Receiver DOB, Sender Name, Sender Country, Amount, Purpose, Teller, Branch\n");
            $transactionsQuery = \App\Transaction::whereDate('created_at', \Carbon\Carbon::now()->subDay()->format('Y-m-d'))->whereIn('bank_officer', $users);
            $transactionsQuery->chunk(100, function($transactions) use ($filename){
                foreach ($transactions as $transaction){
                    $user = \App\User::find($transaction->bank_officer);
                    if (!empty($user)) {
                        $bank = \App\Bank::find($user->bank);
                    }
                    $content =
                        $transaction->id.",".$transaction->transaction_id.",".$transaction->rec_name.",".$transaction->rec_id_type.",".$transaction->mobile_account.",".$transaction->rec_id_number.",".$transaction->rec_dob.","
                        .$transaction->s_name.",".$transaction->s_location.",".$transaction->amount.",".$transaction->purpose."," .$user->name.",".$user->bank_branch
                        ."," .$transaction->created_at ."," .$transaction->updated_at.",".(!empty($bank) ? $bank->name : "None");
                    \Storage::disk('local')->append($filename,$content);
                }
            });



            if ($transactionsQuery->count() >  0){
                \Mail::raw("Daily Transaction Dump - Cash Pick Up", function ($message) use ($filename) {
                    $message->to("Harriet.Agyekum@accessbankplc.com")->to("Joseph.Tekpor@accessbankplc.com")->to("Wilhermina.Maclean@accessbankplc.com")->to("FRANCHISEBANKING@ghana.accessbankplc.com")->cc("nic@myzeepay.com")->cc("tpu@myzeepay.com")->cc("eugene.afeti@myzeepay.com")->attach(storage_path("app/".$filename))->subject("Access Transactions - ".\Carbon\Carbon::now()->subDay()->format("Y-m-d"));
                });
            }

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
