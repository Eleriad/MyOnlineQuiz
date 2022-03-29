<?php

class Niveau extends Database
{
    public $level;

    /******* CRUD *******/
    /**
     * SQL Request to create a new Level
     */
    public function create()
    {
        $sql = "INSERT INTO niveaux (level) VALUE (:level)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('level', $this->level, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Niveau');
        $result = $stmt->rowCount();
        return $result;
    }

    /**
     * SQL Request to update a Level
     */
    public function update()
    {
        $sql = "UPDATE niveaux SET level = :level WHERE id_niveau = :id_niveau";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('level', $this->level, PDO::PARAM_STR);
        $stmt->bindParam('id_niveau', $this->id_niveau, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Niveau');
        $result = $stmt->rowCount();
        return $result;
    }

    /**
     * SQL Request to delete a Level
     */
    public function delete()
    {
        $sql = "DELETE FROM niveaux WHERE id_niveau = :id_niveau";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_niveau', $this->id_niveau, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    /******* GETTER *******/
    /**
     * SQL Request to get all the Levels
     */
    public function getNiveaux()
    {
        $sql = "SELECT * FROM niveaux";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Niveau');
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * SQL Request to get a specific Level by his ID
     */
    public function getNiveauById($idNiveau)
    {
        $sql = "SELECT * FROM niveaux WHERE id_niveau = $idNiveau";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_niveau', $idNiveau, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Niveau');
        $result = $stmt->fetch();
        return $result;
    }

    /**
     * SQL Request to get all Levels ordered by their IDs
     */
    public function getAllNiveauxById()
    {
        $sql = "SELECT * FROM niveaux ORDER BY id_niveau";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Niveau');
        $result = $stmt->fetchAll();
        return $result;
    }
}