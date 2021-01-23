<?php
namespace App\Models;

class Tag extends Model {

    protected $table = 'tags'; //Entrer dans la bonne table dans la bdd

    public function getPost()
    {
        return $this->query("SELECT p.* FROM posts p INNER JOIN post_tag pt ON pt.post_id = p.id WHERE pt.tag_id = ?", [$this->id]); //Trovuer le bon post via l'id
    }

}