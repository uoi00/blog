<?php
namespace App\Http\Controllers;

use App\Http\Model\Info;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;

class InfoController extends Controller{
    //显示主页
    public function index(){
        $name = Session::get('blog_user');
        $rst = DB::select('select user.time,info.* from user,info where user.id=:id and user.id=info.id',[':id'=>$name->id]);
        if (!$rst[0]){
            return view('info.index',['name'=>$name->vname]);
        }
        return view('info.index',['name'=>$name->vname,'data'=>$rst[0]]);
    }
    //修改信息
    public function edit(){
        $name = Session::get('blog_user');
        $data = new Info();
        $rst = $data::find($name->id);
        if (empty($rst)){
            return view('info.index',['name'=>$name->vname]);
        }
        return view('info.edit',['name'=>$name->vname,'data'=>$rst]);
    }
    //保存修改
    public function save(){
        $name = Session::get('blog_user');
        $data = Input::all();
        unset($data['_token']);
        $info = new Info();
        $i = $info::find($name->id);
        $rst = $i->update($data);
        if ($rst){
            echo 'true';
        }
    }
}