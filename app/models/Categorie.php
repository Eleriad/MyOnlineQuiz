<?php

class Categorie extends Database
{
    public $name;
    public $categoriePicture;
    public $description;
    public $infos;

    /******* CRUD *******/
    /**
     * SQL Request to create a new Categorie
     */
    public function create()
    {
        $sql = "INSERT INTO categories(name, categorie_picture, description, infos) VALUE(:name, :categorie_picture, :description, :infos)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam('categorie_picture', $this->categoriePicture, PDO::PARAM_STR);
        $stmt->bindParam('description', $this->description, PDO::PARAM_STR);
        $stmt->bindParam('infos', $this->infos, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->rowCount();
        return $result;
    }

    /**
     * SQL Request to update a Categorie
     */
    public function update()
    {
        $sql = "UPDATE categories SET name  = :name, categorie_picture = :categorie_picture, description  = :description, infos = :infos WHERE id_categorie = :id_categorie";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam('categorie_picture', $this->categorie_picture, PDO::PARAM_STR);
        $stmt->bindParam('description', $this->description, PDO::PARAM_STR);
        $stmt->bindParam('infos', $this->infos, PDO::PARAM_STR);
        $stmt->bindParam('id_categorie', $this->id_categorie, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->rowCount();
        return $result;
    }

    /**
     * SQL Request to delete a Categorie
     */
    public function delete()
    {
        $sql = "DELETE FROM categories WHERE id_categorie = :id_categorie";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_categorie', $this->id_categorie, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    /******* GETTER *******/
    /**
     * SQL Request to get all Categories
     */
    public function getCategories()
    {
        $sql = "SELECT * FROM categories";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * SQL Request to get all Categories ordered by Name
     */
    public function getAllCategoriesByName()
    {
        $sql = "SELECT * FROM categories ORDER BY name";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * SQL Request to get a specific Categories by his ID
     */
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

    /**
     * SQL Request to get a specific Categories by his Name
     */
    public function getCategoryByName($name)
    {
        $sql = "SELECT name FROM categories WHERE name = '$name'";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->bindParam('name', $name, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->fetch();
        return $result;
    }

    /**
     * SQL Request to get the Name of a specific Categories by his ID
     */
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

    /**
     * SQL Request to get the last three Categories inserted in the DB
     */
    public function getThreeLastCategories()
    {
        $sql = "SELECT * FROM categories ORDER BY id_categorie DESC LIMIT 3";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->fetchAll();
        return $result;
    }
}