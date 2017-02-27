<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Photos extends Model
{
    protected $table = 'photos';
    protected $primaryKey = 'id';
    public $timestamps = false; //不需要框架的时间戳 不设置可能出错
    protected $guarded = [];
    //查询相册列表
    public function photosList($id){
        return $this::where(['user'=>$id])->get();
    }
    //添加相册
    public function add($data){
        $this->fill($data);
        return $this->save();
    }
    //修改相册
    public function edit($data,$pid,$id){
        $pht = $this::find($pid);
        if ($pht->user == $id) {
            return $pht->update($data);
        }else{
            return false;
        }
    }
    //删除相册及相片
    public function del($id,$user){
        DB::beginTransaction();
        $pic = new Pictures();
        $pics = $pic::where('photo',$id);
        $pts = $this::find($id);
        if ($pts->user != $user) { //核对是否该用户拥有
            return false;
        }
        if($pics->get()->toArray()){
            if ($pics->delete()){
                if ($pts->delete()){
                    DB::commit();
                    return true;
                }
            }
        }else{
            if ($this::find($id)->delete()){
                DB::commit();
                return true;
            }
        }
        DB::rollBack();
        return false;
    }
}
