<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $table = 'photos';
    protected $primaryKey = 'id';
    public $timestamps = false; //不需要框架的时间戳 不设置可能出错
    protected $guarded = [];

}
