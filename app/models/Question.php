<?php

class Question extends Database
{
    public $niveauId;
    public $question;
    public $questionPicture;
    public $feedback;
    public $feedbackPicture;
    public $reponse;
    public $facile;
    public $normal;
    public $difficile;
    public $lien;

    /******* CRUD table questions *******/
    public function create()
    {
        $sql = "INSERT INTO questions(niveau_id, question, question_picture, feedback, feedback_picture, reponse, facile, normal, difficile, lien) 
                VALUE(:niveau_id, :question, :question_picture, :feedback, :feedback_picture, :reponse, :facile, :normal, :difficile, :lien)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('niveau_id', $this->niveauId, PDO::PARAM_INT);
        $stmt->bindParam('question', $this->question, PDO::PARAM_STR);
        $stmt->bindParam('question_picture', $this->questionPicture, PDO::PARAM_STR);
        $stmt->bindParam('feedback', $this->feedback, PDO::PARAM_STR);
        $stmt->bindParam('feedback_picture', $this->feedbackPicture, PDO::PARAM_STR);
        $stmt->bindParam('reponse', $this->reponse, PDO::PARAM_STR);
        $stmt->bindParam('facile', $this->facile, PDO::PARAM_STR);
        $stmt->bindParam('normal', $this->normal, PDO::PARAM_STR);
        $stmt->bindParam('difficile', $this->difficile, PDO::PARAM_STR);
        $stmt->bindParam('lien', $this->lien, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Question');
        $result = $stmt->rowCount();
        return $result;
    }

    public function update($idQuestion)
    {
        $sql = "UPDATE questions SET niveau_id = :niveau_id, question = :question, question_picture = :question_picture, feedback = :feedback, feedback_picture = :feedback_picture, reponse = :reponse, facile = :facile, normal =:normal, difficile = :difficile, lien = :lien WHERE id_question = $idQuestion";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('niveau_id', $this->niveauId, PDO::PARAM_INT);
        $stmt->bindParam('question', $this->question, PDO::PARAM_STR);
        $stmt->bindParam('question_picture', $this->questionPicture, PDO::PARAM_STR);
        $stmt->bindParam('feedback', $this->feedback, PDO::PARAM_STR);
        $stmt->bindParam('feedback_picture', $this->feedbackPicture, PDO::PARAM_STR);
        $stmt->bindParam('reponse', $this->reponse, PDO::PARAM_STR);
        $stmt->bindParam('facile', $this->facile, PDO::PARAM_STR);
        $stmt->bindParam('normal', $this->normal, PDO::PARAM_STR);
        $stmt->bindParam('difficile', $this->difficile, PDO::PARAM_STR);
        $stmt->bindParam('lien', $this->lien, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Question');
        $result = $stmt->rowCount();
        return $result;
    }

    public function delete($idQuestion)
    {
        $sql = "DELETE q.*, p.* FROM questions AS q 
        JOIN posseder AS p ON q.id_question = p.id_question 
        WHERE q.id_question = $idQuestion";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_question', $idQuestion, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    /******* CRUD table posseder *******/

    public function createCategorieToQuestion($idQuestion, $idCategorie)
    {
        $sql = "INSERT INTO posseder(id_categorie, id_question) VALUE(:id_categorie, :id_question)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_question', $idQuestion, PDO::PARAM_INT);
        $stmt->bindParam('id_categorie', $idCategorie, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    public function updateCategorieToQuestion($idQuestion, $idCategorie)
    {
        $sql = "UPDATE posseder SET id_categorie = :id_categorie WHERE id_question = :id_question";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_question', $idQuestion, PDO::PARAM_INT);
        $stmt->bindParam('id_categorie', $idCategorie, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    public function deleteCategorieToQuestion($idQuestion)
    {
        $sql = "DELETE FROM posseder WHERE id_question = $idQuestion";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_question', $idQuestion, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    /******* SPECIFIC table posseder *******/
    public function checkCategorieByQuestionId($idQuestion)
    {
        $sql = "SELECT id_categorie FROM posseder WHERE id_question = :id_question";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam('id_question', $idQuestion, PDO::PARAM_INT);
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

    /******* GETTER *******/
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

    public function countTotalQuestions()
    {
        $sql = "SELECT COUNT(*) FROM questions";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getRandomQuestions($nb)
    {
        $sql = "SELECT * FROM questions AS q 
                JOIN niveaux AS n ON q.niveau_id = n.id_niveau
                ORDER BY RAND()
                LIMIT $nb";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Question');
        $result = $stmt->fetchAll();
        return $result;
    }

    //TODO : prévoir 2 fonctions pour vérifier si le nom d'une image existe déjà dans la base... (question & feedback)
}