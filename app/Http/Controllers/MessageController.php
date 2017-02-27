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
class MessageController extends Controller{
    //显示消息页面
    public function index(){
        echo '消息';
    }
}