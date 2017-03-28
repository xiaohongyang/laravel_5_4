<?php

namespace App\Http\Controllers\UserCenter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseUserController extends Controller
{
    //

    public static function getViewPath($catchController=true) {

        $path = \Route::current()->getActionName();
        list($controller, $action) = explode('@', $path);

        if ($catchController) {

            list($namespacePre, $controller) = explode('Controllers', $controller);

            $controllerPathArr = explode('\\', $controller);
            $controller = array_pop($controllerPathArr);
            $preArr = [];
            if(is_array($controllerPathArr) && count($controllerPathArr)) {
                foreach ($controllerPathArr as $pre) {
                    if (strlen(trim($pre))) {
                        $preArr[] = $pre;
                    }
                }
            }

            $controller = str_replace("Controller", '', $controller);
            $controller = snake_case($controller);
            $action  = $controller . '.' . $action;

            if(count($preArr)) {
                $preString = join('.', $preArr);
                $preString = snake_case($preString);
                $action = $preString . '.' . $action;
            }
        }
        //echo $action;exit;
        return $action;
    }

    public static function getXhyView($data=null, $mergeData=null){
        if(!is_null($mergeData)) {

            return view(self::getViewPath(), $data, $mergeData);
        } else if (!is_null($data)) {

            return view(self::getViewPath(), $data);
        } else {
            return view(self::getViewPath());
        }
    }

}
