<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //处理字符串
    protected function strHandle($str){
        return htmlspecialchars(addslashes($str));
    }
    //还原字符串
    public function strDishd($str){
        return stripcslashes(htmlspecialchars_decode($str));
    }
}
