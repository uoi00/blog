@extends('layout.index')
@section('title','我的相册')
@section('name',$name)
@section('content')
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                <div class="title">
                    <h3>相册列表</h3>
                </div>
                @if(empty($data))
                    <div style="color: #3db9ec;text-align: center;font-size: 22px";>还没有相册哦</div>
                @else
                @foreach($data as $v)
                <div class="photos" id="{{$v->id}}">
                    <div class="photoimg-form">
                        <a href="{{url('/photo/show').'/'.$v->id}}">
                            <img src={{url("/images/photos/$v->first")}} class="photoimg">
                        </a>
                    </div>
                    <div align="center" class="photo-name"><a href="{{url('/photo/show').'/'.$v->id}}">{{$v->name}}</a></div>
                    <div class="photo-opt" align="center">
                        <a class="photo-edit pht-edit" title="修改"><span class="glyphicon glyphicon-edit"></span> 修改</a>&nbsp;&nbsp;
                        <a class="photo-edit pht-del" title="删除"><span class="glyphicon glyphicon-trash"></span> 删除</a>
                    </div>
                </div>
                @endforeach
                    @endif
            </div>
        </div>
        <aside class="sidebar">
            <div class="widget widget_hot">
                <h3>操作列表</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{url('/myphotos')}}">相册列表</a></li>
                    <li class="list-group-item"><a href="{{url('/photo/add')}}">添加相册</a></li>
                </ul>
            </div>
        </aside>
        </aside>
    </section>
    <script type="text/javascript">
        $(function () {
            $('.pht-edit').click(function () {
                var id = $(this).parent().parent().attr('id');
                location.href = '{{url('/photo/edit')}}'+'/'+id;
            });
            $('.pht-del').click(function () {
                if(confirm('该操作将删除相册内所有文件，是否继续：')) {
                    var id = $(this).parent().parent().attr('id');
                    $.post('{{url('/photo/del')}}', {_token: '{{csrf_token()}}', id: id}, function (msg) {
                        if (msg == 'true') {
                            alert('删除成功');
                            location.href = '{{url('/myphotos')}}';
                        } else {
                            alert('删除失败');
                        }
                    });
                }
            });
        });
    </script>
@endsection
