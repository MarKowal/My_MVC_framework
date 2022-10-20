<?php

//Front controller:

//echo 'Requested URL = '.$_SERVER['QUERY_STRING']."<br>";

require '../Core/Router.php';

$router = new Router();

//echo get_class($router);

$router->add('', ['controller'=>'Home', 'action'=>'index']);
$router->add('posts', ['controller'=>'Posts', 'action'=>'index']);
//$router->add('posts/new', ['controller'=>'Posts', 'action'=>'new']);
//$router->add('blog', ['controller'=>'Blog', 'action'=>'index']);
//$router->add('products/list', ['controller'=>'Products', 'action'=>'list']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');


echo '<pre>';
echo var_dump($router->getRoutes());
echo '</pre>';

//Match the requested route:
$url = $_SERVER['QUERY_STRING'];
if ($router->match($url)){
    echo '<pre>';
    echo var_dump($router->getParams());
    echo '</pre>';
} else {
    echo 'No route found for URL: '.$url;
}

?>