@extends(config("cms-backend-auth.extends"))
@section(config("cms-backend-auth.contentArea"))
<div class="row">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <button class="button-menu-mobile open-left">
                <i class="zmdi zmdi-menu"></i>
            </button>
        </li>
        <li>
            <a href="{{url(config('cms-backend-auth.extends'))}}"><h4 class="page-title">Dashboard</h4></a>
        </li>
    </ul>



    <div class="col-sm-12">
        <h4 class="header-title m-t-0 m-b-30">{{trans('cms-backend-auth.update-profile')}}</h4>
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
            <div class="col-lg-6">
                <form class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('cms-backend-auth.name')}}</label>
                        <div class="col-md-10">
                            <input type="text" name="name" required="" value="{{\Session('backendUser')->name}}" class="form-control" value="{{trans('cms-backend-auth.name')}}">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('cms-backend-auth.image')}}</label>
                        <div class="col-md-10">
                            <?= ImageManager::selector('images[]', [\Session('backendUser')->image_id], false) ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" class="btn btn-primary" value="{{trans('cms-backend-auth.save')}}"/>
                    </div>


                </form>
            </div>
        </div>
    </div>
    @endsection
   <?php 
   \Session::forget('errors');
   \Session::forget('success');
           ?>