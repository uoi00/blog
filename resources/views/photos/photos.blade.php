@extends('layout.index')
@section('title','我的相册')
@section('name',$name)
@section('content')
    <section class="container">
        <div class="content-wrap">

        </div>
        <aside class="sidebar">
            <div class="widget widget_hot">
                <h3>操作列表</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{url('')}}">相册列表</a></li>
                    <li class="list-group-item"><a href="{{url('')}}">添加相册</a></li>
                </ul>
            </div>
        </aside>
        </aside>
    </section>
@endsection
