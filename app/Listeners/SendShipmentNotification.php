<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Queue\InteractsWithQueue;
//加入队列
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;


class SendShipmentNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        // 使用 $event->order 来访问 order ...
        $aa = $event->emails;


        $ccc = $aa[0]->name;

        $name = 'FFF';
        $flag = Mail::send('emails.test',['name'=>$name],function($message){
            $to = 'zhaoguibinx@163.com';
            $message ->to($to)->subject('邮件测试');
        });
    }
}
