<?php

class Quiz extends Database
{
    // public function getRandomQuestions($nb)
    // {
    // }

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

    public function startQuiz($questionNb, $categories, $level)
    {
        // TODO : prévoir de récupérer un nombre défini ($questionNb) de questions avec comme spécificité 1 niveau ($level) et une ou plusieurs catégories ($categories)
    }
}