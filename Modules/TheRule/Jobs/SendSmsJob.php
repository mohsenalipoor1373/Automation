<?php

namespace Modules\TheRule\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $theRule;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($theRule, $user)
    {
        $this->theRule = $theRule;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sender = "10004346";
        $receptor = "09332286813";
        $message = $this->user['name'] . ' درخواست مساعده ' . $this->theRule['price'] . ' هزار ریالی را دارد';
        $api = new \Kavenegar\KavenegarApi("36336C5571583354676D4749486E6A777666712F614E7A7831796C69625367746F39583757624E533565553D");
        $api->Send($sender, $receptor, $message);
    }
}
