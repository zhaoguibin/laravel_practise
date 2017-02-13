<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;
use App\Events\OrderShipped;



class SendReminderEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    private $key;
    private $value;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key, $value)
    {
        //
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
//        Redis::hset('queue.test', $this->key, $this->value);

//定时发送邮件
        event(new OrderShipped('4444'));

    }
}
