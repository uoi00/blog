@extends('layout.index')
@section('title','主页')
@section('name',$name)
@section('content')
<section class="container">
	<div class="content-wrap">
		<div class="content">
			<div class="title">
				<h3>好文推荐</h3>
			</div>
			@forelse($data['blog'] as $v)
				<article class="excerpt excerpt-1" style="">
					<header>
						<span class="cat">标  题<i></i></span>
						<h2><a href="{{url("/blog/show/$v->id")}}">{{$v->title}}</a></h2>
					</header>
					<p class="meta">
						<span class="muted"><i class="glyphicon glyphicon-user"></i>&nbsp;{{$v->vname}}</span>&nbsp;
						<time class="time"><i class="glyphicon glyphicon-time"></i>&nbsp;{{date('Y-m-d H:i',$v->time)}}</time>
						<span class="views"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;{{$v->look}}</span>
						<span class="comment"><i class="glyphicon glyphicon-comment"></i>&nbsp;{{$v->comment}}</span>
						<span class="views" title="标签分类"><i class="	glyphicon glyphicon-tags"></i>&nbsp;{{$v->lable}}</span>
					</p>
					<p class="note">{!! $v->content !!}</p>
				</article>
			@empty
				<div align="center" style="margin: 30px auto;font-size: 14px;color: #999">还没有博文哦！</div>
			@endforelse
		</div>
	</div>
	<aside class="sidebar">
		<div class="fixed">
			<div class="widget widget_search">
				<form class="navbar-form" action="{{url('/blog/search')}}" method="post">
					<input name="_token" hidden value="{{csrf_token()}}">
					<div class="input-group">
						<input type="text" id="kwd" name="keyword" class="form-control" size="35" placeholder="请输入关键字" maxlength="15" autocomplete="off">
						<span class="input-group-btn">
		<button class="btn btn-default btn-search" name="search" type="submit">搜索</button>
		</span> </div>
				</form>
			</div>
		</div>
		<div class="widget widget_hot">
			<h3>最近心情</h3>
			<ul>
				@forelse($data['moot'] as $v)
					<article class="excerpt excerpt-1" style="">
						<a href="{{url("/moot/show/$v->id")}}" >
							<span class="muted"><i class="glyphicon glyphicon-user"></i>&nbsp;{{$v->vname}}</span>&nbsp;
							<span class="muted"><i class="glyphicon glyphicon-time"></i>&nbsp;{{date('Y-m-d H:i',$v->time)}}</span>&nbsp;
							<span class="muted"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;{{$v->look}}</span><br>
							<span class="text">{!! $v->content !!}</span>
						</a><hr>
					</article>
				@empty
					<div align="center" style="margin: 30px auto;font-size: 14px;color: #999">还没有心情语录哦！</div>
				@endforelse
			</ul>
		</div>
	</aside>
</section>
	@endsection
