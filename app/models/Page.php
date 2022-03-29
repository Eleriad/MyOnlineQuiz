<?php

class Page extends Database
{
    public $id;
    public $name;
    public $totalView;

    /******* CRUD *******/
    /**
     * SQL Request to create a Page
     */
    public function create($id, $name, $totalViews)
    {
        $sql = "INSERT INTO pages(id, name, total_views) VALUE(:id, :name, :total_views)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->bindParam('name', $name, PDO::PARAM_STR);
        $stmt->bindParam('total_views', $totalViews, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $result = $stmt->rowCount();
        return $result;
    }

    /**
     * SQL Request to update a specific Page
     */
    public function update($pageId)
    {
        $sql = "UPDATE pages SET total_views = total_views + 1 WHERE id='$pageId'";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('total_views', $this->name, PDO::PARAM_INT);
        $stmt->bindParam('id', $pageId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $result = $stmt->rowCount();
        return $result;
    }

    /******* GETTER *******/
    /**
     * SQL Request to get all the information about a specific page of the website
     */
    public function getPage($pageId)
    {
        $sql = "SELECT * FROM pages WHERE id = $pageId";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id', $pageId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $result = $stmt->rowCount();
        return $result;
    }
}