<?php

namespace MediaSci\CmsBackendAuth\Http\Controllers\CmsBackendAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MediaSci\CmsBackendAuth\Models\CmsBackendPage;


class PagesController extends Controller {

    function index() {
        $data['pages'] = CmsBackendPage::orderBy('id', 'desc')->paginate('20');
        return view('CmsBackendAuth.pages.index', $data);
    }

    function create(Request $request) {
        if ($request->has('name')) {
            $rules = [
                'name' => 'required',
                'link' => 'required',
                'module' => 'required',
                'action' => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                \Session::put('errors', 'plz fill all fields');

                return redirect()->back();
            }
            $page = new CmsBackendPage();
            $page->name = $request->get('name');
            $page->link = $request->get('link');
            $page->module = $request->get('module');
            $page->action = $request->get('action');
            $page->save();
            \Session::put('success', 'Successfully Added');
            return redirect()->back();
        }
        return view('CmsBackendAuth.pages.create');
    }

    function update(Request $request, $id) {
        $data['page'] = $page = CmsBackendPage::find($id);
//        dd($page);
        if (!is_object($page)) {
            abort(404);
        }
        if ($request->has('name')) {
            $rules = [
                'name' => 'required',
                'link' => 'required',
                'module' => 'required',
                'action' => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                \Session::put('errors', 'plz fill all fields');

                return redirect()->back();
            }

            $page->name = $request->get('name');
            $page->link = $request->get('link');
            $page->module = $request->get('module');
            $page->action = $request->get('action');
            $page->save();
            \Session::put('success', 'Successfully updated');
            return redirect(config('cms-backend-auth.prefix').'/pages');
        }
        return view('CmsBackendAuth.pages.update', $data);
    }

    function delete($id) {
        $data['page'] = $page = CmsBackendPage::find($id);
        if (!is_object($page)) {
            abort(404);
        }
        $page->delete();
        \Session::put('success', 'Successfully Deleted');
        return redirect(config('cms-backend-auth.prefix').'/pages');
    }

    function generate(Request $request) {
        if ($request->has('delete_old')) {
            CmsBackendPage::where('id', '>', 0)->delete();
        }
        $routeCollection = \Illuminate\Support\Facades\Route::getRoutes();

        $da = [];
        //dd($routeCollection);
        //echo "<pre/>";
        foreach ($routeCollection as $route) {

            if (key_exists('middleware', $route->action) && $this->checkMiddleware($route->action['middleware'])) {
                if (key_exists('controller', $route->action)) {
                    $page_data = $this->getControllerAndFunctionFromNameSpace($route->action['controller']);
                } else {
                    $page_data['controller'] = null;
                    $page_data['function'] = null;
                }

                if ($route->compiled != null) {
                    $insert_data['regx_link'] = $route->compiled->getRegex();
                } else {
                    //$da[]=$route;
                    //$insert_data['regx_link']=NULL;
                    $insert_data['regx_link'] = $this->gernrateRegxFromUri($route->uri);
                }

                $insert_data['link'] = $route->uri;
                $insert_data['name'] = ucfirst($page_data['controller']);
                $insert_data['module'] = $page_data['controller'];
                $insert_data['action'] = $page_data['function'];
                CmsBackendPage::insert($insert_data);
                //$da[]=$insert_data;
            }
        }
    }

    private function gernrateRegxFromUri($uri) {
        $regx = '#^/';
        $uri = str_replace('{', '(?P<', $uri);
        $uri = str_replace('}', '>[^/]++)', $uri);
        $regx .= $uri . '$#s';
        return $regx;
    }

    private function checkMiddleware($middlewares) {
        foreach ($middlewares as $middleware) {
            if (in_array($middleware, ['backend'])) {
                return true;
            }
        }
        return false;
    }

    private function getControllerAndFunctionFromNameSpace($namespace) {
        $segments = explode('\\', $namespace);
        $con_fun = end($segments);
        $con_fun_seg = explode('@', $con_fun);
        $result['controller'] = strtolower(str_replace('Controller', '', $con_fun_seg[0]));
        $result['function'] = strtolower(str_replace(['any', 'post', 'get'], '', $con_fun_seg[1]));
        return $result;
    }

}
