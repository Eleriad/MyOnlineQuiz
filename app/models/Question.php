<?php

class Question extends Database
{
    public $niveau_id;
    public $question;
    public $feedback;
    public $reponse;
    public $facile;
    public $normal;
    public $difficile;

    public function create()
    {
        $sql = "INSERT INTO questions(niveau_id, question, feedback, reponse, facile, normal, difficile) 
                VALUE(:niveau_id, :question, :feedback, :reponse, :facile, :normal, :difficile)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('niveau_id', $this->niveau_id, PDO::PARAM_INT);
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

    public function getCategoryNameByQuestionId($idQuestion)
    {
        $sql = "SELECT `name` FROM posseder AS p
                JOIN categories AS c ON c.id_categorie = p.id_categorie
                WHERE p.id_question = $idQuestion";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getAllQuestions()
    {
        $sql = "SELECT * FROM questions AS q 
                JOIN niveaux AS n ON q.niveau_id = n.id_niveau";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Question');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function assignCategorieToQuestion($idQuestion, $idCategorie)
    {
        $sql = "INSERT INTO posseder (id_question, id_categorie) VALUE(:id_question, :id_categorie)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_question', $idQuestion, PDO::PARAM_INT);
        $stmt->bindParam('id_categorie', $idCategorie, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    public function getLastId()
    {
        $lastId = self::$_connection->lastInsertId();
        return $lastId;
    }

    public function getCategorieById($idQuestion)
    {
        $sql = "SELECT id_categorie FROM posseder WHERE id_question = $idQuestion";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_question', $idQuestion, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Question');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getCategorieName($idCategorie)
    {
        $sql = "SELECT name FROM categories WHERE id_categorie = $idCategorie";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_categorie', $idCategorie, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Question');
        $result = $stmt->fetch();
        return $result;
    }

    public function getQuestionById($idQuestion)
    {
        $sql = "SELECT * FROM questions AS q 
        JOIN niveaux AS n ON q.niveau_id = n.id_niveau
        WHERE q.id_question = $idQuestion";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_question', $idQuestion, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Question');
        $result = $stmt->fetch();
        return $result;
    }
}
