<?php

class Quiz extends Database
{
    // public function getRandomQuestions($nb)
    // {
    // }

    public function countQuestions($idCategorie)
    {
        // Implode Categorie array to extract categorie IDs
        $arrayCat =  implode(",", $idCategorie);

        //SQL request
        $sql = "SELECT DISTINCT COUNT(id_question) FROM posseder WHERE id_categorie IN ($arrayCat)";
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
}