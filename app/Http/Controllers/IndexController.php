<?php

namespace App\Http\Controllers;

use App\Http\Model\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class IndexController extends Controller
{
    //显示主页
    public function index(){
        $name = Session::get('blog_user');
        $atc = new Article();
        $blog = $atc->getBlogList();
        $moot = $atc->getMootList($name->id);
        $data = ['moot' => $moot,'blog'=>$blog];
        return view('index',['name'=>$name->vname],['data'=>$data]);
    }
    //搜索博文
    public function search(){
        $name = Session::get('blog_user');
        $input = Input::all();
        if (empty($input['keyword'])){
            return back();
        }else{
            $blog = new Article();
            $blogs = $blog->blogSearch($input['keyword']);
            return view('blog.blogsearch',['name'=>$name->vname],['data'=>$blogs]);
        }
    }
}
