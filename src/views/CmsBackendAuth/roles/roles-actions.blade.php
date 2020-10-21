@extends(config('cms-backend-auth.extends'))
@section(config('cms-backend-auth.contentArea'))
<div class="row">
    <h4 class="header-title m-t-0 m-b-30">{{$role->name}}</h4>
    <ul class="breadcrumb">
        <li><a href="{{url(config('cms-backend-auth.contentArea'))}}">{{trans('cms-backend-auth.home')}}</a></li>
        <li><a href="{{url(config('cms-backend-auth.prefix').'/roles')}}">{{trans('cms-backend-auth.roles')}}</a></li>

        <li>{{$role->name}}</li>

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
                        <div class="col-md-4">
                            <input name="actions[]" type="checkbox" id="checkall" >
                            <label class="control-label">Select All</label>
                        </div>
                </div>
                <div class="form-group">
                    @foreach($pages as $page)
                    <div class="col-sm-4">

                        <input type="checkbox" value="{{$page->id}}"  @if(in_array($page->id,$actions)) checked='checked' @endif name="actions[]" >
                               <label class="control-label">{{$page->module}}.{{$page->action}}</label>

                    </div>
                    @endforeach
                </div>

                {{ csrf_field() }}
                <button class="btn btn-purple waves-effect m-b-5" type="submit">{{trans('cms-backend-auth.save')}}</button>






                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#checkall").change(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
<?php
\Session::forget('errors');
\Session::forget('success');
?>
@endsection