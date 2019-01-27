<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{   



    public $table = 'goods_table';

    public $timestamps = false;

    protected $guarded = [];

    public function hasManyImage()

    {

        return $this->hasOne('App\Model\admin\Goods_image','gid','id');


    }



}
