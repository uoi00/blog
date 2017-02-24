<link rel="stylesheet" href="{{url('/css/dcalendar.picker.css')}}"/>
@extends('layout.index')
@section('title','我的博文')
@section('name',$name)
@section('content')
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                <div class="title">
                    <h3>博文列表</h3>
                </div>
                @forelse($data as $v)
                <article id="{{$v->id}}" class="excerpt excerpt-1" style="">
                    <header>
                        <span class="cat">标  题<i></i></span>
                        <h2><a href="{{url("/blog/show/$v->id")}}">{{$v->title}}</a></h2>
                    </header>
                    <p class="meta">
                        <time class="time"><i class="glyphicon glyphicon-time"></i>&nbsp;{{date('Y-m-d H:i',$v->time)}}</time>
                        <span class="views"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;{{$v->look}}</span>
                        <span class="comment"><i class="glyphicon glyphicon-comment"></i>&nbsp;{{$v->comment}}</span>
                        <span class="views" title="标签分类"><i class="	glyphicon glyphicon-tags"></i>&nbsp;{{$v->lable}}</span>
                    </p>
                    <p class="note">{!! $v->content !!}</p>
                    <hr>
                    <a class="blog-edit bg-edit" title="修改"><span class="glyphicon glyphicon-edit"></span> 修改</a>
                    <a class="blog-edit bg-del" title="删除"><span class="glyphicon glyphicon-trash"></span> 删除</a>
                </article>
                @empty
                    <div align="center" style="margin: 30px auto;font-size: 14px;color: #999">还没有博文哦！</div>
                @endforelse
                <ul class="pagination">{{$data->links()}}</ul>
            </div>
        </div>
        <aside class="sidebar">

            <div class="widget widget_hot">
                <h3>操作列表</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{url('/myblogs')}}">博文列表</a></li>
                    <li class="list-group-item"><a href="{{url('/blog/add')}}">添加博文</a></li>
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
            $('.bg-edit').click(function () {
                var id = $(this).parent().attr('id');
                location.href = '{{url('/blog/edit/')}}/'+id;
            });
            $('.bg-del').click(function () {
                if(confirm("你确定删除该语录么")){
                    var id = $(this).parent().attr('id');
                    $.post('{{url('/moot/del')}}',{id:id,_token:'{{csrf_token()}}'},function (msg) {
                        if (msg == 'true'){
                            alert('删除成功');
                            location.href='{{url('/myblogs')}}';
                        }else {
                            alert('数据异常');
                        }
                    });
                }
            });
        });
    </script>
@endsection
