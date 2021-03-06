@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>收件人</th>
                        <th>主题</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($emails as $value)
                    <tr>
                        <td>{{$value->email_to}}</td>
                        <td>{{$value->title}}</td>
                        <td>
                            <button class="btn" type="button">删除</button>
                            <button class="btn" type="button">详情</button>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">
                            {{ $emails->links() }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


