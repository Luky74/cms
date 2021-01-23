<?php

namespace App\Models;

use DateTime;

class Post extends Model {

    protected $table = 'posts'; //Entrer dans la bonne table dans la bdd

    //Chercher l'heure du post
    public function getCreatedAt(): string
    {
        return (new DateTime())->format('d/m/Y a H:i');
    }

    //Cherhcer le bon tag
    public function getTags()
    {
        return $this->query("SELECT t.* FROM tags t INNER JOIN post_tag pt ON pt.tag_id = t.id INNER JOIN posts p ON pt.post_id = p.id WHERE p.id = ?", [$this->id]);
    }

    //Mise à jours d'un post
    public function update(int $id, array $data)
    {
        return parent::update($id, $data);

        $stmt = $this->db()->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        $result = $stmt->execute([$id]);

        foreach ($relations as $tagId) {
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }

        if ($result) {
            return true;
        }

    }

    //
    public function create(array $data, ?array $relations = null)
    {
        return parent::create($data, $relations);
    }

}