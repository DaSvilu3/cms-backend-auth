@extends(config('cms-backend-auth.extends'))
@section(config('cms-backend-auth.contentArea'))
<div class="row">
    <h4 class="header-title m-t-0 m-b-30">{{trans('cms-backend-auth.create-page')}}</h4>
    <ul class="breadcrumb">
        <li><a href="{{url(config('cms-backend-auth.dashboardLink'))}}">{{trans('cms-backend-auth.home')}}</a></li>
        <li><a href="{{url(config('cms-backend-auth.prefix').'/pages')}}">{{trans('cms-backend-auth.pages')}}</a></li>
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
                            <label class="col-md-2 control-label">{{trans('cms-backend-auth.link')}}</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="link" placeholder="{{trans('cms-backend-auth.enter-link')}}" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('cms-backend-auth.module')}}</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="module" placeholder="{{trans('cms-backend-auth.enter-module')}}" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('cms-backend-auth.action')}}</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="action" placeholder="{{trans('cms-backend-auth.enter-action')}}" required="">
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