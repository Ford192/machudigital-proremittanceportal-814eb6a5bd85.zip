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
        try{

            $ptoken = Ptoken::where('status',1)->orderBy('created_at','desc')->first();
            $ptk = $ptoken->token;

            $httpClient = new Client([
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $ptk,
                ]]);

            $requests = $httpClient->request('POST', "https://shop.digitaltermination.com/api/transactions/cash-pick-ups/call-back/".$this->transaction->transaction_id);
            Log::info("[UpdateTransactionStatus]\t HTTP Response Status Code: ".$requests->getStatusCode());
            Log::info("[UpdateTransactionStatus]\t HTTP Response Body: ".$requests->getBody());

        } catch (ClientException $exception){
            Log::error("[UpdateTransactionStatus]\tClientException... Error: ".$exception->getResponse()->getBody()->getContents());
        }catch (RequestException $exception){
            Log::error("[UpdateTransactionStatus]\tRequestException... Error: ".$exception->getResponse()->getBody()->getContents());
        }catch (\Exception $exception){
            Log::error("[UpdateTransactionStatus]\tException... Error: ".$exception->getMessage());

        }
    }
}
