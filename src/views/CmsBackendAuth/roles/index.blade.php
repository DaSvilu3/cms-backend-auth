@extends(config('cms-backend-auth.extends'))
@section(config('cms-backend-auth.contentArea'))
<div class="row">
    <h4 class="header-title m-t-0 m-b-30">{{trans('cms-backend-auth.roles')}}</h4>
    <ul class="breadcrumb">
        <li><a href="{{url(config('cms-backend-auth.dashboardLink'))}}">{{trans('cms-backend-auth.home')}}</a></li>
        <li>{{trans('cms-backend-auth.roles')}}</li>
        <li>       <a href="{{url(config('cms-backend-auth.prefix').'/roles/create')}}" class="btn btn-primary pull-right">{{trans('cms-backend-auth.create-role')}}</a> 
        </li>

    </ul>
    <div class="panel">
        <div class="panel-body">
            <div class="col-sm-12">
                <div class="row">
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
                                <th>{{trans('cms-backend-auth.name')}}</th>
                                <th>{{trans('cms-backend-auth.setting')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $key=>$role)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$role->name}}</td>
                                <td><a href="{{url(config('cms-backend-auth.prefix').'/roles/update/'.$role->id)}}" class=" btn btn-xs btn-outline btn-success" ><i class="glyphicon glyphicon-pencil"></i> {{trans('cms-backend-auth.update')}}</a>
                                    <a href="{{url(config('cms-backend-auth.prefix').'/roles/delete/'.$role->id)}}" onclick="return confirm('are you sure you want delete this page')" class=" btn btn-xs btn-outline btn-danger" ><i class="glyphicon glyphicon-trash"></i> {{trans('cms-backend-auth.delete')}}</a>
                                    <a href="{{url(config('cms-backend-auth.prefix').'/roles/actions/'.$role->id)}}"  class=" btn btn-xs btn-outline btn-primary" ><i class="glyphicon glyphicon-eye-open"></i> {{trans('cms-backend-auth.roles-actions')}}</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
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