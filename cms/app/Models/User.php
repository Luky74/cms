<?php

namespace App\Models;


class User extends Model {

    protected $table = 'users'; //Chercher le nom d'utilisateur dans la bdd (fonction utilisé dans UserController)

    public function getByUsername(string $username)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
    }
}