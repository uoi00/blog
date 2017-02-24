<link rel="stylesheet" href="{{url('/css/dcalendar.picker.css')}}"/>
@extends('layout.index')
@section('title','修改心情')
@section('name',$name)
@section('content')
    <section class="container">
        <div class="content-wrap">
            @if(isset($data))
                <input hidden name="blog" id="blog" value="{{$data->id}}">
                <div class="content">
                    <div class="title">
                        <h3>修改心情</h3>
                    </div>
                    <article class="excerpt excerpt-1" style="">
                        <textarea name="blogs" style="width:100%;max-width:100%;height:200px;visibility:hidden;" placeholder="博文">{!! $data->content !!}</textarea>
                        <a class="btn btn-warning" href="{{url('/mymoots')}}" style="margin: 5px 15px">取消</a>
                        <button class="btn btn-success" id="sub_blog" style="margin: 5px 15px">保存</button>
                    </article>
                </div>
            @else
                <div style="font-size:22px;font-weight: 700; color: darkred;margin: 10px 30%">非法数据</div>
            @endif
        </div>
        <aside class="sidebar">
            <div class="widget widget_hot">
                <h3>操作列表</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{url('/mymoots')}}">心情列表</a></li>
                    <li class="list-group-item"><a href="{{url('/moot/add')}}">添加心情</a></li>
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
    </script>
    <link rel="stylesheet" href="{{url('/kinde/themes/default/default.css')}}" />
    <script charset="utf-8" src="{{url('/kinde/kindeditor-min.js')}}"></script>
    <script charset="utf-8" src="{{url('/kinde/lang/zh_CN.js')}}"></script>
    <script>
        var blogs;
        KindEditor.ready(function(K) {
            blogs = K.create('textarea[name="blogs"]', {
                resizeType : 1,
                allowPreviewEmoticons : false,
                allowImageUpload : false,
                items : [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons']
            });
        });
        $(function () {
            $('#sub_blog').click(function () {
                var bid = $('#blog').val();
                var cont  = blogs.html();
//                var rst = title.match(mod);
                if(cont.length<1){
                    alert('内容不能为空');
                }else {
                    $.post('{{url('/moot/editsave')}}',{_token:'{{csrf_token()}}',bid:bid,cont:cont},function (msg) {
                        if (msg == 'true'){
                            alert('修改成功');
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
