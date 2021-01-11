<?php

use App\Exceptions\NotFoundException;
use Router\Router;

require '../vendor/autoload.php'; //Require automatique

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR); //Chercher une vue
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR); //Chercher un script
define('DB_NAME', 'cms'); //Definir la BDD
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PWD', '');

$url = isset($_GET['url']) ? $_GET['url'] : '/';

$router = new Router($url);

$router->get('/', 'App\Controllers\BlogController@welcome'); //Racine du site, le / renvoie l'index
$router->get('/posts', 'App\Controllers\BlogController@index'); //Accéder aux posts
$router->get('/posts/:id', 'App\Controllers\BlogController@show'); //acceder aux posts via l'id
$router->get('/tags/:id', 'App\Controllers\BlogController@tag'); //Route pour voir les tags

$router->get('/login', 'App\Controllers\UserController@login'); //Route pour se logger
$router->post('/login', 'App\Controllers\UserController@loginPost'); //Route pour accéder aux posts
$router->get('/logout', 'App\Controllers\UserController@logout'); //Route pour se délogger

$router->get('/admin/posts', 'App\Controllers\admin\PostsController@index'); // Route pour la panel d'articles
$router->get('/admin/posts/create', 'App\Controllers\admin\PostsController@create');//accéder au formulaire
$router->post('/admin/posts/create', 'App\Controllers\admin\PostsController@createPost'); //Envoyer les données
$router->post('/admin/posts/delete/:id', 'App\Controllers\admin\PostsController@destroy'); //supprimer un article en post pour sécurisé les données
$router->get('/admin/posts/edit/:id', 'App\Controllers\admin\PostsController@edit'); //Route pour modifier un article
$router->post('/admin/posts/edit/:id', 'App\Controllers\admin\PostsController@update'); //Enregistrer les modifications

try{ //Afficher une view ou la page 404
    $router->run();
} catch (NotFoundException $e) {
    echo $e->error404();
}