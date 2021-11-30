<?php

class Database
{
    protected static $_connection = null;

    public function __construct()
    {
        if (self::$_connection == null) {

            $host = "localhost";
            $dbname = "myonlinequiz";
            $user = "root";
            $password = "";

            try {
                self::$_connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                self::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
            }
        }
    }
}
