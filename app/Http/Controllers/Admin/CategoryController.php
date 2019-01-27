<?php

    namespace App\Http\Controllers\Admin;

    use Illuminate\Http\Request;

    use App\Http\Controllers\Controller;

    use App\Model\Admin\Category;
    use DB;

    class CategoryController extends Controller{


        public function list(Request $request){

            /*$res = Category::select(DB::raw('*,concat(path,id) as paths'))->orderBy('paths')->where('name','like','%'.$request->catename.'%')->paginate($request->input('nums',10));

            foreach($res as $k =>$v){

                $level =substr_count($v['path'],',')-1;

                $v['name'] = str_repeat('&nbsp;&nbsp;&nbsp;',$level).$v['name'];

            }*/


            $list =Category::select(DB::raw('*,concat(path,id) as paths'))->orderBy('paths')->where('name','like','%'.$request->catename.'%'.$request->name.'%')->paginate($request->input('nums',10));


            foreach($list as $k => $v){

                $level = substr_count($v['path'], ',')-1;

                $v['name'] = str_repeat('&nbsp;&nbsp;&nbsp',$level).$v['name'];
            }


            return view('admin.category_show',[

                'list'=>$list,
                'request'=>$request

                ]);




        }



        public function add(){


            $res = Category::select(DB::raw('*,concat(path,id) as paths'))->orderBy('paths')->get();


            foreach($res as $k => $v){

                $level =substr_count($v['path'],',')-1;

                $v['name'] = str_repeat('&nbsp;&nbsp;&nbsp;',$level).$v['name'];
            }   

                return view('admin.category_add',[

                    'res'=>$res

                    ]);



             //return view('admin.category_add');   

        }





        public function do_add(Request $request){


            $rs = $request->except('_token');

            //dd($rs);

            if($rs['pid'] == '0'){
                   

                $rs['path'] = '0,';

            var_dump($rs);
            }else {


                $res = DB::table('good_type')->where('id',$rs['pid'])->first();

                $rs['path'] = $res->path.$res->id.',';
            }

            try{

                $data = Category::insert($rs);

                //var_dump($data);

                if($data){

                    return redirect('/admin/category_add')->with('success','添加成功');
                }

            }catch(\Exception $e){

                echo '添加失败';
                return back()->with('error','添加失败');
            }
            
        }


        public function edit(){










        }







        public function delete(){







        }














    }
























?>