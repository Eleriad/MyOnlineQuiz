<?php

class PageView extends Database
{
    public $visitorIp;
    public $pageId;

    /******* CRUD *******/
    /**
     * SQL Request to create a new unique visitor in DB
     */
    public function create($visitorIp, $pageId)
    {
        $sql = "INSERT INTO page_views(visitor_ip, page_id) VALUE(:visitor_ip, :page_id)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('visitor_ip', $visitorIp, PDO::PARAM_STR);
        $stmt->bindParam('page_id', $pageId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'PageView');
        $result = $stmt->rowCount();
        return $result;
    }

    /******* GETTER *******/
    /**
     * SQL Request to get the total of views in the website
     */
    public function getAllWebsiteViews()
    {
        $sql = "SELECT sum(total_views) as total_views FROM pages";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * SQL Request to get all the informations of all the views of the website
     */
    public function getAllPageViews()
    {
        $sql = "SELECT * FROM pages";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $result = $stmt->fetchAll();
        return $result;
    }

    /******* CHECK *******/
    /**
     * SQL Request to check if a visitor is unique or not
     */
    public function checkUniqueIp($visitorIp, $pageId)
    {
        $sql = "SELECT * FROM page_views WHERE visitor_ip = '$visitorIp' AND page_id = '$pageId'";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('visitor_ip', $visitorIp, PDO::PARAM_INT);
        $stmt->bindParam('page_id', $pageId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
        $result = $stmt->rowCount();
        return $result;
    }
}