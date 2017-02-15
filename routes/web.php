<?php
use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//创建图片
Route::get('/png', function () {
    ob_clean();
    ob_start();
    $im = @imagecreate(200, 50) or die("创建图像资源失败");
    imagecolorallocate($im, 255, 255, 255);
    $text_color = imagecolorallocate($im, 0, 0, 255);
    imagestring($im, 5, 0, 0, "Hello world!", $text_color);
    imagepng($im);
    imagedestroy($im);
    $content = ob_get_clean();
    return response($content, 200, [
        'Content-Type' => 'image/png',
    ]);
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/user', 'UserController@index');
    Route::post('/user', 'UserController@index');
    Route::get('/ajax', 'UserController@ajax');
    Route::post('/ajax', 'UserController@ajax');
    Route::post('/add', 'UserController@store');
    Route::get('/destroy/{id}','UserController@destroy');
    Route::get('/delete/{id}','UserController@delete');
    Route::get('/del_img/{id}','UserController@deleteImage');
    Route::get('/restore/{id}','UserController@restore');
    Route::get('/restore_img/{id}','UserController@restore_img');
    Route::get('/destroy_img/{id}','UserController@destroy_img');
    Route::get('/download/{id}','UserController@downloadFile');
    Route::post('/upload','UserController@uploadFile');
    //emails
    Route::get('/email','EmailsController@index');
});

Route::get('/getcode','UserController@getCode');
Route::get('/curltest','UserController@curlTest');
Route::post('/without_csrf','UserController@without_csrf');
Route::get('/mail/send','MailController@send');

//中间件测试

Route::group(['middleware'=>['middleware_test']],function(){
    Route::get('/middleware','MiddlewareTestController@index');
});

Route::post('/middleware','MiddlewareTestController@index');

Route::any('captcha-test', function()
{
    if (Request::getMethod() == 'POST')
    {
        $rules = ['captcha' => 'required|captcha'];
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

    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});

//Route::get('/captcha/test','CaptchaController@index');
//Route::get('/captcha/mews','CaptchaController@mews');

Route::group(['middleware' => ['auth']], function () {

});

Route::group(['middleware' => ['is_admin']], function(){
    Route::get('/cap','CaptchaController@index');
});



Route::post('/cpt','CaptchaController@getInfo');

