<?php

//Si une route n'est pas trouvé

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception {

    public function __construct($message = "", $code = 0, Throwable $previous = null) //Génerer par php
    {
        parent::__construct($message, $code, $previous);
    }

    public function error404() // sir le chemin n'est pas trouvé, directon la view error 404
    {
        http_response_code(404); // statut code 404
        require VIEWS . 'errors/404.php'; //Aller chercher la vue 404
    }

}