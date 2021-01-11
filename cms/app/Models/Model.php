<?php

namespace App\Models;

use Database\DBConnection;
use PDO;

abstract class Model {

    protected $db;
    protected $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        return $this->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");

    }

    public function findById(int $id): Model
    {
        $stmt = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $stmt->execute([$id]);
        return $stmt->fetch();
        //return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function create(array $data, ?array $relations = null)
    {
        $firstParent = "";
        $secondParent = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "" : ", ";
            $firstParent .= "{$key}{$comma}";
            $secondParent .= ":{$key}{$comma}";
            $i++;
        }

        return $this->query("INSERT INTO {$this->table} ($firstParent) VALUES ($secondParent)", $data);
    }

    public function update(int $id, array $data)
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? " " : ", ";
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }

        $data['id'] = $id;

        return $this->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id = :id", $data);

    }

    public function destroy(int $id): bool
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    public function query(string $sql, array $param = null, bool $single = null) //Fonction qui permet de prendre les données dans la table sans dupliquer le code au dessus
    {
        $method = is_null($param) ? 'query' : 'prepare';

        if (strpos($sql, 'DELETE') === 0 || strpos($sql, 'UPDATE') === 0 || strpos($sql, 'INSERT') === 0) { //supprimer un article dans la base de donnée avec strpos

            $stmt = $this->db->getPDO()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            return $stmt->execute($param);
        }

        $fetch = is_null($single) ? 'fetchAll' : 'fetch';

        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if ($method = 'query') {
            return $stmt->$fetch();
        } else {
            $stmt->execute($param);
            return $stmt->$fetch();
        }
    }
}