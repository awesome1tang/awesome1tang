@extends('layout.admins');

@section('title','后台首页')

@section('content')
      

    @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-  hidden="true"></span>
     <span class="sr-only">Error:</span>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li> @endforeach </ul>
    </div>

    @endif
 
    <form action="{{route('category_do_add')}}" method="post" >
    <div class="form-group">
    <label for="exampleInputEmail1">分类名</label>
    <input type="text" name="name"  class="form-control" style="width:40%;" id="advert" placeholder="name">
    <input type="text" style="display:none" name="status"  class="form-control" value="0">
    </div>
    

    <label for="exampleInputEmail1">所属分类</label>

    
    <div class="form-group">
    <select  name="pid" class="form-control" style="width:300px">
       @foreach($res as $k=>$v)
        <option value="{{$v->id}}">{{$v->name}}</option>
       @endforeach
    </select>
    </div>

    <div class="form-group">
    <button  class="btn btn-info" type="submit">确定提交</button>
    </div>

  
    </form> 




@endsection