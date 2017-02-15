<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;

//引用对应的命名空间use Session;
use Captcha;

class CaptchaController extends Controller {
    /**
     * 测试页面
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index() {

//        dd(11);
        // $mews = Captcha::src('inverse');, compact('mews')
        return view('captcha.index');
    }
    /*创建验证码*/
//    public function mews() {
//        return Captcha::create('default');
//    }

public function getInfo(Request $request){

    if ($request->method() == 'POST')
    {
        //$rules = ['post传过来的输入的验证码的值' => 'required|captcha'];
        //$rules = ['cpt' => 'required|captcha'];

        $rules = ['cpt' => 'required|captcha'];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        }
        else
        {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }
    exit;
}
}
