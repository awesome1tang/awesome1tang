@extends('layout.admins');

@section('title','后台首页')

@section('content')

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
            <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><button class="layui-btn" onclick="member_add('添加用户','member-add.html','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：5534 条</span></xblock>
        
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
                        <th width="100px">
                            商品名字
                        </th>
                        <th width="100px" >
                            颜色
                        </th>
                        <th  width="100px" >
                            内容
                        </th width="100px"  >
                        <th>
                            图片
                        </th>
                        <th>
                            大小
                        </th>
                        <th width="100px"  >
                            状态
                        </th>
                        <th width="100px"  >
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody  id="mytable">
                 @foreach($res as $value )
                        <tr> 
                        <td>
                            <input type="checkbox" value="1" name="" style="display:block">
                        </td>
                        <td>
                            {{$value->id}}
                        </td>
                        <td class="name">
                            {{$value->goods_name}}
                        </td>
                        <td >
                            {{$value->color}}
                        </td>
                         <td >
                            {{$value->content}}
                        </td>
                       
                        
                       
                       

                         <td >
                        @php
                       

                        $image = App\Model\Admin\Goods::find($value->id)->hasManyImage()->get();

                        @endphp

                        @foreach($image as $k=>$vs )

                        <img class="img-rounded" src="{{$vs->pic}}" width="100px" height="60px" alt="">
                        

                        @endforeach

                        </td>

                        <td >
                            {{$value->length}}
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

@endsection