@extends(config('cms-backend-auth.extends'))
@section(config('cms-backend-auth.contentArea'))
<div class="row">
    <h4 class="header-title m-t-0 m-b-30">{{trans('cms-backend-auth.create-role')}}</h4>
    <ul class="breadcrumb">
        <li><a href="{{url(config('cms-backend-auth.dashboardLink'))}}">{{trans('cms-backend-auth.home')}}</a></li>
        <li><a href="{{url(config('cms-backend-auth.prefix').'/roles')}}">{{trans('cms-backend-auth.roles')}}</a></li>

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
                                <input type="text" class="form-control" name="name" placeholder="{{trans('cms-backend-auth.enter-role')}}" required="">
                            </div>
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