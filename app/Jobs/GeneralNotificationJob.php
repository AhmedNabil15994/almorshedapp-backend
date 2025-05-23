<?php

namespace App\Jobs;

use App\Modules\Users\Models\UserFireBaseToken;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;

class GeneralNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tokens = (new UserFireBaseToken())->where('updated_at','>=', Carbon::now()->subMonths(6))->distinct('device_token')->pluck('device_token')->chunk(1000);
        foreach($tokens as $tokensArr){
            Artisan::call("notifications:send", ['--data' => $this->data, '--tokens'=> reset($tokensArr) ]);
        }
    }
}
