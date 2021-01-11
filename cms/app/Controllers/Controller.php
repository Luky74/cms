<?php

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller {

    protected $db;

    public function __construct(DBConnection $db)
    {
        if (session_status() === PHP_SESSION_NONE) { // Demarrer une session
            session_start();
        }

        $this->db= $db;
    }

    protected function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path); //Remplacer les points par un /
        require VIEWS . $path . '.php'; //Concaténer les fichier et ajouter .php
        $content = ob_get_clean(); //déposer et stocker la vue dans notre variable
        require VIEWS . 'layout.php'; //Garder layout.php sur toute les vues
    }

    protected function getDB() //Focntion que j'utilise sur chaque connexion à la BDD,
    {
        return $this->db;
    }

    protected function isAdmin() //Permet de verifier si une session est ouverte
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === 1) {
            return true;
        } else { //Si aucune session, laisser l'utilisateur sur la page de connexion
            header('Location: /login');
        }
    }
}