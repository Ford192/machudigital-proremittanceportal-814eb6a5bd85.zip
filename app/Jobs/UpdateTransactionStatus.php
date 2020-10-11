<?php

namespace App\Jobs;

use App\PostmanToken as PToken;
use App\Transaction;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class UpdateTransactionStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $transaction;

    /**
     * Create a new job instance.
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("[UpdateTransactionStatus][".$this->transaction->id."]\t Called...");
        try{

            $user = \App\User::find($this->transaction->bank_officer);

            if (empty($user)){
                Log::info("[UpdateTransactionStatus][".$this->transaction->id."]\t User is empty exiting...");
                return;
            }

            $ptoken = Ptoken::where('status',1)->orderBy('created_at','desc')->first();

            Log::info("[UpdateTransactionStatus][".$this->transaction->id."]\t Token Object...",(!empty($ptoken) ? $ptoken->toArray() : []));
            $ptk = $ptoken->token;

            Log::info("[UpdateTransactionStatus][".$this->transaction->id."]\t final extracted token...".$ptk);

            $httpClient = new Client([
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $ptk,
                ]]);

            $url = "https://shop.digitaltermination.com/api/transactions/cash-pick-ups/call-back/".$this->transaction->transaction_id;

            Log::info("[UpdateTransactionStatus][".$this->transaction->id."]\t final URL...".$url);

            $httpResponse = $httpClient->post($url,[
                'headers' => ["Authorization" => $ptk],
                'json' => [
                    "remarks" => "funds paid out successfully",
                    "identification" => [
                        "type" => strtoupper($this->transaction->rec_id_type),
                        "number" => $this->transaction->rec_id_number,
                    ],
                    "branch" => $user->bank_branch,
                    "payer_code" => null,
                    "completed_on" => \Carbon\Carbon::now()->format("Y-m-d\TH:i:s\Z"),
                    "action" => "complete",
                    "employee" => $user->name,
                    "hostname" => "remit-portal",
                ]
            ]);
//            $requests = $httpClient->request('POST', "https://shop.digitaltermination.$httpResponse/api/transactions/cash-pick-ups/call-back/".$this->transaction->transaction_id);
            Log::info("[UpdateTransactionStatus]\t HTTP Response Status Code: ".$httpResponse->getStatusCode());
            Log::info("[UpdateTransactionStatus]\t HTTP Response Body: ".$httpResponse->getBody());

        } catch (ClientException $exception){
            Log::error("[UpdateTransactionStatus]\tClientException... Error: ".$exception->getResponse()->getBody()->getContents());
        }catch (RequestException $exception){
            Log::error("[UpdateTransactionStatus]\tRequestException... Error: ".$exception->getResponse()->getBody()->getContents());
        }catch (\Exception $exception){
            Log::error("[UpdateTransactionStatus]\tException... Error: ".$exception->getMessage());

        }
    }
}
