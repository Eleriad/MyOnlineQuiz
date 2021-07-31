<?php

class Categorie extends Database
{
    public $name;
    public $categoriePicture;
    public $description;

    public function create()
    {
        $sql = "INSERT INTO categories(name, categorie_picture, description) VALUE(:name, :categorie_picture, :description)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam('categorie_picture', $this->categoriePicture, PDO::PARAM_STR);
        $stmt->bindParam('description', $this->description, PDO::PARAM_STR);
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

    public function getOrderedCategories()
    {
        $sql = "SELECT * FROM categories ORDER BY name";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getCategoriesByName()
    {
        $sql = "SELECT * FROM categories ORDER BY name";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function update()
    {
        $sql = "UPDATE categories SET name  = :name, categorie_picture = :categorie_picture, description  = :description WHERE id_categorie = :id_categorie";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam('categorie_picture', $this->categorie_picture, PDO::PARAM_STR);
        $stmt->bindParam('description', $this->description, PDO::PARAM_STR);
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

    public function getNameById($idCategorie)
    {
        $sql = "SELECT name FROM categories WHERE id_categorie = $idCategorie";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_categorie', $idCategorie, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->fetch();
        return $result;
    }
}