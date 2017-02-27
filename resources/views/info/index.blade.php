<link rel="stylesheet" href="{{url('/css/dcalendar.picker.css')}}"/>
@extends('layout.index')
@section('title','我的信息')
@section('name',$name)
@section('content')
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                @if(isset($data))
                <div class="title">
                    <h3>我的信息</h3>
                </div>
                <table class="infos table row">
                    <tr><td colspan="2" class="info-title">&nbsp;&nbsp;&nbsp;&nbsp;基本信息</td></tr>
                    <tr><td class="info-name col-md-4">用户名</td><td class="info-val  col-md-8">{{$data->vname}}</td></tr>
                    <tr><td class="info-name col-md-4">邮箱</td><td class="info-val col-md-8">{{$data->mail}}</td></tr>
                    <tr><td class="info-name col-md-4">加入时间</td><td class="info-val col-md-8">{{date('Y-m-d',$data->time)}}</td></tr>
                    <tr><td colspan="2" class="info-title">&nbsp;&nbsp;&nbsp;&nbsp;个人信息</td></tr>
                    <tr><td class="info-name col-md-4">姓名</td><td class="info-val col-md-8">{{$data->name}}</td></tr>
                    <tr><td class="info-name col-md-4">性别</td><td class="info-val col-md-8">{{$data->sex}}</td></tr>
                    <tr><td class="info-name col-md-4">电话</td><td class="info-val col-md-8">{{$data->tel}}</td></tr>
                    <tr><td class="info-name col-md-4">生日</td><td class="info-val col-md-8">{{$data->birth}}</td></tr>
                    <tr><td class="info-name col-md-4">学历</td><td class="info-val col-md-8">{{$data->education}}</td></tr>
                    <tr><td class="info-name col-md-4">职业</td><td class="info-val col-md-8">{{$data->job}}</td></tr>
                    <tr><td class="info-name col-md-4">住址</td><td class="info-val col-md-8">{{$data->addr}}</td></tr>
                    <tr><td rowspan="2" class="info-name col-md-4">简介</td><td rowspan="2" class="info-val col-md-8">{{$data->bewrite}}</td></tr>
                    <tr></tr>
                </table>
                    @else
                <div style="color: darkred;font-size: 22px;text-align: center;">数据异常</div>
                @endif
            </div>
        </div>
        <aside class="sidebar">

            <div class="widget widget_hot">
                <h3>操作列表</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{url('/myinfo')}}">我的信息</a></li>
                    <li class="list-group-item"><a href="{{url('/info/edit')}}">修改信息</a></li>
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
@endsection
