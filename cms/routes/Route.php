<?php

namespace Router;

use Database\DBConnection;

class Route {

    public $path;
    public $action;
    public $matches;

    public function __construct($path, $action)
    {
        $this->path = trim($path, '/'); //Retirer les /
        $this->action = $action;
    }

    public function matches(string $url)
    {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;  // On sauvegarde les paramètre dans l'instance pour plus tard
        return true;
    }


    public function execute()
    {
        $params = explode ('@', $this->action); //Passer par le BlogController
        $controller = new $params[0](new DBConnection(DB_NAME, DB_HOST, DB_USER, DB_PWD)); //Connection à la BDD
        $method = $params[1]; //La clé 1 contient l'id du post
        return isset($this->matches[0]) ? $controller->$method($this->matches[0]) : $controller->$method(); //Clé 1 contient l'ID, Si une ID est trouvée, on utilise la method.

    }
}