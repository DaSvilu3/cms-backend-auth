<?php

namespace MediaSci\CmsBackendAuth\Http\Controllers\CmsBackendAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MediaSci\CmsBackendAuth\Models\CmsBackendUser;
use MediaSci\CmsBackendAuth\Models\CmsBackendUsersToken;

/**
 * Description of AuthController
 *
 * @author Ahmed Sadany
 */
class ProfileController extends Controller {

    function UpdateProfile(Request $request) {
        if ($request->has('name')) {
            $rules = [
                'name' => 'required',
                'images' => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                \Session::put('errors', 'plz fill all fields');

                return redirect()->back();
            }
            $user = CmsBackendUser::find(\Session::get('backendUser')->id);
            $user->name = $request->get('name');
            $user->image_id = $request->get('images')[0];
            $user->save();
            \Session::put('success', 'Successfully updated');
            return redirect()->back();
        }
        return view('CmsBackendAuth.profile.edit-profile');
    }

    function UpdatePassword(Request $request) {
        if ($request->has('password')) {
            $rules = [
                'password' => 'required',
                'confirm-password' => 'required|same:password',
            ];
            $validator = \Validator::make($request->all(), $rules);
           
            if ($validator->fails()) {
                \Session::put('errors', 'pleease sure that password and confirm password are the same');

                return redirect()->back();
            }
              $user = CmsBackendUser::find(\Session::get('backendUser')->id);
              $user->password= md5($request->get('password'));
              $user->save();
               \Session::put('success', 'Password Successfully updated');
            return redirect()->back();
        }
        return view('CmsBackendAuth.profile.edit-password');
    }

}
