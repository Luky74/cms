<?php

namespace Router;

use App\Exceptions\NotFoundException;

class Router {

    public $url;
    public $routes = [];

    public function __construct($url)
    {
        $this->url = trim($url, '/'); //Retirer les / en début et fin d'url
    }

    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }

    public function post(string $path, string $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }

    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) { //Chercher une route en GET ou POST
           if ($route->matches($this->url)) {
               return $route->execute();
           }
        }
        throw new NotFoundException("La page demandée est introuvable");
    }
}