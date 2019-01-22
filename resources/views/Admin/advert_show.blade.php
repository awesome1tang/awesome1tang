@extends('layout.admins');

@section('title','后台首页')

@section('content')

<!doctype html>

        <!-- 左侧菜单结束 -->
        <!-- 右侧主体开始 -->
        <div class="page-content">
          <div class="content">
            <!-- 右侧内容框架，更改从这里开始 -->
            <div class="layui-form xbs">
                <div class="layui-form-pane" style="text-align: center;">
                  <div class="layui-form-item" style="display: inline-block;">
                   
                    <div class="layui-input-inline">
                      <form id="search">
                      <input type="text" name="name"  placeholder="请输入查找名" autocomplete="off" class="layui-input">
                        </form>
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach" id="tosearch"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
           
            <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><button class="layui-btn" onclick="member_add('添加用户','member-add.html','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：{{$list->total()}} 条</span></xblock>
            <div id="alltable">
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="" value=""
                            style="display:block"
                            >

                        </th>
                        <th>
                            ID
                        </th>
                        <th width="200px">
                            广告名
                        </th>
                        <th width="200px" >
                            指向地址
                        </th>
                        <th  width="200px" >
                            图片
                        </th width="200px"  >
                        <th>
                            状态
                        </th>
                        <th width="200px"  >
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody  id="mytable">
               
                @foreach($list as $value )
                        <tr> 
                        <td>
                            <input type="checkbox" value="1" name="" style="display:block">
                        </td>
                        <td>
                            {{$value->id}}
                        </td>
                        <td class="name">
                            {{$value->name}}
                        </td>
                        <td >
                            {{$value->url}}
                        </td>
                        <td >
                           <img class="img-rounded" src="/uploads/{{$value->pic}}" width="100px" height="100px" alt="">
                        </td>
                        
                       
                        <td class="td-status" id="status{{$value->id}}" onclick="status_change({{$value->id}})">
                            <span class="layui-btn layui-btn-normal layui-btn-mini">
                                @if($value->status ==0)
                                {{'已禁用'}}
                                @else
                                {{'已开启'}}
                                @endif
                            </span>
                        </td>
                    
                        <td class="td-manage">
                           
                            <a id="edit" title="编辑" href="javascript:;" 
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                           
                            <a id="delete" onclick="remove({{$value->id}})" title="删除" href="javascript:;" 
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        
                        </td>
                    </tr>
                   @endforeach
              
                </tbody>
            </table>
            </div>
            {{ $list->appends($request->all())->render() }}
            <!-- 右侧内容框架，更改从这里结束 -->
          </div>
        </div>
        <!-- 右侧主体结束 -->
    </div>
    <!-- 中部结束 -->
    <!-- 底部开始 -->
   
    <!-- 底部结束 -->
    <!-- 背景切换开始 -->
    <div class="bg-changer">
        <div class="swiper-container changer-list">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img class="item" src="/images/a.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/images/b.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/images/c.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/images/d.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/images/e.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/images/f.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/images/g.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/images/h.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/images/i.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/images/j.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/images/k.jpg" alt=""></div>
                <div class="swiper-slide"><span class="reset">初始化</span></div>
            </div>
        </div>
        <div class="bg-out"></div>
        <div id="changer-set"><i class="iconfont">&#xe696;</i></div>   
    </div>
    <div id="test"></div>
    <!-- 背景切换结束 -->
    <!-- 页面动态效果 -->
    <script>

        $('#tosearch').click([],function(){

            var formdata = new FormData(document.getElementById('search'));

            //console.log('123114322423233');
            //console.log(formdata.get('name'));

            $.ajax({

                url:"{{route('advert_show')}}",
                type:"post",
                data:formdata,
                processData:false,              
                contentType:false,
                success:function(data){

            
                     $("#allBody").html(data);        

                }


                })
        })

        function remove(id){

            var id =id;



          var e = confirm('你确定要删除')
                //console.log('2342343');
            if(e == 1){
                 

           $.get("{{route('advert_delete')}}",{id:id},function(res){
           


            $('#delete').parent().parent().remove();

       



           }) 





        }

            }





            //状态修改
            function status_change(id){

               var status = $('#status'+id).children().html().trim();
              
              if(status == '已禁用'){
                  var curr_status= 0;

               }

               if(status == '已开启'){

                 var curr_status =1;
               }

                
                     
             
              $.get("{{route('advert_status')}}",{id:id,status:curr_status},function(data){
                            
                        
                        if(data.res == 1){

                           $('#status'+id).children().html('已开启');
                        }
                        if(data.res == 0){

                            $('#status'+id).children().html('已禁用');
                        }

              })
            
               

            }

            //填写编写
             $('.name').dblclick(function(){

                var um = $(this);

        //获取td里面的内容
                var ux = $(this).text().trim();

        //创建input输入框
                var ipu = $('<input type="text" />');

                $(this).empty();

                $(this).append(ipu);

                ipu.val(ux);

                ipu.focus();

                ipu.select();

                ipu.blur(function(){
            //获取输入的新值
                var uv = $(this).val().trim();

                if(uv == ''){

                alert('输入的值不能为空');
                return;
                }

            //获取id
            var ids = $(this).parent().prev().text().trim();


            $.post('/admin/select_input',{name:uv,id:ids},function(data){

                if(data == '1'){

                    um.text(uv);
                } else {

                    um.text(ux);
                }
            })
        })



    })











    </script>
</body>
</html>



@endsection