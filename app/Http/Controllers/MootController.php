<?php

namespace App\Http\Controllers;

use App\Http\Model\Article;
use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Symfony\Component\Yaml\Tests\A;

class MootController extends Controller
{
    //显示心情页
    public function mootList(){
        $name = Session::get('blog_user');
        $moot = new Article();
        $data = $moot->mootAll($name->id);
        return view('moot.moots',['name'=>$name->vname,'data'=>$data]);
    }
    //显示心情添加页面
    public function add(){
        $name = Session::get('blog_user');
        return view('moot.mootadd',['name'=>$name->vname]);
    }
    //添加保存
    public function addSave(){
        $input = Input::all();
        $data['user'] = Session::get('blog_user')->id;
        $data['content'] = $input['moots'];
        $data['time'] = time();
        $data['type'] = '1';
        $moot = new Article();
        if ($moot->addMoot($data)){
            echo 'true';
        }
    }
    //显示心情
    public function show($id){
        $name = Session::get('blog_user');
        $moot = new Article();
        $data = $moot::find($id);
        if (empty($data) || $data->type != 1){
            return view('moot.showmoot',['name'=>$name->vname]);
        }else {
            /*查找文章评论*/
            $cmt = new \App\Http\Model\Comment();
            $cmts = $cmt->selCmt($id);
            $moot->lookAdd($id,$name->id);
            return view('moot.showmoot', ['name' => $name->vname, 'data' => $data, 'cmt' => $cmts]);
        }
    }
    //删除心情
    public function delMoot(){
        $moot = new Article();
        if($moot->delMoot(Input::all()['id'])){
            echo 'true';
        }
    }
    //修改心情
    public function editMoot($id){
        $name = Session::get('blog_user');
        $moot = new Article();
        $data = $moot::find($id);
        if (empty($data) || $data->user != $name->id){
            return view('moot.editmoot',['name'=>$name->vname]);
        }else{
            return view('moot.editmoot',['name'=>$name->vname,'data'=>$data]);
        }
    }
    //保存修改
    public function editSave(){
        $name = Session::get('blog_user');
        $input = Input::all();
        $data['content'] = $input['cont'];
        $data['time'] = time();
        $blog = new Article();
        if ($blog->editBlog($input['bid'],$data,$name->id)){
            echo 'true';
        }
    }
}
