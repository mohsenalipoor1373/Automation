<?php

namespace Modules\Leave\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSmsErrorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $ide;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ide, $user)
    {
        $this->ide = $ide;
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
        $message = $this->user['name'] . ' با درخواست مرخصی شما موافقت نگردید.';
        $api = new \Kavenegar\KavenegarApi("36336C5571583354676D4749486E6A777666712F614E7A7831796C69625367746F39583757624E533565553D");
        $api->Send($sender, $receptor, $message);

    }
}
