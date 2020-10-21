<?php

namespace MediaSci\CmsBackendAuth\Http\Controllers\CmsBackendAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MediaSci\CmsBackendAuth\Models\CmsBackendUser;
use MediaSci\CmsBackendAuth\Models\CmsBackendPage;
use MediaSci\CmsBackendAuth\Models\CmsBackendRole;

class UsersController extends Controller {

    function index() {
        $data['users'] = CmsBackendUser::orderBy('name', 'asc')->paginate('10');
        return view('CmsBackendAuth.users.index', $data);
    }

    function create(Request $request) {
        $data['roles'] = CmsBackendRole::all();
        if ($request->has('name')) {
            $rules = [
                'name' => 'required',
                'email' => 'required|unique:cms_backend_users',
                'password' => 'required',
                'images' => 'required'
            ];
            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                \Session::put('errors', "this Email already Exiest ");

                return redirect()->back();
            }
            $user = new CmsBackendUser();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = md5($request->get('password'));
            $user->image_id = $request->images[0];
            $user->role_id = $request->get('role_id');
            $user->save();
            \Session::put('success', "Successfully Added");
            return redirect(config('cms-backend-auth.prefix').'/backend_users');
        }
        return view('CmsBackendAuth.users.create', $data);
    }

    function update(Request $request, $id) {
        $data['user'] = $user = CmsBackendUser::find($id);
        $data['roles'] = CmsBackendRole::all();
        if (!is_object($user)) {
            abort(404);
        }
        if ($request->has('name')) {
            $rules = [
                'name' => 'required',
              
                'images' => 'required'
            ];
            if ($user->email != $request->get('email')) {
               
                $rules = [
                    'email' => 'required|unique:cms_backend_users',
                ];
            }
            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                \Session::put('errors', "this Email already Exist ");

                return redirect()->back();
            }
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            if ($request->has('password')) {
                $user->password = md5($request->get('password'));
            }
            $user->image_id = $request->images[0];
            $user->role_id = $request->get('role_id');
            $user->save();
            \Session::put('success', "Successfully Edited");
            return redirect(config('cms-backend-auth.prefix').'/backend_users');
        }
        return view('CmsBackendAuth.users.update', $data);
    }

    function delete($id) {
        $user = CmsBackendUser::find($id);
        if (!is_object($user)) {
            abort(404);
        }
        $user->delete();
        \Session::put('success', "Successfully Deleted");
        return redirect('cms-backend-auth/backend_users');
    }

    function active($id) {
        $user = CmsBackendUser::find($id);
        if (!is_object($user)) {
            abort(404);
        }
        if ($user->is_active == 0) {
            $user->is_active = 1;
            $user->save();
            \Session::put('success', "Successfully actived");
            return redirect(config('cms-backend-auth.prefix').'/backend_users');
        } else {
            $user->is_active = 0;
            $user->save();
            \Session::put('success', "Successfully Deleted");
            return redirect(config('cms-backend-auth.prefix').'/backend_users');
        }
    }

}
