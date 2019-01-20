<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Advert;
use Illuminate\Http\UploadedFile;
use Storage;
use Illuminate\Http\File;
class AdvertController extends Controller
{
    
    //广告模快
    
    public function advert_add(){


       return view('admin.advert');
    }

    
    //广告显示
    public function advert_show(Request $request){

        $list=Advert::where('name','like','%'.$request->name.'%')->paginate($request->input('nums',2));
        

        //$res = Advert::
        /*where('name','like','%'.'%');/*->
        paginate($request->input('nums',10));*/

       return view('admin.advert_show',[
            'title'=>'用户的列表页面',
            'list'=> $list,
            'request'=>$request
        ]);
        
 
    }

    public function Advert_test(Request $request){




        return Response()->json(
            [
            'request'=>$request->name
            ]);

    }




    //广告删除
    public function advert_delete(Request $request){

        




    }

    //获取表单
    
    public function advert_get(Request $request){
    
       if ($request->hasFile('pic')) {
        
        $file = $request->file('pic');
        //识别类型
        $allowed_extensions = ["png","jpg","gif"];
        


        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return response()->json([
                'status' => false,
                'message' => '只能上传 png | jpg | gif格式的图片'
            ]);die;
        }

        //保存图片到服务器
        $photo_path = 'uploads';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(15).'.'.$extension;
        $pic =$fileName;
        $bool=$file->move($photo_path,$fileName);


        //放回json数值,并存入数据库
        if($bool){
        $advert = $request->advert;
        $url = $request->url;


        Advert::insert(['pic'=>$pic,'name'=>$advert,'url'=>$url,'status'=>'0']);




        return Response()->json(
                [
                'status'=>true,
                'pic' =>$pic,
                'advert'=>$advert,
                'url'=>$url
                ]


            );

    }else{

        unlink('uploads'.'/'.$pic);   

    }



    }

    
    }






}
