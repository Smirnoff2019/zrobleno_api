<?php

namespace App\Console\Commands;

use App\Events\Payments\NewPaymentEvent;
use App\Models\Account\Account;
use App\Models\Payment\Payment;
use App\Models\Status\PaymentStatus;
use App\Models\Status\Status;
use App\Models\User\User;
use App\Traits\Logs\Loger;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckPaymentStatus extends Command
{
    use Loger;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check statuses of payments';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $status = Status::where('slug', 'inprocessing')->orWhere('slug', 'pending')->where('group', 'payments')->pluck('id');

        $this->info($status);

        Payment::whereIn('status_id', $status)->latest()->get()
            ->each(function ($item, $key){

                $merchangeAccount = 'main_zrobleno_com_ua';
                $dataString = $merchangeAccount.";".$item->order_reference;

                $encryptKey = 'b4e6d63112a7f44df282a2921dc08ab4ab14b18f';
                $merchangeSignature = hash_hmac("md5", $dataString, $encryptKey);


                $response = Http::post('https://api.wayforpay.com/api', [
                    'transactionType' => 'CHECK_STATUS',
                    'merchantAccount' => $merchangeAccount,
                    'orderReference' => $item->order_reference,
                    'merchantSignature' => $merchangeSignature,
                    'apiVersion' => 1
                ]);

                $response = $response->json();
                
                $this->log('CheckPaymentStatus $response', $response);

                $statusString = strtolower($response['transactionStatus'] ?? '');
                $this->info($statusString);

                $status = PaymentStatus::slug($statusString)->first();
                if($status) {
                    if( $status->slug === 'approved') {
                        $account = Account::find($item->account_id);
                        $newBalance = $account->balance + $item->value;
                        $account->update(['balance' => $newBalance]);

                        $user = User::find($account->user_id)->first();
                    }

                    $item->update(['status_id' => $status->id]);

//                    $this->info(json_encode($response));
                }

            });
    }
}
