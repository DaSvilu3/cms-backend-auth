@extends('backend.layout')
@section('title','Settings Data')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Settings Data</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{url('backend/dashboard')}}">ألرئيسيه</a>
                    </li>
                    
                    <li class="breadcrumb-item">المديرين
                    </li>

                </ol>
            </div>
        </div>
    </div>
     <div class="content-header-right col-md-6 col-12">
        <div class="media width-250 float-right">
                <div class="input-group-btn">
               
                    <a href="{{url('backend/backend_users/create')}}">اضافه مدير</a>
                 
            </div>    </div>
    </div>
<div class="content-body" ><!-- Default styling start -->
    <div class="row" id="header-styling"  style="">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Settings Data</h4>


                </div>
                <div class="card-content collapse show">

                    @if(\Session::get('errors')!==null)


                    <div class="alert alert-danger">
                        {{\Session::get('errors')}}
                    </div>

                    @endif
                    @if(\Session::get('success')!==null)


                    <div class="alert alert-success">
                        {{\Session::get('success')}}
                    </div>

                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('cms-backend-auth.image')}}</th>
                                <th>{{trans('cms-backend-auth.name')}}</th>
                                <th>{{trans('cms-backend-auth.email')}}</th>
                                <th>{{trans('cms-backend-auth.setting')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key=>$user)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td><img class="img-circle" src="{{ImageManager::getImagePath($user->image_id,'small')}}" height="70px" width="70px"></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td><a href="{{url(config('cms-backend-auth.prefix').'/users/update/'.$user->id)}}" class=" btn btn-xs btn-outline btn-success" ><i class="glyphicon glyphicon-pencil"></i> {{trans('cms-backend-auth.update')}}</a>
                                    <a href="{{url(config('cms-backend-auth.prefix').'/users/delete/'.$user->id)}}" onclick="return confirm('are you sure you want delete this page')" class=" btn btn-xs btn-outline btn-danger" ><i class="glyphicon glyphicon-trash"></i> {{trans('cms-backend-auth.delete')}}</a>
                                    <a href="{{url(config('cms-backend-auth.prefix').'/users/active/'.$user->id)}}"  class=" btn btn-xs btn-outline @if($user->is_active==1) btn-success" ><i class="glyphicon glyphicon-thumbs-up"></i> {{trans('cms-backend-auth.active')}}@else  btn-danger" ><i class="glyphicon glyphicon-thumbs-down"></i> {{trans('cms-backend-auth.deactive')}} @endif</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                         <?php
                    $search_query = \Illuminate\Support\Facades\Input::except('page');
                    $users->appends($search_query);
                    ?>
                    {!! $users->links()!!}
             </div>
            </div>
        </div>
    </div>


</div>
           
                   
               
</div>
<?php
\Session::forget('errors');
\Session::forget('success');
?>
@endsection