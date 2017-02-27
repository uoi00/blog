@extends('layout.index')
@section('title','添加相册')
@section('name',$name)
@section('content')
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                @if(isset($data))
                <div class="title">
                    <h3>添加相册</h3>
                </div>
                <article class="excerpt excerpt-1" style="">
                    <input hidden id="phtid" value="{{$data->id}}">
                    <input class="form-control" id="name" name="name" maxlength="38" placeholder="相册名" value="{{$data->name}}"><br>
                    <textarea class="form-control" id="bewrite" name="bewrite" rows="4" placeholder="描述" >{{$data->bewrite}}</textarea>
                    <a class="btn btn-warning" href="{{url('/myphotos')}}" style="margin: 5px 15px">取消</a>
                    <button class="btn btn-success" id="sub_photo" style="margin: 5px 15px">保存</button>
                </article>
                    @else
                    <div style="color: darkred;text-align: center;font-size: 22px";>数据异常</div>
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
    <script>
        $(function () {
            $('#sub_photo').click(function () {
                var id = $('#phtid').val();
                var mod =  /^[\w\u4e00-\u9fa5]{2,40}$/;
                var name = $('#name').val();
                var mark = $('#bewrite').val();
                if (name.match(mod) == null){
                    alert('相册名不能有特殊字符且长度大于1');
                    return;
                }else if(mark.length<1){
                    alert('描述不能为空');
                }else {
                    $.post('{{url('/photo/editsave')}}',{_token:'{{csrf_token()}}',id:id,name:name,bewrite:mark},function (msg) {
                        if (msg == 'true'){
                            alert('添加成功');
                            location.href='{{url('/myphotos')}}';
                        }else {
                            alert('数据异常');
                        }
                    });
                }
            });
        });
    </script>
@endsection
