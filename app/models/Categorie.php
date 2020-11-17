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

    public function getCategories()
    {
        $sql = "SELECT * FROM categories";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function update()
    {
        $sql = "UPDATE categories SET name  = :name WHERE id_categorie = :id_categorie";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam('id_categorie', $this->id_categorie, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->rowCount();
        return $result;
    }

    public function delete()
    {
        $sql = "DELETE FROM categories WHERE id_categorie = :id_categorie";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_categorie', $this->id_categorie, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    public function getCategorieById($idCategorie)
    {
        $sql = "SELECT * FROM categories WHERE id_categorie = $idCategorie";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_categorie', $idCategorie, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->fetch();
        return $result;
    }
}
