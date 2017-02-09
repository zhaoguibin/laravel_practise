<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
use App\User;
use App\File;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use UUID;
use Illuminate\Support\Facades\Redis;
use Mail;

class UserController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        echo $token = UUID::generate();
        $name = '';
        $echo = array(
            'name'=>'',
            'email'=>''
        );
//        $method=$request->method();
        if($request->isMethod('post')){
            $name = $request->input('name');
            $echo['name'] = $name;
        }

        $file = File::all();

        $users = User::where('name','like',"%{$name}%")->get();

        //返回json数据
//        return response()->json($users);

//        return response()->json(['name' => 'Abigail', 'state' => 'CA'])
//            ->setCallback($request->input('callback'));


        //软删除的数据
        $del_users = User::onlyTrashed()->get();

        //图片软删除的数据
        $del_img = File::onlyTrashed()->get();

        return view('user/user',['user'=>$users,'echo'=>$echo,'del_users'=>$del_users,'file'=>$file,'del_img'=>$del_img]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $add_name = $request->input('add_name');
        $add_email = $request->input('add_email');
        $add_password = $request->input('add_password');

        $user->name = $add_name;
        $user->email = $add_email;
        $user->password = bcrypt($add_password);
        $user->save();
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //彻底删除
    public function destroy($id)
    {

//        User::find("{$id}")->forceDelete();
//        $post = User::withTrashed()
//            ->where('id', $id)
//            ->get();
//        dd($post);
//        $post->forceDelete();
        DB::delete('delete from users where id = ?',["{$id}"]);
        return redirect('/user');
    }

    //图片彻底删除
    public function destroy_img($id)
    {
//        User::find("{$id}")->forceDelete();
//        $post = User::withTrashed()
//            ->where('id', $id)
//            ->get();
//        dd($post);
//        $post->forceDelete();
        $file = File::onlyTrashed('id',"{$id}")->first();
        if(unlink($file->path)){
            DB::delete('delete from files where id = ?',["{$id}"]);
            return redirect('/user');
        }

    }

    //软删除
    public function delete($id){
        User::destroy($id);
        User::where('id',"{$id}")->delete();

        //彻底删除
//        $user = User::find($id);
//        $user->forceDelete();
        return redirect('/user');
    }

    //软删除恢复
    public function restore($id){
        User::where('id',"{$id}")->restore();
        return redirect('/user');
    }

    //图片软删除恢复
    public function restore_img($id){
        File::where('id',"{$id}")->restore();
        return redirect('/user');
    }

    //fileUpload
    public function uploadFile(Request $request){
        if ($request->hasFile('image')) {
            $file_OriginalName = $request->file('image')->getClientOriginalName();
            $file_OriginalType = $request->file('image')->getClientOriginalExtension();


           $Original_name = strstr("{$file_OriginalName}", '.', TRUE);

//            $path = $request->image->store('files', 'public');
//            $path = $request->image->storeAs('files', $file_name);
            //不自动生成文件名，可以使用 storeAs 方法，该方法接收保存路径、文件名和磁盘名作为参数：
            $path = $request->image->storeAs('files', $file_OriginalName, 'public');
            //是否上传成功
            if ($path){
//                dd($path);
//                $file_path = public_path('').$path;
                $file = new File;
                $file->name = $Original_name;
                $file->path = $path;
                $file->suffix = $file_OriginalType;
                $file->save();
                return redirect('/user');
            }
        }
    }

    //图片回收
    public function deleteImage($id){
        File::destroy($id);
        File::where('id',"{$id}")->delete();

        //彻底删除
//        $user = User::find($id);
//        $user->forceDelete();
        return redirect('/user');
    }

    //下载文件
    public function downloadFile($id){
        $file_info = File::where('id',"{$id}")->first();
//        dd($file_info);
/*        print($file_info['name']);
        exit;*/
        return response()->download($file_info['path']);
    }

    public function getCode(){
        $ptoken = Str::random(20);
        $redis = Redis::get('string');
//        $token = UUID::generate(1,"fe80::c4d6:efb2:d535:a760%2");
        $token = UUID::generate();

        $pattern = array(
            "/[[:punct:]]/i", //英文标点符号
            '/[ ]{2,}/'
        );
        $token = preg_replace($pattern, '', $token);

         $array =  array(
            'ptoken'=>$ptoken,
            'redis'=>$redis,
            'token'=>$token
        );

         return json_encode($array);
    }

    public function curlTest(){
        // 1. 初始化
        $ch = curl_init();
        // 2. 设置选项，包括URL
        curl_setopt($ch,CURLOPT_URL,"http://192.168.10.17:8181/getcode");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
        // 3. 执行并获取HTML文档内容
        $output = curl_exec($ch);
//        $info = curl_getinfo($ch);
//        echo ' 获取 '.$info['url'].'耗时'.$info['total_time'].'秒';
        if($output === FALSE ){
            echo "CURL Error:".curl_error($ch);
        }

        echo $output;
        // 4. 释放curl句柄
        curl_close($ch);
    }

    public function without_csrf(Request $request){
        $method = $request->method();
//        if ($request->isMethod('post')) {
            //



        $add_name = $request->input('add_name');
        $request->flashOnly(['add_name']);
        $old_add_name = $request->old('add_name');
            echo $old_add_name;
            echo "\n";
            return $add_name;
//        }

    }

    //ajax提交测试
    public function ajax(Request $request)
    {

//        dd(11);
        $user = new User;

//        $method = $request->method();
        if($request->isMethod('post')){
            $date = $request->input('date');
            if($date){
                $user = new User;
                $emails =  $user->getEmail();
                return response()->json(

                    array(
                        'status'=>1,
                        'emails'=>$emails
                    )
                );
            }else{
                return Redirect::back()->withInput()->withErrors('error');
            }
        }

//        return redirect('/user/ajax');
        return view('user/ajax');

    }




}
