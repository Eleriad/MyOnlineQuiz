<?php

class User extends Database
{
    public $username;
    public $email;
    public $passwordHash;
    public $role;

    /******* CRUD *******/
    /**
     * SQL Request to create a new User
     */
    public function create()
    {
        // Vérification du rôle : user par défaut sauf si l'utilisateur est créé directement dans la section Administrateur
        isset($this->role) ? $this->role = $this->role : $this->role = "user";

        $sql = "INSERT INTO users(username, email, password_hash, role) VALUES (:username, :email, :password_hash, :role)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password_hash', $this->passwordHash);
        $stmt->bindParam(':role', $this->role);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->rowCount();
        return $result;
    }

    /**
     * SQL Request to update a specific User
     */
    public function update()
    {
        $sql = "UPDATE users SET username = :username, email = :email, password_hash = :password_hash, role = :role WHERE id = :id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('username', $this->username, PDO::PARAM_STR);
        $stmt->bindParam('email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam('password_hash', $this->passwordHash, PDO::PARAM_STR);
        $stmt->bindParam('role', $this->role, PDO::PARAM_STR);
        $stmt->bindParam('id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->rowCount();
        return $result;
    }

    /**
     * SQL Request to delete a specific User
     */
    public function delete()
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    /******* GETTER *******/
    /**
     * SQL Request to get all users
     */
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * SQL Request to get a specific user by his ID
     */
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->fetch();
        return $result;
    }

    /**
     * SQL Request get a specific User by his Name
     */
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

    /**
     * SQL Request to get a specific User by his email
     */
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

    /**
     * SQL Request to check if a specific User Name already exists in DB or not
     */
    public function checkIfUsernameExists($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    /**
     * SQL Request to check if a specific User email already exists in DB or not
     */
    public function checkIfEmailExists($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }
}