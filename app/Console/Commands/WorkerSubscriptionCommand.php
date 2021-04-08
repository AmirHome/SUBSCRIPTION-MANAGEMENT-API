<?php

namespace App\Console\Commands;

use App\Helper\Helper;
use App\Jobs\WorkerSubscriptionsJob;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WorkerSubscriptionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:verify_expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $subscriptions = Subscription::whereIn('status', ['started', 'renewed'])
            ####TEST
            ->where('expire_date', '<=', Carbon::now())
            ->cursor();

        foreach ($subscriptions->take(1000) as $subscription) {
            WorkerSubscriptionsJob::dispatch($subscription);
            # Job Task
            ####TEST
        }
        return 0;
    }
}
