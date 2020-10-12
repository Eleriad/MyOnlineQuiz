<?php

class Categorie extends Database
{

    public $name;

    public function create()
    {
        $sql = "INSERT INTO categories(name) VALUE(:name)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('name', $this->name, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->rowCount();
        return $result;
    }
}
