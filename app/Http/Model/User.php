<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false; //不需要框架的时间戳 不设置可能出错
    protected $guarded = [];
    //查找用户名
    public function idName($id){
        $data = $this::find($id);
        return $data->vname;
    }
}
