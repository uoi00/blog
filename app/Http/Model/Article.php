<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'id';
    public $timestamps = false; //不需要框架的时间戳 不设置可能出错
    protected $guarded = [];
    //获取博文列表
    public function getBlogList(){
        return $this->where('type','0')->orderby('look','desc')->limit(6)->get();
    }
    //获取全部博文
    public function blogAll($user){
        return $this::where(['user'=>$user,'type'=>0])->orderby('time','desc')->paginate(4);
    }
    //搜索博文
    public function blogSearch($kword){
        return $this::where('title','LIKE',"%$kword%")->orwhere('lable','LIKE',"%$kword%")->orderby('look','desc')->paginate(6);
    }
    //添加博文
    public function addBlog($data){
        $this->fill($data);
        return $this->save();
    }
    //修改博文
    public function editBlog($id,$data,$name){
        $blog = $this::find($id);
        if ($blog->user == $name) {
            return $blog->update($data);
        }else{
            return false;
        }
    }
    //获取心情最近列表
    public function getMootList($user){
        return $this->where(['user'=>$user,'type'=>1])->orderby('look','desc')->limit(7)->get();
    }
    //获取全部心情列表
    public function mootAll($user){
        return $this::where(['user'=>$user,'type'=>1])->orderby('time','desc')->paginate(6);
    }
    //添加心情语录
    public function addMoot($data){
        $this->fill($data);
        return $this->save();
    }
    //删除心情/博文
    public function delMoot($id){
        $moot = $this::find($id);
        return $moot->delete();
    }

    //访问量+1
    public function lookAdd($id,$name){
        // 用户 文章（多）
        $ckname = 'blog_look_'.$name;
        if (isset($_COOKIE[$ckname])){
            $p = "#,$id,#";
            if (!preg_match($p,$_COOKIE[$ckname])){
                $atc = $this::find($id);
                $atc->look += 1 ;
                if ($atc->save()){
                    $ss = $_COOKIE[$ckname] . ",$id,";
                    setcookie($ckname , $ss);
                }
            }
        }else{
            $atc = $this::find($id);
            $atc->look += 1 ;
            if ($atc->save()){
                $ss = ",$id,";
                setcookie($ckname , $ss);
            }
        }
    }
}
