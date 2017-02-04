<?php

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
    Route::post('/add', 'UserController@store');
    Route::get('/destroy/{id}','UserController@destroy');
    Route::get('/delete/{id}','UserController@delete');
    Route::get('/del_img/{id}','UserController@deleteImage');
    Route::get('/restore/{id}','UserController@restore');
    Route::get('/restore_img/{id}','UserController@restore_img');
    Route::get('/destroy_img/{id}','UserController@destroy_img');
    Route::get('/download/{id}','UserController@downloadFile');
    Route::post('/upload','UserController@uploadFile');
});

Route::get('/getcode','UserController@getCode');
Route::get('/curltest','UserController@curlTest');
Route::post('/without_csrf','UserController@without_csrf');
Route::get('/mail/send','MailController@send');
