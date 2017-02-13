@extends('layouts.app')
@section('content')
    <input type="text" id="user_ids" name="user_id">
    {{Auth::user()['name']}}
    <input type="button" id="button" name="434343" value="button">
    <script>
        $(function(){
            var button = $("#button").val();
            $("#button").click(function(){
                $.ajax({
                    type: 'POST',
                    url: '/ajax',
                    data: { date : '2015-03-12',user_id:1},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        console.log(data.emails);
//                        alert(data.date);
//                        var html = "<table>";
//                        $.each(data.emails,function(name,value) {
//                            html += "<tr>";
//                            html += "<td>"+value.name+"</td>";
//                            html += "</tr>";
//                        });
//                        html += "</table>";
//                        $("body").append(html);
                    },
//                    error: function(xhr, type){
//                        alert('Ajax error!')
//                    }
                });
            })
        })
    </script>
@endsection