<?php
namespace App\Http\Controllers;
use App\Http\Model\Info;
use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use League\Flysystem\Exception;
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
                    return back()->with('info', '密码异常');
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
            'vname' => htmlspecialchars($data['user']),
            'mail' => $data['mail'],
            'pwd'  => sha1($data['passwd']),
            'time' => time(),
        ];
        if ($data['mail_yzm'] == Session::get('mail_rand')){
            $user = new User();
            DB::beginTransaction(); //开启事务处理
            $rst = $user->fill($datas);
            if ($rst->save()) {
                $info = new Info();
                @$in = $info->fill(['id'=>$rst->id,'vname'=>$datas['vname'],'mail'=>$datas['mail']]);
                if ($in->save()) {
                    DB::commit();
                    return back()->with('info','注册成功');
                }else {
                    DB::rollBack();
                    return back()->with('info','数据异常');
                }
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
    public function update(){
        $data = Input::all();
        if ($data['mail_yzm'] == Session::get('mail_rand')) {
            $us = new User();
            $users = $us::where(['mail'=>$data['mail']])->get();
            if ($users->toArray()){
                $rst = DB::update('update user set pwd=:pwd where mail=:mail',[':pwd'=>sha1($data['passwd']),':mail'=>$data['mail']]);
                if ($rst){
                    return redirect(url('/'));
                }else{
                    return back()->with('info','数据异常');
                }
            }
        }else{
            return back()->with('info','数据异常');
        }
    }
    //系统测试
    public function test(){
        echo app_path().'<br>';
        echo base_path().'<br>';
        echo public_path();
    }
}