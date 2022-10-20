<?php

class Router{
    protected $routes = [];
    protected $params = [];

    /*
    //dla stałego URL bez regex:
    public function add($route, $params){
        $this->routes[$route] = $params;
    }*/

    //teraz z uzyciem regex:
    public function add($route, $params = []){
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = '/^'.$route.'$/i';
        $this->routes[$route] = $params;
    }

    public function getRoutes(){
        return $this->routes;
    } 

    //dla stałego URL bez regex:
    /*public function match($url){
        foreach($this->routes as $route=>$params){
            if($url == $route){
                $this->params = $params;
                return true;
            }
        }
        return false;
    }*/

    //teraz z uzyciem regex:
    public function match($url){
        foreach($this->routes as $route=>$params){
            if(preg_match($route, $url, $matches)){
                foreach($matches as $key=>$match){
                    if(is_string($key)){
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }  
        }
        return false;
    }


    public function getParams(){
        return $this->params;
    }
}


?>