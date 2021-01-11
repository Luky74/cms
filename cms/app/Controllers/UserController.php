<?php

namespace App\Controllers;

use App\Models\User;
use App\Validation\Validator;

class UserController extends Controller {

    public function login() //Afficher la vue du login
    {
        return $this->view('auth.login');
    }

    public function loginPost() //Autorisé une connexion ou non
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([ //gestion d'errreurs, un mdp exigé et 3 caracthères mininmum en identifiant
            'username' => ['required', 'min:3'],
            'password' => ['required']
        ]);

        if ($errors) { //si il y a une erreur, on reste sur la même vue
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        }

        $user = (new User($this->getDB()))->getByUsername($_POST['username']); //connexion à la BDD

        if (password_verify($_POST['password'], $user->password)) { //mot de passe crypté, veririfitaion dans la bdd si les champs remplis correspondent
                $_SESSION['auth'] = (int) $user->admin;
                return header('Location: /admin/posts?success=true');

        } else { //Si c'est faux, on reste sur la même page
            return header('Location: /login');
        }
    }

    public function logout() { // retourner sur la page d'acceuil à la deconnexion
        session_destroy();
        return header('Location: /');
    }
}