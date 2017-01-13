@extends('layouts.app')
        @section('content')
            <table>
                <tr><td>添加</td></tr>
                <form action="{{ url('/add') }}" method="post">
                    {{ csrf_field() }}
                    <tr>
                        <td><input type="text" name="add_name">姓名</td>
                        <td><input type="text" name="add_email">邮箱</td>
                        <td><input type="password" name="add_password">密码</td>
                        <td><input type="submit" value="添加"/></td>
                    </tr>
                </form>
                <tr><td>搜索</td></tr>
                <form action="{{ url('/user') }}" method="post">
                    {{ csrf_field() }}
                    <tr>
                        <td><input type="text" name="name" value="{{$echo['name']}}">姓名</td>
                        <td><input type="email" name="email" value="{{$echo['email']}}">邮箱</td>
                        <td><input class="search" type="submit" value="搜索"/></td>
                    </tr>
                </form>

                <tr>
                    <td>姓名</td>
                    <td style="padding-left: 10px">邮箱</td>
                </tr>
                @foreach($user as $value)
                    <tr>
                        <td class="name">{{$value->name}}</td>
                        <td style="padding-left: 10px">{{$value->email}}</td>
                        <td style="padding-left: 10px"><a href="/delete/{{$value->id}}">回收站</a></td>
                    </tr>
                @endforeach
            </table>

            <table>
                <tr>
                    <td>回收站</td>
                </tr>

                <tr>
                    <td>姓名</td>
                    <td style="padding-left: 10px">邮箱</td>
                </tr>
                @foreach($del_users as $value)
                    <tr>
                        <td class="name">{{$value->name}}</td>
                        <td style="padding-left: 10px">{{$value->email}}</td>
                        <td style="padding-left: 10px"><a href="/destroy/{{$value->id}}">彻底删除</a></td>
                        <td style="padding-left: 10px"><a href="/restore/{{$value->id}}">恢复</a></td>
                    </tr>
                @endforeach


            </table>

            <table>
                <form action="{{ url('/upload') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="image">
                    <input type="submit" value="upload">
                </form>
            </table>

            <table>
                <tr>
                    <td>名称</td>
                    <td>图片</td>
                </tr>
                @foreach($file as $img)
                <tr>
                    <td>{{$img->name}}</td>
                    <td><img src="{{$img->path}}"></td>
                </tr>
                @endforeach
            </table>
            <script>
                //    $('.search').click(function(){
                //            alert(432131);
                //    });
            </script>
        @endsection
{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<meta charset="utf-8">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">--}}
    {{--<title>Examples</title>--}}
    {{--<meta name="description" content="">--}}
    {{--<meta name="keywords" content="">--}}
    {{--<link href="" rel="stylesheet">--}}
    {{--<script type="text/javascript" src="{{ URL::asset('/js/jquery-3.1.1.min.js') }}"></script>--}}

    {{--<script type="text/javascript" src="{{ URL::asset('//code.jquery.com/jquery-3.1.1.min.js') }}"></script>--}}
{{--</head>--}}
{{--<body>--}}

{{--</body>--}}
{{--</html>--}}