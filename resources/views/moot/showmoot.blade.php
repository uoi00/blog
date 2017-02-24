<link rel="stylesheet" href="{{url('/css/dcalendar.picker.css')}}"/>
@extends('layout.index')
@section('title','心情语录')
@section('name',$name)
@section('content')
    <section class="container">
        <div class="content-wrap">
            @if(isset($data))
            <div class="content">
                <header class="article-header" id="{{$data->id}}">
                    <h3>留言详情</h3>
                    <div class="article-meta">
                        <span class="item article-meta-comment" data-toggle="tooltip" data-placement="bottom" title="作者"><i class="glyphicon glyphicon-user"></i>&nbsp;{{$data->vname}}</span>
                        <span class="item article-meta-time">
	  <time class="time" data-toggle="tooltip" data-placement="bottom" title="发表时间"><i class="glyphicon glyphicon-time"></i>&nbsp;{{date('Y-m-d H:i',$data->time)}}</time></span>
                        <span class="item article-meta-views" data-toggle="tooltip" data-placement="bottom" title="浏览量"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;{{$data->look}}</span>
                        <span class="item article-meta-comment" data-toggle="tooltip" data-placement="bottom" title="评论量"><i class="glyphicon glyphicon-comment"></i>&nbsp;{{$data->comment}}</span>
                    </div>
                </header>
                <article class="article-content">
                    <p style="border:solid white 2px;padding: 8px">{!! $data->content !!}</p>
                    <br>
                    <br>
                    <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a></div>

                    <script>
                        window._bd_share_config = { "common": { "bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "1", "bdSize": "32" }, "share": {} }; with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=0.js?cdnversion=' + ~(-new Date() / 36e5)];
                    </script>
                </article>
                {{--<div class="relates">
                    <div class="title">
                        <h3>相关推荐</h3>
                    </div>
                    <ul>
                        <li><a href="#" title="" >用DTcms做一个独立博客网站（响应式模板）-MZ-NetBlog主题</a></li>
                        <li><a href="#" title="" >用DTcms做一个独立博客网站（响应式模板）-MZ-NetBlog主题</a></li>
                        <li><a href="#" title="" >用DTcms做一个独立博客网站（响应式模板）-MZ-NetBlog主题</a></li>
                        <li><a href="#" title="" >用DTcms做一个独立博客网站（响应式模板）-MZ-NetBlog主题</a></li>
                    </ul>
                </div>--}}
                <div class="title" id="comment">
                    <h3>评论</h3>
                </div>
                <div id="respond">
                    <div id="comment-form">
                        <div class="comment">
                            <div class="comment-box">
                                <textarea placeholder="您的评论或留言（必填）" name="comment-textarea" id="comment-textarea" cols="100%" rows="3" tabindex="3"></textarea>
                                <div class="comment-ctrl">
                                    <button type="submit" name="comment-submit" id="comment-submit" tabindex="4">评论</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="postcomments">
                    <ol id="comment_list" class="commentlist">
                        @forelse($cmt as $v)
                        <li class="comment-content"><div class="comment-main"><p><a class="address" href="#" rel="nofollow" target="_blank">{{$v->fromname}}</a><span class="time">({{date('Y-m-d H-i',$v->time)}})</span><div>{!! $v->content !!}</div></div></li>
                        @empty
                            <br><div align="center" style="color: lightgrey;font-size: 16px">还没有评论哦</div>
                        @endforelse
                    </ol>
                </div>
            </div>
                @else
                <div style="font-size:22px;font-weight: 700; color: darkred;margin: 10px 30%">非法数据</div>
            @endif
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
            $('#comment-submit').click(function () {
                var aid  = $('.article-header').attr('id');
                var cont = $('#comment-textarea').val();
                if (cont.length < 1){
                    alert('评论不能为空');
                }else {
                    $.post('{{url('/blog/comment')}}',{aid:aid,cont:cont,_token:'{{csrf_token()}}'},function (msg) {
                        if (msg == 'true'){
                            alert('回复成功');
                            location.reload();
                        }else {
                            alert('数据异常');
                        }
                    });
                }
            });
        });
    </script>
@endsection
