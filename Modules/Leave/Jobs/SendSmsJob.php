<?php

namespace Modules\Leave\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $leave;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($leave, $user)
    {
        $this->leave = $leave;
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
        if ($this->leave['history'] == null) {
            $message = $this->user['name'] . ' درخواست مرخصی از تاریخ ' . $this->leave['from'] .
                'تا تاریخ' . $this->leave['todate'] . ' را دارد.';
        } else
            $message = $this->user['name'] . ' درخواست مرخصی در تاریخ' . $this->leave['history'] .
                'از ساعت' . $this->leave['FromHour'] . ' تا ساعت' . $this->leave['until'] . ' را دارد.';
        $api = new \Kavenegar\KavenegarApi("36336C5571583354676D4749486E6A777666712F614E7A7831796C69625367746F39583757624E533565553D");
        $api->Send($sender, $receptor, $message);
    }
}
