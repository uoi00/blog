<link rel="stylesheet" href="{{url('/css/dcalendar.picker.css')}}"/>
@extends('layout.index')
@section('title','心情语录')
@section('name',$name)
@section('content')
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                <div class="title">
                    <h3>创建语录</h3>
                </div>
                <article class="excerpt excerpt-1" style="">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <textarea name="moots" style="width:100%;max-width:100%;height:200px;visibility:hidden;" placeholder="心情"></textarea>
                    <a class="btn btn-warning" href="{{url('/mymoots')}}" style="margin: 5px 15px">取消</a>
                    <button class="btn btn-success" id="sub_moot" style="margin: 5px 15px">发表</button>
                </article>
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
    </script>
    <link rel="stylesheet" href="{{url('/kinde/themes/default/default.css')}}" />
    <script charset="utf-8" src="{{url('/kinde/kindeditor-min.js')}}"></script>
    <script charset="utf-8" src="{{url('/kinde/lang/zh_CN.js')}}"></script>
    <script>
        var moots;
        KindEditor.ready(function(K) {
            moots = K.create('textarea[name="moots"]', {
                resizeType : 1,
                allowPreviewEmoticons : false,
                allowImageUpload : false,
                items : [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons']
            });
        });
        $('#sub_moot').click(function () {
            var mootss = moots.html();
            if (mootss){
                $.post('{{url('/moot/addsave')}}',{moots:mootss,_token:'{{csrf_token()}}'},function(msg){
                    if (msg == 'true'){
                        alert('添加成功');
                        location.href='{{url('/mymoots')}}';
                    }else {
                        alert('信息错误');
                    }
                });
            }else {
                alert('内容不能为空哦');
            }
        });
    </script>
@endsection
