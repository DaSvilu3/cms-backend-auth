@extends(config('cms-backend-auth.extends'))
@section(config('cms-backend-auth.contentArea'))
<div class="row">
    <h4 class="header-title m-t-0 m-b-30">{{trans('cms-backend-auth.create-user')}}</h4>

    <ul class="breadcrumb">
        <li><a href="{{url(config('cms-backend-auth.dashboardLink'))}}">{{trans('cms-backend-auth.home')}}</a></li>
        <li><a href="{{url(config('cms-backend-auth.prefix').'/users')}}">{{trans('cms-backend-auth.user')}}</a></li>

        <li>{{trans('cms-backend-auth.create')}}</li>

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
                    <form class="form-horizontal" role="form" method="post">
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('cms-backend-auth.name')}}</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" placeholder="{{trans('cms-backend-auth.enter-user-name')}}" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('cms-backend-auth.email')}}</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" placeholder="{{trans('cms-backend-auth.enter-user-email')}}" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('cms-backend-auth.role')}}</label>
                            <div class="col-md-10">
                                <select class="form-control" name="role_id" required="">
                                    <option value="">{{trans('cms-backend-auth.choose-role')}}</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" >{{trans('cms-backend-auth.password')}}</label>
                            <div class="col-md-10">
                                <input type="password" name="password" class="form-control" placeholder="{{trans('cms-backend-auth.enter-password')}}" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" >{{trans('cms-backend-auth.image')}}</label>
                            <div class="col-md-10">
                                <?= ImageManager::selector('images[]', [], false) ?>    </div>
                        </div>
                        {{ csrf_field() }}
                        <button class="btn btn-purple waves-effect m-b-5" type="submit">{{trans('cms-backend-auth.save')}}</button>






                    </form>
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