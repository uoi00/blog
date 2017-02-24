<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
/*
 *用户
 */
class UserController extends Controller{
    //登录
    public function login(){
        $data = Input::all();
        $tool = new ToolController();
        if ($tool->hd($data['y'])){
            $rst = DB::select('select id,vname,pwd from user where vname=:vname or mail=:mail',['vname'=>$data['username'],'mail'=>$data['username']]);
            if (empty($rst)){
                return back()->with('info', '用户不存在');
            }else {
                if ($rst[0]->pwd == sha1($data['p'])) {
                    Session::put('blog_user',$rst[0]);
                    return redirect(url('/index'));
                } else {
                    return back()->with('info', '密码错误');
                }
            }
        }else{
            return back()->with('info','验证码错误');
        }
    }
    //注册
    public function register(){
        $data = Input::all();
        $datas = [
            ':name' => htmlspecialchars($data['user']),
            ':mail' => $data['mail'],
            ':pwd'  => sha1($data['passwd']),
            ':time' => date('Y-m-d H-i-s'),
        ];
        if ($data['mail_yzm'] == Session::get('mail_rand')){
            $rst = DB::insert("insert into user (vname,mail,pwd,ctime) values (:name,:mail,:pwd,:time)",$datas);
            if ($rst){
                return back()->with('info','注册成功');
            }else{
                return back()->with('info','数据错误');
            }
        }else{
            return back()->with('info','验证码错误');
        }
    }
    //用户注销
    public function logout(){
        Session::flush();
        return redirect(url('/'));
    }
    //密码找回
    public function find(){

    }
    //系统测试
    public function test(){
        $mod = new \App\Http\Model\Article();
        $mod->getlist();
/*        Session::put('key','213');
        echo Session::get('key');*/
    }
}