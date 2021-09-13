<?php

class PageView extends Database
{
    public $visitorIp;
    public $pageId;

    /**
     * Function that create a new unique visitor in DB
     * @param string $visitorIp <=> visitor's IP adress
     * @param int $pageId <=> page's id
     * @return void
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

    /**
     * Function that check if a visitor is unique or not
     * @param string $visitorIp <=> visitor's IP adress
     * @param int $pageId <=> page's id
     * @return int 1 if visitor already exists in DB or 0 if not
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