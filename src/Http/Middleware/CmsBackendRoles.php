<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\models\CmsBackendPage;
use App\Http\models\CmsBackendRoleAction;

class CmsBackendRoles {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $action = $this->getAction(); 
       
           if($this->checkAction($action) == false)
        {
            return redirect(config('cms-backend-auth.prefix').'/lockedscreen');
        }

        return $next($request);
    }

    function getAction() {
        $action = app('request')->route()->getAction();
        $controller = class_basename($action['controller']);
        $route = explode("@", $controller);
        $controller = strtolower(str_replace('Controller', '', $route[0]));
        $action = strtolower(str_replace(['any', 'post', 'get'], '', $route[1]));
        return['controller' => $controller, 'action' => $action];
    }

    function checkAction($action) {
        if (\Session('backendUser')->role->is_super == 1)
            return TRUE;
        $pageAction = CmsBackendPage::where('module', $action['controller'])->where('action', $action['action'])->first();
        if (!$pageAction)
            return false;
        $actionRole = CmsBackendRoleAction::where('role_id', \Session('backendUser')->role_id)->where('action_id', $pageAction->id)->count();
        if ($actionRole == 0)
            return false;

        return true;
    }

}
