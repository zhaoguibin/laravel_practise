@extends('layouts.app')
        @section('content')
            <table>
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