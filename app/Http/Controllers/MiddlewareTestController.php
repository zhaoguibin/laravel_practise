<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiddlewareTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
//        dd('老人家，雷猴啊！');
//        return response()
//            ->json(['name' => 'Abigail', 'state' => 'CA'])
//            ->withCallback($request->input('callback'));

//        return response()->json([
//            'name' => 'Abigail',
//            'state' => 'CA'
//        ]);

//        echo strcmp("Hello","Hello");
//        echo "<br>";
//        echo strcmp("Hello","hELLo");
//        die();

        $this->validate($request, [
            'age' => 'required',
            'sex' => 'required',
        ]);

        $data = $request->session()->all();

        var_dump($data);


        echo $request->age;

        die();

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
        //
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
