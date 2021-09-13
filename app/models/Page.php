<?php

class Page extends Database
{
    public $id;
    public $name;
    public $totalView;

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

    public function countPage($pageId)
    {
        $sql = "SELECT * FROM pages WHERE id = $pageId";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id', $pageId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $result = $stmt->rowCount();
        return $result;
    }

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

    public function getAllWebsiteViews()
    {
        $sql = "SELECT sum(total_views) as total_views FROM pages";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getAllPageViews()
    {
        $sql = "SELECT * FROM pages";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $result = $stmt->fetchAll();
        return $result;
    }
}