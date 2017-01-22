<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class SsoAuthController extends Controller
{
    public function validateLogin(){
        $token = request("token");
        $redirectURL = request("redirectURL");


//        dd($redirectURL);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://192.168.10.17:7979/login/validateLogin?sys_key=a&sys_psw=12345678&token={$token}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($output,true);
        session()->put("user_id", $data['id']);
        Redis::set("login_{$data['id']}",$data['id']);
        Redis::set("b_ptoken",$data['ptoken']);
        return redirect($redirectURL);
    }
    public function loginOut(){

        $ptoken = Redis::get("b_ptoken");
        $user_id = session()->get('user_id');
        $url = "http://d.com/quit?id={$user_id}&ptoken={$ptoken}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        Redis::del("b_ptoken");
        $msg = curl_exec($ch);
        curl_close($ch);
        session()->forget('user_id');
        $data = json_decode($msg);
        if(in_array("success",$data)){
            return "loginout";
        }else{
            return "false";
        }
    }
    public function clearLoginRedis(){
        $user_id = request('id');
        if(Redis::exists("login_{$user_id}")){
            Redis::del("login_{$user_id}");
//            session()->forget('user_id');
            return "success";
        }
        return "fail";
    }
}
