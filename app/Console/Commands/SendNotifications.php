<?php

namespace App\Console\Commands;

use App\Modules\Users\Models\UserFireBaseToken;
use App\Services\Firebase\SendNotification;
use Illuminate\Console\Command;
use Tocaan\FcmFirebase\Facades\FcmFirebase;

class SendNotifications extends Command
{
    use SendNotification;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send {--data=} {--tokens=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send General Notifications Sent By Admin from Dashboard';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $data;
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->option('data');
        $tokens = $this->option('tokens');
        if(count($data)){
            return FcmFirebase::sendToAllDevices($data);
//            return $this->send($data, $tokens);
        }
        return false;
    }
}
