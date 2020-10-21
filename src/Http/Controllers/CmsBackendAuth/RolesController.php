<?php

namespace MediaSci\CmsBackendAuth\Http\Controllers\CmsBackendAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MediaSci\CmsBackendAuth\Models\CmsBackendRole;
use MediaSci\CmsBackendAuth\Models\CmsBackendRoleAction;
use MediaSci\CmsBackendAuth\Models\CmsBackendPage;

/**
 * Description of AuthController
 *
 * @author Ahmed Sadany
 */
class RolesController extends Controller {

    function index() {
        $data['roles'] = CmsBackendRole::all();
        return view('CmsBackendAuth.roles.index', $data);
    }

    function create(Request $request) {
        if ($request->has('name')) {
            $rules = [
                'name' => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                \Session::put('errors', "please Fill all fields");

                return redirect()->back();
            }
            $role = new CmsBackendRole();
            $role->name = $request->get('name');
            $role->is_super=0;
            $role->save();
            \Session::put('success', "Successfully Added");
            return redirect(config('cms-backend-auth.prefix').'/roles');
        }
        return view('CmsBackendAuth.roles.create');
    }

    function update(Request $request, $id) {
        $data['role'] = $role = CmsBackendRole::find($id);
        if (!is_object($role)) {
            abort(404);
        }
        if ($request->has('name')) {
            $rules = [
                'name' => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                \Session::put('errors', "please Fill all fields");

                return redirect()->back();
            }
            $role->name = $request->get('name');
            $role->save();
            \Session::put('success', "Successfully Updated");
            return redirect(config('cms-backend-auth.prefix').'/roles');
        }
        return view('CmsBackendAuth.roles.update', $data);
    }

    function delete($id) {
        $data['role'] = $role = CmsBackendRole::find($id);
        if (!is_object($role)) {
            abort(404);
        }
        $role->delete();
        \Session::put('success', "Successfully Deleted");
        return redirect(config('cms-backend-auth.prefix').'/roles');
    }

    function actions(Request $request, $id) {
        $data['role'] = CmsBackendRole::find($id);

        $data['actions'] = CmsBackendRoleAction::where('role_id',$id)->pluck('action_id')->toArray();
        $data['pages'] = CmsBackendPage::all();
     
        if ($request->has('actions')) {
            CmsBackendRoleAction::where('role_id',$id)->delete();
//            dd($request->get('actions'));
            foreach ($request->get('actions') as $action) {
                if(is_numeric($action)){
                $roleAction = new CmsBackendRoleAction();
                $roleAction->action_id = $action;
                $roleAction->role_id = $id;
                $roleAction->save();
            }
            }
            \Session::put('success', "Successfully added");
            return redirect(config('cms-backend-auth.prefix').'/roles');
        }
        return view('CmsBackendAuth.roles.roles-actions', $data);
    }

}
