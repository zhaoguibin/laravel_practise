<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\File;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

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

        //软删除的数据
        $del_users = User::onlyTrashed()->get();

        return view('user/user',['user'=>$users,'echo'=>$echo,'del_users'=>$del_users,'file'=>$file]);
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

    //fileUpload
    public function uploadFile(Request $request){
        if ($request->hasFile('image')) {
            $file_OriginalName = $request->file('image')->getClientOriginalName();
            $file_OriginalType = $request->file('image')->getClientOriginalExtension();

           $Original_name = strstr("{$file_OriginalName}", '.', TRUE);

           $file_name = $Original_name.time().'.'.$file_OriginalType;

           echo $Original_name;
           echo $file_name;
            $path = $path = $request->image->store('files');
//            $path = $request->image->storeAs('files', $file_name);
            //是否上传成功
            if ($path){
//                dd($path);
//                $file_path = public_path('').$path;
                $file = new File;
                $file->name = $Original_name;
                $file->path = $path;
                $file->save();
                return redirect('/user');
            }
        }
    }

}
