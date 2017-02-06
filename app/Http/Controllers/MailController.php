<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Storage;
class MailController{
    public function send()
    {
        //模板
        $name = 'FFF';
//        $flag = Mail::send('emails.test',['name'=>$name],function($message){
//            $to = 'zhaoguibinx@163.com';
//            $message ->to($to)->subject('邮件测试');
//        });
//        if($flag){
//            echo '发送邮件成功，请查收！';
//        }else{
//            echo '发送邮件失败，请重试！';
//        }

        //纯文本邮件
//        Mail::raw('你好，我是PHP程序！', function ($message) {
//            $to = 'zhaoguibinx@163.com';
//            $message ->to($to)->subject('纯文本信息邮件测试');
//        });

        //网络图片
//        $image = 'http://b.hiphotos.baidu.com/baike/w%3D268%3Bg%3D0/sign=92e00c9b8f5494ee8722081f15ce87c3/29381f30e924b899c83ff41c6d061d950a7bf697.jpg';
//        $flag = Mail::send('emails.test',['name'=>$name,'imgPath'=>$image],function($message){
//            $to = 'zhaoguibinx@163.com';
//            $message ->to($to)->subject('网络图片测试');
//        });
//
//        if($flag){
//            echo '发送邮件成功，请查收！';
//        }else{
//            echo '发送邮件失败，请重试！';
//        }
        //本地图片
        $image = Storage::get('images/obalu.png');
        $flag = Mail::send('emails.test',['image'=>$image],function($message){
            $to = 'zhaoguibinx@163.com';
            $message->to($to)->subject('[本地图片测试]');
        });
        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }
}
