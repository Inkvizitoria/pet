<?php


class Router
{
    function run(){
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $route = explode('/', $url);
        $params = explode('?', $route[array_key_last($route)]);
        $route[array_key_last($route)] = $params[0];
        $url = trim($route[0], '/');
        if(array_key_exists(1, $route)){
            $function = trim($route[1], '/');
        }
        if (file_exists(DIR_CONTROLLER . trim($route[0], '/') . '.php')){
            if(count($route) >= 2){
                require_once DIR_CONTROLLER . $url . '.php';
                $modelName = $route[0]. "Model";
                require_once DIR_MODEL . $modelName . ".php";
                $url = 'API\Controller\\'.$url;
                $controller = new $url;
                if(method_exists($controller, $function)) {
                    $controller->$function();
                } else {
                    $this->error();
                }
            } else {
                require_once DIR_CONTROLLER . $url . '.php';
                $url = 'API\Controller\\'.$url;
                $controller = new $url;
                $controller->default();
            }
        }
        else {
            $this->error();
        }
    }

    private function error (){
        require_once DIR_CONTROLLER . "Error/Errors.php";
        $url = 'API\Controller\Error\Errors';
        $controller = new $url;
        $controller->not_found();
    }
}
