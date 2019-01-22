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
    <input type="url" name="url"  class="form-control" style="width:40%;"  id="url" placeholder="url">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">上传图片</label>
    <input type="file" id="exampleInputFile" name="pic">
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
          
          console.log(data);
        
         },

         error:function(e){

          alert("错误!!");
          
         }

      });
        
     
    })



</script>


@endsection