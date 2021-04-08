<?php

namespace App\Jobs;

use App\Helper\Helper;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WorkerSubscriptionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subscription;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $response =  Helper::mockGoogleVerification($this->subscription->receipt);

        if($response->successful()){
            if ($response->json('status') && !$response->json('rate_limits_error')){
                # renew subscription

                $data = ['device_id' => $this->subscription->device_id,
                    'receipt' => $this->subscription->receipt,
                    'status' => 'renewed',
                    'expire_date' => $response->json('expire_date'),
                ];

                $data = app('App\Http\Controllers\Api\V1\SubscriptionController')->validateData($data);
                $subscription = app('App\Http\Controllers\Api\V1\SubscriptionController')->updateOrCreateSubscription($data);

                ####TEST
                //dump($subscription->toArray());
            }
        }
    }
}
