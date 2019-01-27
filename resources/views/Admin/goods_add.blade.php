@extends('layout.admins');

@section('title','后台首页')
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
  <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
    
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>


@section('content')
      
    <body>
    
    <form  id="send" enctype="multipart/form-data">

    <div class="form-group">
    <label for="exampleInputEmail1">所属分类</label>
     <select  name="tid" class="form-control" style="width:300px">
       @foreach($res as $k=>$v)
        <option value="{{$v->id}}">{{$v->name}}</option>
       @endforeach
    </select>
    </div>


    <div class="form-group">
    <label for="exampleInputEmail1">商品名</label>
    <input type="text" name="goods_name"  class="form-control" style="width:40%;" id="advert" placeholder="show_name">   
    </div>

    <div class="form-group">
    <label for="exampleInputEmail1">尺寸</label>
    <input type="text" name="length"  class="form-control" style="width:40%;" id="advert" placeholder="goods of length">   
    </div>


    <div class="form-group">
    <label for="exampleInputEmail1">颜色</label>
    <input type="text" name="color"  class="form-control" style="width:40%;" id="advert" placeholder="goods of color">   
    </div>


    <div class="form-group" >
    <label for="exampleInputEmail1">商品图片</label>
    

    <input id="uploadfile" type="file" name='pic[]' class="file" multiple />

   
    </div>


    <div class="form-group ">
    <label class="mws-form-label">添加商品详情</label>
    <div class="mws-form-message" >      
     <script id="editor" name='content' type="text/plain" style="width:800px;height:450px;"></script>
    </div>                          
    </div>
    
    <div class="form-group">
    <label for="exampleInputEmail1">状态</label>
    <div class="mws-form-item clearfix">
    <ul class="mws-form-list inline">
    <li><input type="radio" name='status' value='1' select  > <label>上架</label></li>
    <li><input type="radio" name='status' value='0'> <label>下架</label></li>
                        
    </ul>
    </div>  
    </div>
 
    {{csrf_field()}}



   

    </form> 

        <div class="progress" style="display:none" >
  
        <div class="progress-bar progress-bar-success"  id="progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" >

        </div>
        </div>

        <div class="form-group">
 

        <button  class="btn btn-info" type="submit" id="submit">确定提交</button>


        </div>



    </body>
  
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
   var ue = UE.getEditor('editor');
    
    setTimeout(function(){

        

    },3000)


   $("#uploadfile").fileinput({
 language: 'en', //设置语言
 //uploadUrl: "{{route('goods_do_add')}}", //上传的地址(访问接口地址)
 allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文件后缀
 //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
 uploadAsync: false, //默认异步上传
 showUpload: false, //是否显示上传按钮
 showRemove : true, //显示移除按钮
 showPreview : true, //是否显示预览
 showCaption: false,//是否显示标题
 browseClass: "btn btn-primary", //按钮样式  
 dropZoneEnabled: false,//是否显示拖拽区域
 //minImageWidth: 50, //图片的最小宽度
 //minImageHeight: 50,//图片的最小高度
 //maxImageWidth: 1000,//图片的最大宽度
 //maxImageHeight: 1000,//图片的最大高度
 //maxFileSize: 0,//单位为kb，如果为0表示不限制文件大小
 maxFileCount: 10, //表示允许同时上传的最大文件个数
 enctype: 'multipart/form-data',
 validateInitialCount:true,
 previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
 msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
});
//异步上传返回错误结果处理
$('#uploadfile').on('fileerror', function(event, data, msg) {
 console.log(data.id);
 console.log(data.index);
 console.log(data.file);
 console.log(data.reader);
 console.log(data.files);
 // get message
 alert(msg);
});
//异步上传返回结果处理
$("#uploadfile").on("fileuploaded", function (event, data, previewId, index) {
 console.log(data.id);
 console.log(data.index);
 console.log(data.file);
 console.log(data.reader);
 console.log(data.files);
 var obj = data.response;
 alert(JSON.stringify(data.success));
});
//批量同步上传错误处理
$('#uploadfile').on('filebatchuploaderror', function(event, data, msg) {
 console.log(data.id);
 console.log(data.index);
 console.log(data.file);
 console.log(data.reader);
 console.log(data.files);
 // get message
 alert(msg);
});
//批量同步上传成功结果处理
$("#uploadfile").on("filebatchuploadsuccess", function (event, data, previewId, index) {
 console.log(data.id);
 console.log(data.index);
 console.log(data.file);
 console.log(data.reader);
 console.log(data.files);
 var obj = data.response;
 alert(JSON.stringify(data.success));
});
//上传前
$('#uploadfile').on('filepreupload', function(event, data, previewId, index) {
 var form = data.form, files = data.files, extra = data.extra,
 response = data.response, reader = data.reader;
 console.log('File pre upload triggered');
});
</script>

<script type="text/javascript">
      
  

    //formdata.append('name','234342343243');

    $('#submit').click([],function(){

        var formdata = new FormData(document.getElementById("send"));


      $('.progress').css('display','');

      $.ajax({

         url:"{{route('goods_do_add')}}",   
         type:"post",
         data:formdata,
         processData:false,
         contentType:false,
         xhr:function(){

          var xhr = $.ajaxSettings.xhr();

          if(xhr.upload){

          xhr.upload.addEventListener('progress',function(e){

          //console.log(e);

          var progressRate=(e.loaded/e.total) *100+ '%';

          $('#progress').css('width',progressRate);  
          },false)
          return xhr;
        }
    },


         success:function(data){
          
          alert('上传成功,请勿重复上传');

          $('#progress').css('width','0%');  
          $('.progress').css('display','none');
          $('input').val('');
          
          //console.log(data);
        
         },

         error:function(e){

          console.log(e);
          
         }

      });
        
     
    })



</script>



@endsection


