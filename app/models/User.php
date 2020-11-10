<?php

class User extends Database
{
    public $username;
    public $email;
    public $password_hash;

    public function create()
    {
        $sql = "INSERT INTO users(username, email, password_hash) VALUES (:username, :email, :password_hash)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password_hash', $this->password_hash);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->rowCount();
        return $result;
    }

    public function findUserByName($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->fetch();
        return $result;
    }

    public function findUserByMail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->fetch();
        return $result;
    }
}
