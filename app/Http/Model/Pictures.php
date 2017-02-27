<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    protected $table = 'pictures';
    protected $primaryKey = 'id';
    public $timestamps = false; //不需要框架的时间戳 不设置可能出错
    protected $guarded = [];
    //相册相片
    public function pictures($id){
        return $this::where('photo',$id)->get();
    }
    //设置相册封面
    public function face($id,$user,$pid){
        $pic = $this::find($id);
        if ($pic && $pic->user==$user){
            return Photos::find($pid)->update(['first'=>$pic->name]) ? true :false;
        }
    }
    //删除相片
    public function del($id,$user){
        $pic = $this::find($id);
        if ($pic && $pic->user==$user){
            return $pic->delete() ? true :false;
        }
    }
}
