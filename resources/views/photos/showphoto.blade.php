<link rel="stylesheet"  href="{{url('/css/zoom.css')}}" media="all" />
<link rel="stylesheet" href="{{url('/css/ssi-uploader.min.css')}}"/>
@extends('layout.index')
@section('title','我的相册')
@section('name',$name)
@section('content')
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                <div class="title">
                    <h3>相册详情</h3>
                </div>
                @if(!isset($data))
                    <div style="color: darkred;text-align: center;font-size: 22px";>数据异常</div>
                @else
                    <table class="table table-striped" id="{{$data->id}}">
                        <tr><td align="center">相册名</td><td>{{$data->name}}</td></tr>
                        <tr><td align="center">描  述</td><td>{{$data->bewrite}}</td></tr>
                        <tr><td align="center">创建时间</td><td>{{date('Y-m-d',$data->time)}}</td></tr>
                    </table>
                    <div>
                        <button class="btn btn-info" id="pic-add" data-toggle="collapse"
                                data-target="#demo" title="添加成功后刷新页面即可！">添加相片</button>
                    </div>
                    <div id="demo" class="collapse on">
                        <input type="file" multiple id="ssi-upload"/>
                    </div>
                    @if(empty($pics->toArray()))
                        <div style="color: #3db9ec;text-align: center;font-size: 22px";>还没有相片哦</div>
                        @else
                        @foreach($pics as $v)
                            <div class="photos gallery" id="{{$v->id}}">
                                <div class="photoimg-form" align="center">
                                    <a href="{{url("/images/photos/$v->name")}}"><img src={{url("/images/photos/$v->name")}} class="photoimg"> </a>
                                </div>
                                <div class="photo-opt" align="center">
                                    <a class="photo-edit pic-fm" title="设为封面"><span class="glyphicon glyphicon-edit"></span> 设为封面</a>&nbsp;&nbsp;
                                    <a class="photo-edit pic-del" title="删除"><span class="glyphicon glyphicon-trash"></span> 删除</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
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
    </section>
    <script src="{{url('/js/zoom.min.js')}}"></script>
    <script src="{{url('/js/ssi-uploader.min.js')}}"></script>
    <script type="text/javascript">
        $('#ssi-upload').ssi_uploader({url:location.href,maxFileSize:6,allowed:['jpg','gif','png']});
        $(function () {
            $('.pic-fm').click(function () {
                var id = $(this).parent().parent().attr('id');
                var pid = $('table').attr('id');
                $.post('{{url('/pic/face')}}',{_token:'{{csrf_token()}}',id:id,pid:pid},function (msg) {
                    if (msg == 'true'){
                        alert('设置成功');
                    }else {
                        alert('设置失败');
                    }
                });
            });
            $('.pic-del').click(function () {
                var id = $(this).parent().parent().attr('id');
                $.post('{{url('/pic/del')}}',{_token:'{{csrf_token()}}',id:id},function (msg) {
                    if (msg == 'true'){
                        alert('删除成功');
                        location.reload();
                    }else {
                        alert('删除失败');
                    }
                });
            });
        });
    </script>
@endsection
