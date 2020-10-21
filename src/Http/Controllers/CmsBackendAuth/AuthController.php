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
class AuthController extends Controller {

    //put your code here

    function login(Request $request) {
        if ($request->filled('email') && $request->filled('password')) {
            $user = CmsBackendUser::where('password', md5($request->password))->where('email', $request->email)->first();
            if (is_object($user)) {
                if ($user->is_active == false) {
                    session()->flash('error', 'Your account is blocked');
                    return redirect('./'.config('cms-backend-auth.prefix').'/login');
                }
                \Session::put('backendUser', $user);
              
                return redirect(config('cms-backend-auth.dashboardLink'));
            } else {
                session()->flash('error', 'Wrong user or password');
                return redirect('./'.config('cms-backend-auth.prefix').'/login');
            }
        }
       
        return view('CmsBackendAuth.auth.login');
    }

    function logOut() {
        $user = \Session::get('user');
        $cookieUser = CmsBackendUsersToken::where('id', \Cookie::get('backendUser'))->where('ip', $_SERVER['REMOTE_ADDR'])->delete();
        \Session::forget('backendUser');
        \Cookie::forget('backendUser');
        return redirect('./'.config('cms-backend-auth.prefix').'/login');
    }

    function forgetPassword(Request $request) {

        if ($request->filled('email')) {
            $user = CmsBackendUser::where('email', $request->email)->first();
            if (!is_object($user)) {
                session()->flash('error', 'This User Not Found');
                return redirect('./'.config('cms-backend-auth.prefix').'/forget-password');
            }
            $data['user'] = $user;
            $resetString = $this->generateRandomString();
            $user->reset_password_token = $resetString;
            $user->reset_password_at = \Carbon\Carbon::now();
            $user->save();
            $message = view('CmsBackendAuth.auth.emails.forgot-password', $data)->render();

            $this->sentEmail($request->email, $resetString, $message);
            session()->flash('error', 'the reset code will be available for 4 hours');
        }
        return view('CmsBackendAuth.auth.forgetPassword');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = time();
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function sentEmail($to, $message) {

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: ' . config('cms-backend-auth.fromEmail') . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        mail($to, config('cms-backend-auth.forgetPasswordTitle'), $message);
    }

    function resetPassword(Request $request, $token, $email) {

        $finishtime = \Carbon\Carbon::now()->addHours(4);
        $user = CmsBackendUser::where('reset_password_token', $token)->where('email', $email)->where('reset_password_at', '<=', $finishtime)
                        ->where('is_active', true)->first();
        if (is_object($user)) {
            if ($request->filled('password')) {
                $user->password = md5($request->password);
                $user->save();
                session()->flash('error', 'Your Password Changes Try login Now');
                return redirect('./'.config('cms-backend-auth.prefix').'/login');
            }
        } else {
            session()->flash('error', 'This User Not Found or Token finished');
            return redirect('./'.config('cms-backend-auth.prefix').'/forget-password');
        }
        return view('CmsBackendAuth.auth.resetPassword');
    }
    function lockscreen(){
        return view('CmsBackendAuth.auth.lockscreen');
    }
}
