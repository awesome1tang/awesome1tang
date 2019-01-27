<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Goods_image extends Model
{
    public $table = 'goods_image';

    protected $guarded = [];

    public $timestamps = false;


    public function belongToGoods(){


        return $this->belongsTo('App\Model\admin\Goods','gid','id');


    }



}
