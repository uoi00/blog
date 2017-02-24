<?php

namespace App\Http\Controllers;

use App\Http\Model\Photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class PhotoController extends Controller
{
    //显示相册主页
    public function index(){
        $name = Session::get('blog_user');
        $photo = new Photos();
        return view('photos.photos',['name'=>$name->vname]);
    }
}
