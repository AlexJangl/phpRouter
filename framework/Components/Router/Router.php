<?php


namespace framework\Components\Router;

class Router implements RouteInterface
{
    protected $controller;
    protected $action;
    protected $args;

    public function route(): callable
    {
        $url = $_SERVER['REQUEST_URI'];
        $this->parseUrl($url);
        $controllerName = 'app\Controllers\\' . ucfirst($this->controller) . 'Controller';
        $this->controller = new $controllerName();

        return call_user_func([$this->controller, $this->action], $args ?? []);
    }

    protected function parseUrl($url)
    {
        $data = explode('/', $url);
        $this->controller = $data[1];
        $this->action = $data[2];
        $args = array_slice($data, 3);
        for($i = 0; $i < count($args); $i=$i+2)
        {
            if($i+1 < count($args)){
                $this->args[$args[$i]] = $args[$i+1];
            }else
            {
                $this->args[$args[$i]] = false;
            }
        }
    }
}