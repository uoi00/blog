<link rel="stylesheet" href="{{url('/css/dcalendar.picker.css')}}"/>
@extends('layout.index')
@section('title','心情语录')
@section('name',$name)
@section('content')
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                <div class="title">
                    <h3>语录列表</h3>
                </div>
                @forelse($data as $k=>$v)
                <article class="excerpt excerpt-1" id="{{$v->id}}" style="">
                    <a href="{{url("/moot/show/$v->id")}}" >
                        <span class="muted"><i class="glyphicon glyphicon-time"></i>&nbsp;{{date('Y-m-d H:i',$v->time)}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="muted"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;{{$v->look}}</span><br>
                        <span class="text">{!! $data[$k]->content !!}</span>
                    </a><hr>
                    <a class="blog-edit mt-edit" title="修改"><span class="glyphicon glyphicon-edit"></span> 修改</a>
                    <a class="blog-edit mt-del" title="删除"><span class="glyphicon glyphicon-trash"></span> 删除</a>
                </article>
                    @empty
                    <div align="center" style="margin: 30px auto;font-size: 14px;color: #999">还没有心情语录哦！</div>
                    @endforelse
                <ul class="pagination">{{$data->links()}}</ul>
            </div>
        </div>
        <aside class="sidebar">

            <div class="widget widget_hot">
                <h3>操作列表</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{url('/mymoots')}}">语录列表</a></li>
                    <li class="list-group-item"><a href="{{url('/moot/add')}}">添加语录</a></li>
                </ul>
                <h3>日历</h3>
                <table id='mycalendar' class='calendar'></table>
            </div>
        </aside>
    </section>
    <script type="text/javascript" src="{{url('/js/dcalendar.picker.js')}}"></script>
    <script type="text/javascript">
        $('#mydatepicker').dcalendarpicker();
        $('#mydatepicker2').dcalendarpicker({
            format:'yyyy-mm-dd'
        });
        $('#mycalendar').dcalendar();
        $(function () {
            $('.mt-edit').click(function () {
                var id = $(this).parent().attr('id');
                location.href = '{{url('/moot/edit')}}/'+id;
            });
            $('.mt-del').click(function () {
                if(confirm("你确定删除该语录么")){
                    var id = $(this).parent().attr('id');
                    $.post('{{url('/moot/del')}}',{id:id,_token:'{{csrf_token()}}'},function (msg) {
                        if (msg == 'true'){
                            alert('删除成功');
                            location.href='{{url('/mymoots')}}';
                        }else {
                            alert('数据异常');
                        }
                    });
                }
            });
        });
    </script>
@endsection
