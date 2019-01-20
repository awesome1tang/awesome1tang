<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //首页
    public function index(){

    return view('home.index');

    }
    
    //用户登录
    public function login(){

    return view('home.user_login');
    
    }
    //用户注销
    
    public function register(){

    return view('home.register_input');
    }

    //优惠卷获取
    public function time_action(){

    return view('home.action');
    }
    //充值
    
    public function fill_money(){

    return view('home.fill_money');

    }
    //加入购物车
    public function fill_cart(){

    return view('home.fill_cart');

    }
    //超级品类
    public function supertype(){



    }
    
    public function showdetail(){

        return view('home.showdetail');
    }

    public function search(){


    }

}
