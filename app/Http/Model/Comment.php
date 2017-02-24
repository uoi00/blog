<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'id';
    public $timestamps = false; //不需要框架的时间戳 不设置可能出错
    protected $guarded = [];
    //查找文章\心情评论
    public function selCmt($id){
        return $this::where('article',$id)->orderby('time','desc')->paginate(6);
    }
    //添加评论
    public function addCmt($data){
        $this::fill($data);
        return $this->save();
    }
}
