<?php

    namespace App\Http\Controllers\Admin;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use DB;

    use App\Model\Admin\Goods;
    use App\Model\admin\Goods_image;
    use App\Model\Admin\Category;
        


    class GoodsController extends Controller{


        //添加商品
        public function add(){


            
            $res = Category::select(DB::raw('*,concat(path,id) as paths'))->orderBy('paths')->get();


            foreach($res as $k => $v){

                $level =substr_count($v['path'],',')-1;

                $v['name'] = str_repeat('&nbsp;&nbsp;&nbsp;',$level).$v['name'];
            }   

                return view('admin.goods_add',[

                    'res'=>$res

                    ]);

        }



        //处理添加

        public function do_add(Request $request){


           // var_dump($request->all());
            $file = $request->pic;
            $res=$request->except('_token','_method','gimg','pic');

            $bool=Goods::create($res);

            //var_dump($file);



       if($bool){

                $gid = $bool->id;

                $data = $bool->find($gid);
                //var_dump($gid);

                if($file){


                        //$file =$request->file('gimg');

                        //var_dump($file);

                        $res = [];

                        foreach($file as $k=>$v ){

                            $arr = [];

                            $arr['gid'] = $gid;

                            $name = rand(1111,9999).time();

                            $suffix = $v->getClientOriginalExtension();

                            $v->move('./uploads/goodsimg',$name.'.'.$suffix);

                            $arr['pic'] = '/uploads/goodsimg/'.$name.'.'.$suffix;

                            $res[] =$arr;

                    }

                    


                     $info = $data->hasManyImage()->createMany($res);

                    if($info){

                            ob_end_clean();
                            return Response()->json([

                                'sucess'=>'create sucessful'


                                ]);
                        

                    }


                }else{


                     return Response()->json([

                                'error'=>'你没有文件上传'


                                ]);


                }


               
            }
        

        }




       // 列表展示
        public function show(Request $request){






            $res=Goods::where('goods_name','like','%'.$request->name.'%')->paginate($request->input('nums',100));

            $g_image=[];

           /* foreach($res as $key=>$value){


                //var_dump($value->id);

                $gid = $value->id;

                $image = Goods::find($gid)->hasManyImage()->get();
                $i=0;
                foreach($image as $v){

                    $i++;

                    $g_image[$i]=$v;
                   

                }
             


            }

            */

            //return view('');
               //dump($g_image);



            return view('admin.goods_show',
                [

                'res'=>$res,
               
                ]

                );

        }






        //编辑

        public function edit(){


             $res = Category::select(DB::raw('*,concat(path,id) as paths'))->orderBy('paths')->get();


            foreach($res as $k => $v){

                $level =substr_count($v['path'],',')-1;

                $v['name'] = str_repeat('&nbsp;&nbsp;&nbsp;',$level).$v['name'];
            }   

                return view('admin.goods_add',[

                    'res'=>$res

                    ]);


            return view('admin.goods_edit');


        }




        public function delete(Request $request){


            $id = $request->id;

            $res = Goods::find($id);

            $bool=$res->delete();

            if($bool){
            
                $pic->hasManyImage()->get();

                foreach($image as $k=>$vs ){

                    unlink($vs->pic);
                }


                $res->hasManyImage()->delete();


                return Response()->json([

                    'sucess'=>'删除神功'


                    ]);



            }else{


                 return Response()->json([

                    'sucess'=>'删除失败'


                    ]);


            }







        }






        public function delete_img(){



            
            









        }


















    }

    




























?>