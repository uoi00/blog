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
                        <h3>修改信息</h3>
                    </div>
                    <table class="infos table row">
                        <tr><td colspan="2" class="info-title">&nbsp;&nbsp;&nbsp;&nbsp;个人信息</td></tr>
                        <tr><td class="info-name col-md-4">姓名</td><td class="info-val col-md-8"><input class="form-control" id="name" value="{{$data->name}}"></td></tr>
                        <tr><td class="info-name col-md-4">性别</td><td class="info-val col-md-8"><select class="selectpicker" id="sex"> <option value="保密"  @if($data->sex=='保密') active @endif >保密</option><option value="男"  @if($data->sex=='男') active @endif >男</option><option value="女"  @if($data->sex=='女') active @endif >女</option></select></td></tr>
                        <tr><td class="info-name col-md-4">电话</td><td class="info-val col-md-8"><input type="tel" class="form-control" id="tel" value="{{$data->tel}}"></td></tr>
                        <tr><td class="info-name col-md-4">生日</td><td class="info-val col-md-8"><input class="form-control" id="birth" value="{{$data->birth}}"></td></tr>
                        <tr><td class="info-name col-md-4">学历</td><td class="info-val col-md-8"><select class="selectpicker" id="education"><option value="保密"  @if($data->sex=='保密') active @endif >保密</option><option value="初中及以下"  @if($data->sex=='初中及以下') active @endif >初中及以下</option><option value="中专技校"  @if($data->sex=='中专技校') active @endif >中专技校</option><option value="高中"  @if($data->sex=='高中') active @endif >高中</option><option value="大专"  @if($data->sex=='大专') active @endif >大专</option><option value="硕士及以上"  @if($data->sex=='硕士及以上') active @endif >硕士及以上</option></select></td></tr>
                        <tr><td class="info-name col-md-4">职业</td><td class="info-val col-md-8"><input class="form-control" id="job" value="{{$data->job}}"></td></tr>
                        <tr><td class="info-name col-md-4">住址</td><td class="info-val col-md-8"><input class="form-control" id="addr" value="{{$data->addr}}"></td></tr>
                        <tr><td rowspan="2" class="info-name col-md-4">简介</td><td rowspan="2" class="info-val col-md-8"><textarea class="form-control" id="bewrite">{{$data->bewrite}}</textarea></td></tr>
                        <tr></tr>
                        <tr><td colspan="2" align="center"><a href="{{url('/myinfo')}}" class="btn btn-danger">取消</a><button class="btn btn-info" style="margin-left: 30px;" id="infosub">修改</button></td></tr>
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
        $('#mycalendar').dcalendar();

        $('#infosub').click(function () {
            var name = $('#name').val();
            var sex = $('#sex').val();
            var tel = $('#tel').val();
            var birth = $('#birth').val();
            var education = $('#education').val();
            var addr = $('#addr').val();
            var job = $('#job').val();
            var bewrite = $('#bewrite').val();
            if (name.length>50){
                $('#name').focus;
                alert('姓名格式错误');
                return;
            }
            if (birth.length>20){
                $('#birth').focus;
                alert('生日格式错误');
                return;
            }
            if (job.length>30){
                $('#job').focus;
                alert('职业格式错误');
                return;
            }
            if (addr.length>50){
                $('#addr').focus;
                alert('住址格式错误');
                return;
            }
            if (bewrite.length>299){
                $('#bewrite').focus;
                alert('描述内容为300以内');
                return;
            }else {
                $.post('{{url('/info/save')}}',{_token:'{{csrf_token()}}',name:name,sex:sex,tel:tel,birth:birth,job:job,addr:addr,bewrite:bewrite,education:education},function (msg) {
                    if (msg=='true'){
                        alert('修改成功');
                        location.href='{{url('/myinfo')}}';
                    }else {
                        alert('修改失败');
                    }
                });
            }
        });
    </script>
@endsection
