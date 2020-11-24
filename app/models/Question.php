<?php

class Question extends Database
{
    public $categorieId;
    public $niveauId;
    public $question;
    public $feedback;
    public $reponse;
    public $facile;
    public $normal;
    public $difficile;

    public function create()
    {
        $sql = "INSERT INTO quiz(categorie_id, niveau_id, question, feedback, reponse, facile, normal, difficile) 
                VALUE(:categorie_id, :niveau_id, :question, :feedback, :reponse, :facile, :normal, :difficile)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('categorie_id', $this->categorieId, PDO::PARAM_STR);
        $stmt->bindParam('niveau_id', $this->niveauId, PDO::PARAM_INT);
        $stmt->bindParam('question', $this->question, PDO::PARAM_STR);
        $stmt->bindParam('feedback', $this->feedback, PDO::PARAM_STR);
        $stmt->bindParam('reponse', $this->reponse, PDO::PARAM_STR);
        $stmt->bindParam('facile', $this->facile, PDO::PARAM_STR);
        $stmt->bindParam('normal', $this->normal, PDO::PARAM_STR);
        $stmt->bindParam('difficile', $this->difficile, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Question');
        $result = $stmt->rowCount();
        return $result;
    }
}
