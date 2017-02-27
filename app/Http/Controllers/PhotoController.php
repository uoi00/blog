<?php

namespace App\Http\Controllers;

use App\Http\Model\Photos;
use App\Http\Model\Pictures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class PhotoController extends Controller
{
    //显示相册主页
    public function index(){
        $name = Session::get('blog_user');
        $photo = new Photos();
        $data = $photo->photosList($name->id);
        return view('photos.photos',['name'=>$name->vname,'data'=>$data]);
    }
    //添加相册
    public function addPhotos(){
        $name = Session::get('blog_user');
        return view('photos.addphoto',['name'=>$name->vname]);
    }
    //保存修改
    public function addSave(){
        $name = Session::get('blog_user');
        $input = Input::get();
        $data['name'] = htmlspecialchars($input['name']);
        $data['bewrite'] = htmlspecialchars($input['bewrite']);
        $data['time'] = time();
        $data['user'] = $name->id;
        $pts = new Photos();
        if ($pts->add($data)){
            echo 'true';
        }
    }
    //相册详情
    public function show($id){
        $name = Session::get('blog_user');
        $photots = new Photos();
        $data = $photots::find($id);
        if (empty($data) || $data->user != $name->id){
            return view('photos.showphoto',['name'=>$name->vname]);
        }else{
            if (!empty($_FILES)){
                $f = $_FILES['files'];
                $newp = $f['tmp_name'][0];
                if (!$f['error'][0]) {
                    $finfo = finfo_open(FILEINFO_MIME);
                    $a = finfo_file($finfo, $newp);
                    $b = explode(';', $a);
                    if (pos($b) == $f['type'][0]) {
                        $datas['oldname'] = $f['name'][0];
                        $datas['photo'] = $id;
                        $lastname = strrchr($datas['oldname'],'.');
                        $datas['name'] = substr(md5($f['name'][0]), 1, 8) .$lastname;
                        $datas['time'] = time();
                        $datas['user'] = $name->id;
                        $moveRst = move_uploaded_file($f['tmp_name'][0],public_path().'/images/photos/'.$datas['name']);
                        if ($moveRst) {
                            $pic = new Pictures();
                            $pic->fill($datas);
                            if ($pic->save()) {
                                exit('true');
                            }
                        }
                    }
                }
            }
            $pic = new Pictures();
            $pics = $pic->pictures($id);
            return view('photos.showphoto',['name'=>$name->vname,'data'=>$data,'pics'=>$pics]);
        }
    }
    //修改相册
    public function edit($id){
        $name = Session::get('blog_user');
        $blog = new Photos();
        $data = $blog::find($id);
        if (empty($data) || $data->user != $name->id){
            return view('photos.edit',['name'=>$name->vname]);
        }else{
            return view('photos.edit',['name'=>$name->vname,'data'=>$data]);
        }
    }
    //保存修改
    public function editSave(){
        $name = Session::get('blog_user');
        $input = Input::all();
        $data['name'] = addslashes($input['name']);
        $data['bewrite'] = addslashes($input['bewrite']);
        $blog = new Photos();
        if ($blog->edit($data,$input['id'],$name->id)){
            echo 'true';
        }
    }
    //删除相册及相片
    public function del(){
        $name = Session::get('blog_user');
        $input = Input::all();
        $ptc = new Photos();
        if ($ptc->del($input['id'],$name->id)){
            echo 'true';
        }
    }
    //设置相册封面
    public function face(){
        $name = Session::get('blog_user');
        $input = Input::all();
        $pic = new Pictures();
        echo $pic->face($input['id'],$name->id,$input['pid']) ? 'true' : 'false';
    }
    //删除照片
    public function delPic(){
        $name = Session::get('blog_user');
        $input = Input::all();
        $pic = new Pictures();
        echo $pic->del($input['id'],$name->id) ? 'true' : 'false';
    }
}