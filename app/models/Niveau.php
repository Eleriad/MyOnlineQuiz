<?php

class Niveau extends Database
{
    public $name;

    public function create()
    {
        $sql = "INSERT INTO niveaux (name) VALUE (:name)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('name', $this->name, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Niveau');
        $result = $stmt->rowCount();
        return $result;
    }

    public function getNiveaux()
    {
        $sql = "SELECT * FROM niveaux";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Niveau');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function update()
    {
        $sql = "UPDATE niveaux SET name = :name WHERE id_niveau = :id_niveau";
        $stmt = self::$_connection->prepare($sql); 
        $stmt->bindParam('name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam('id_niveau', $this->id_niveau, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Niveau');
        $result = $stmt->rowCount();
        return $result;
    }

    public function delete()
    {
        $sql ="DELETE FROM niveaux WHERE id_niveau = :id_niveau";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_niveau', $this->id_niveau, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    public function getNiveauById($idNiveau)
    {
        $sql ="SELECT * FROM niveaux WHERE id_niveau = $idNiveau";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_niveau', $idNiveau, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Niveau');
        $result = $stmt->fetch();
        return $result;
    }
}
