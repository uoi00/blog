<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
/*
 *工具控制器
 */
class ToolController extends Controller{
    /*
     * 验证码工具
     */
    private $mail_rst;
    //生成
    public function captcha()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 90, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('milkcaptcha', $phrase);
        header('Content-type: image/jpeg');
        $builder->output();
    }
    //核对
    public function hd($y)
    {
        if (Session::get('milkcaptcha') != $y) {
            return false;
        }else{
            return true;
        }
    }
    //发送邮件
    public function sendMail(){
        $mail_rand = rand(100000,999999); //生成随机码
        Session::put('mail_rand',$mail_rand); //用session记录
        $body = '您的校验码是：'.$mail_rand."\n\r请妥善保管。";
        Mail::send(['raw'=>$body],['name'=>''],function($message){
            $data = Input::all();
            $message ->to($data['mail'])->subject($data['title']);
            $this->mail_rst =$message;
        });
        echo 'true';
    }
}