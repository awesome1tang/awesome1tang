@extends('layout.admins');

@section('title','后台首页')

@section('content')

  <div class="form-group"> 
  @if (count($errors) > 0) 
  <div class="alert alert-danger">
  <ul style="color:red;">
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li> @endforeach </ul>

  </div> @endif
  </div>

<form id="send">
  <div class="form-group">
    <label for="exampleInputEmail1">广告名字</label>
    <input type="text" name="advert"  class="form-control" style="width:40%;" id="advert" placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">广告url</label>
    <div class="input-group">
    <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
    <input type="url" name="url"  class="form-control" style="width:40%;"  id="url" placeholder="url">
    </div>
  </div>
  <div class="form-group">
    <label for="exampleInputFile">上传图片</label>
     <input id="uploadfile" type="file" class="file" name="pic" />
    <p class="help-block">Example block-level help text here.</p>

    <div class="progress" style="display:none" >
  
  <div class="progress-bar progress-bar-success"  id="progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" >

  </div>
</div>


  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  
</form>
<button  class="btn btn-default" id="submit">Submit</button>
<script type="text/javascript">
      
  

    //formdata.append('name','234342343243');

    $('#submit').click([],function(){

        var formdata = new FormData(document.getElementById("send"));
    
       /*var advert =formdata.get('advert');
  
       var url = $('#url').val();
  
        console.log(advert);

        console.log(url);*/

      $('.progress').css('display','');

      $.ajax({

         url:"{{route('advert_get')}}",   
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

          alert("错误!!");
          
         }

      });
        
     
    })



</script>

<script>
  
    $("#uploadfile").fileinput({
 language: 'en', //设置语言
 uploadUrl: "{{route('advert_get')}}", //上传的地址(访问接口地址)
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
 maxFileCount: 1, //表示允许同时上传的最大文件个数
 enctype: 'multipart/form-data',
 validateInitialCount:true,
 previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
 msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
});
//异步上传返回错误结果处理
$('#uploadfile').on('fileerror', function(event, data, msg) {
// console.log(data.id);
 //console.log(data.index);
 //console.log(data.file);
// console.log(data.reader);
 //console.log(data.files);
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
 //console.log(data.id);
 //console.log(data.index);
 //console.log(data.file);
 //console.log(data.reader);
 //console.log(data.files);
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


@endsection