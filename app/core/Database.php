<?php

class Database
{
    protected static $_connection = null;

    /**
     * Function that allows the connexion with the DB
     */
    public function __construct()
    {
        if (self::$_connection == null) {

            $host = DB_HOST;
            $dbname = DB_NAME;
            $user = DB_USER;
            $password = DB_PASSWORD;

            try {
                self::$_connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                self::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
            }
        }
    }
}