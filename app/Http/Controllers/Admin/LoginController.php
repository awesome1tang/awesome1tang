<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use DB;
use Illuminate\Support\Facades\Cookie;
        class LoginController extends Controller{

        public function show(){



            return view('admin.login');


        }




        public function check_login(Request $request){

           if($request->check_code == session('code')){


            
            
                
           return response('Hello Cookie')->cookie('user', '123', 1160);

         }

            }

        }




    

















?>