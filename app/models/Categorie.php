<?php

class Categorie extends Database
{
    public $name;
    public $categoriePicture;
    public $description;
    public $infos;

    /******* CRUD *******/
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

    public function getAllCategoriesByName()
    {
        $sql = "SELECT * FROM categories ORDER BY name";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $result = $stmt->fetchAll();
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

    /**
     * Function that searchs in DB if any Category exists, given one name
     * @param string $name <=> the name of the searched Category
     * @return void
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