<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;


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


        $users = User::where('name','like',"%{$name}%")->get();

        return view('user/user',['user'=>$users,'echo'=>$echo]);
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
    public function destroy($id)
    {
        //
    }
}
