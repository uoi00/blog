<?php

namespace App\Http\Controllers;

use App\Http\Model\Article;
use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Session;

class ArticleController extends Controller
{
    //显示博客页
    public function blogList(){
        $name = Session::get('blog_user');
        $blog = new Article();
        $blogs = $blog->blogAll($name->id);
        return view('blog.blogs',['name'=>$name->vname,'data'=>$blogs]);
    }
    //显示博客添加页面
    public function add(){
        $name = Session::get('blog_user');
        return view('blog.blogadd',['name'=>$name->vname]);
    }
    //添加保存
    public function addSave(){
        $input = Input::all();
        $data['user'] = Session::get('blog_user')->id;
        $data['title'] = addslashes($input['title']);
        $data['lable'] = addslashes($input['lable']);
        $data['content'] = $input['cont'];
        $data['time'] = time();
        $data['type'] = '0';
        $blog = new Article();
        if ($blog->addBlog($data)){
            echo 'true';
        }
    }
    //查看博文
    public function showBlog($id){
        $name = Session::get('blog_user');
        $blog = new Article();
        $data = $blog::find($id);
        if (empty($data) || $data->type != 0){
            return view('blog.showblog', ['name' => $name->vname]);
        }else {
            /*查找文章评论*/
            $cmt = new \App\Http\Model\Comment();
            $cmts = $cmt->selCmt($id);
            $blog->lookAdd($id,$name->id);
            return view('blog.showblog', ['name' => $name->vname, 'data' => $data, 'cmt' => $cmts]);
        }
    }
    //修改博文
    public function editBlog($id){
        $name = Session::get('blog_user');
        $blog = new Article();
        $data = $blog::find($id);
        if (empty($data) || $data->user != $name->id){
            return view('blog.editblog',['name'=>$name->vname]);
        }else{
            return view('blog.editblog',['name'=>$name->vname,'data'=>$data]);
        }
    }
    //保存修改
    public function editSave(){
        $name = Session::get('blog_user');
        $input = Input::all();
        $data['title'] = addslashes($input['title']);
        $data['lable'] = addslashes($input['lable']);
        $data['content'] = $input['cont'];
        $data['time'] = time();
        $blog = new Article();
        if ($blog->editBlog($input['bid'],$data,$name->id)){
            echo 'true';
        }
    }

    //文章、心情评论
    public function comment(){
        $name = Session::get('blog_user');
        $input = Input::all();
        $atc = new Article();
        empty($input['cont'])? exit('false'):' ';
        empty($atc::find($input['aid'])) ? exit('false'):' ';
        $cmt = new \App\Http\Model\Comment();
        $data['article'] = $input['aid'];
        $data['content'] = $input['cont'];
        $data['from']    = $name->id;
        $data['fromname']= $name->vname;
        $data['time']    = time();
        if ($cmt->addCmt($data)){
            echo 'true';
        }
    }
}
