<?php
session_start();
require 'vendor/autoload.php';
require 'vendor/altorouter/altorouter/AltoRouter.php';

$router = new AltoRouter();

$router->setBasePath('/mangatheque');

//USER ROUTES
$router->map( 'GET', '/', 'ControllerPage#homePage', 'homepage');
$router->map( 'GET', '/user/[i:id]', 'ControllerUser#oneUserById', 'userpage');
$router->map( 'GET', '/user/update/[i:id]', 'ControllerUser#updateUserById', 'userupdate');
$router->map( 'POST', '/user/update/[i:id]', 'ControllerUser#updateUserById', 'userupdated');
$router->map( 'GET', '/user/delete/[i:id]', 'ControllerUser#deleteUserById', 'userdelete');

//MANGAS ROUTES
$router->map( 'GET', '/mangas', 'ControllerManga#mangaList', 'mangalist');
$router->map( 'GET', '/mangas/create', 'ControllerManga#mangaCreate', 'mangacreate');
$router->map( 'POST', '/mangas/store', 'ControllerManga#mangaStore', 'mangastore');
$router->map( 'GET', '/mangas/[i:id]', 'ControllerManga#oneMangaById', 'mangapage');
$router->map( 'GET', '/mangas/[i:id]/edit', 'ControllerManga#updateMangaById', 'mangaupdate');
$router->map( 'POST', '/mangas/[i:id]/edit', 'ControllerManga#updateMangaById', 'mangaupdated');

//LOGIN REGISTER LOGOUT
$router->map( 'GET|POST', '/register', 'ControllerAuth#register', 'register');
$router->map( 'GET|POST', '/login', 'ControllerAuth#login', 'login');
$router->map( 'GET', '/logout', 'ControllerAuth#logout', 'logout');

$match = $router->match();

if(is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller();

    if(is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
} else {
    http_response_code(404);
}