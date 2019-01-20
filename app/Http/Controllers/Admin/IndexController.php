<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use DB;
class IndexController extends Controller
{
   /* public function login(){


        return view('login.index');
    }

    public function check(Request $request){   
        $username=$request->input('name');

        $pwd=User::where('username',$username)->select()->value('password');
    
        $password=$request->input('password');
        $pass=$request->input('_token');
        var_dump($pass);
        if($pwd!=null & $pwd=="$password"){

            echo '你登陆陈公公';
        }else{
            var_dump($pwd);
            echo '去死吧你';
        }
        }
        */
        //后台首页
    public function index(){


        return view('admin.index',['title'=>'唐承政的模块']);

    }
        //后台登陆
    public function login(){


        return view('admin.login');
    }
        //后台验证 ajax请求验证
    public function check(){



    }



}
