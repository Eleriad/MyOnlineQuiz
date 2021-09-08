<?php

class Quiz extends Database
{
    /**
     * Function that select a specific number of random questions given a level and one or more categories
     * @param [int] $level
     * @param [int or array] $categories
     * @param [int] $limit
     * @return void
     */
    public function getRandomQuestions($level, $categories, $limit)
    {
        $sql = "SELECT question, feedback, reponse, facile, normal, difficile FROM questions AS q 
                JOIN posseder AS p 
                ON q.id_question = p.id_question 
                WHERE niveau_id = $level 
                AND id_categorie IN ($categories)
                ORDER BY RAND() 
                LIMIT $limit";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countQuestionsByLevel($idCategorie, $idLevel)
    {
        // Implode Categorie array to extract categorie IDs
        $arrayCat =  implode(",", $idCategorie);

        //SQL request
        $sql = "SELECT DISTINCT COUNT(p.id_question) 
                FROM posseder AS p
                JOIN questions AS q
                ON p.id_question = q.id_question
                WHERE p.id_categorie IN ($arrayCat) AND q.niveau_id = $idLevel";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getMaxQuestion()
    {
        $sql = "SELECT COUNT(id_question) FROM questions";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getCategoriesByLevel($level)
    {
        $sql = "SELECT DISTINCT c.name, c.id_categorie, c.categorie_picture 
                FROM categories AS c
                JOIN posseder AS p
                ON c.id_categorie = p.id_categorie
                JOIN questions AS q
                ON q.id_question = p.id_question
                WHERE q.niveau_id = $level";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getLevelName($level)
    {
        $sql = "SELECT level FROM niveaux WHERE id_niveau = $level";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCategorieName($idCategorie)
    {
        // Implode Categorie array to extract categorie IDs
        $arrayCat =  implode(",", $idCategorie);

        $sql = "SELECT name FROM `categories` WHERE id_categorie IN ($arrayCat)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getQuestionsNb($idCategorie, $level)
    {
        // Implode Categorie array to extract categorie IDs
        $arrayCat =  implode(",", $idCategorie);
        $level = intval($level);

        $sql = "SELECT count(*)as nb FROM `questions` as q
                JOIN posseder as p
                ON q.id_question = p.id_question 
                WHERE q.niveau_id = $level
                AND p.id_categorie IN($arrayCat)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}