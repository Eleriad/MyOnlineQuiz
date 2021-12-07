<?php

// TODO : ajouter la case 'lien" pour chaque question avec, si le lien existe, un pett "en savoir plus" qui ouvre la page du lien dans un nouvel onglet.
class QuestionController extends Controller
{
    /**
     * Function that displays all questions in the question/index view
     * @return void
     */
    public function index()
    {
        $questions = $this->model('Question')->getAllQuestions();

        foreach ($questions as &$question) {
            $question->categories = $this->model('Question')->getCategoryNameByQuestionId($question->id_question);
        }

        $this->view('question/index', ["title" => "Tableau des Questions", "questions" => $questions]);
    }

    public function create()
    {
        $niveaux = $this->model('Niveau')->getNiveaux();
        $categories = $this->model('Categorie')->getCategories();
        $question = $this->model('Question');

        if (isset($_POST["addQuestion"])) {

            if (!isset($_FILES["questionPicture"])) {
                $question->questionPicture = null;
            } else if (!isset($_FILES["feedbackPicture"])) {
                $question->feedbackPicture = null;
            } else {

                $tmpQuestionName = $_FILES["questionPicture"]["tmp_name"];
                $tmpFeedbackName = $_FILES["feedbackPicture"]["tmp_name"];

                $questionPicture = $this->checkPictureValidity($_FILES["questionPicture"], 2000000);
                $feedbackPicture = $this->checkPictureValidity($_FILES["feedbackPicture"], 2000000);

                if (is_int($questionPicture)) {
                    $error = $this->errorMessage($questionPicture);
                    $this->setMsg("error", $error);
                    $this->view('question/create', ["error" => $error, "niveaux" => $niveaux, "categories" => $categories]);
                } else if (is_int($feedbackPicture)) {
                    $error = $this->errorMessage($feedbackPicture);
                    $this->setMsg("error", $error);
                    $this->view('question/create', ["error" => $error, "niveaux" => $niveaux, "categories" => $categories]);
                } else {

                    // PICTURE MOVING
                    move_uploaded_file($tmpQuestionName, "./app/components/img/question_pictures/$questionPicture");
                    move_uploaded_file($tmpFeedbackName, "./app/components/img/feedback_pictures/$feedbackPicture");

                    $question->niveauId = $_POST['niveaux'];
                    $question->question = $_POST['question'];
                    $question->questionPicture = $questionPicture;
                    $question->feedback = $_POST['feedback'];
                    $question->feedbackPicture = $feedbackPicture;
                    $question->reponse = $_POST['reponse'];
                    $question->facile = $_POST['facile'];
                    $question->normal = $_POST['normal'];
                    $question->difficile = $_POST['difficile'];
                    $question->lien = $_POST['lien'];
                    $question->create();

                    $lastId = $this->model('Question')->getLastId();

                    foreach ($_POST['categories'] as $categorie) {
                        $this->model('Question')->assignCategorieToQuestion($lastId, $categorie);
                    }

                    // LOCATION
                    header('Location: /question/index');
                }
            }
        } else {
            $this->view('question/create', ["niveaux" => $niveaux, "categories" => $categories]);
        }
    }

    public function edit($idQuestion)
    {
        $editQuestion = $this->model('Question')->getQuestionById($idQuestion);
        $niveaux = $this->model('Niveau')->getNiveaux();
        $categories = $this->model('Categorie')->getCategories();
        $categorieNames = $this->model('Question')->getCategoryNameByQuestionId($idQuestion);

        if (isset($_POST['editQuestion'])) {

            // TODO : vérifier le POST : il faut vérifier chaque image pour voir si on passe dans la boucle ou non !!!
            // Ici, si on passe dans le 1er if, on ne teste pas le else if 
            if (empty($_FILES) || $_FILES["editQuestionPicture"]["error"] == 4) {
                $editQuestion->question_picture = $editQuestion->question_picture;
                var_dump(1);
                // die;
            } else if (empty($_FILES) || $_FILES["editFeedbackPicture"]["error"] == 4) {
                $editQuestion->feedback_picture = $editQuestion->feedback_picture;
                var_dump(2);
                die;
            } else {
                var_dump(3);
                die;
                $tmpQuestionName = $_FILES["editQuestionPicture"]["tmp_name"];
                $tmpFeedbackName = $_FILES["editFeedbackPicture"]["tmp_name"];

                $questionPicture = $this->checkPictureValidity($_FILES["questionPicture"], 2000000);
                $feedbackPicture = $this->checkPictureValidity($_FILES["feedbackPicture"], 2000000);

                if (is_int($questionPicture)) {
                    $error = $this->errorMessage($questionPicture);
                    $this->setMsg("error", $error);
                    $this->view('question/create', ["error" => $error, "niveaux" => $niveaux, "categories" => $categories]);
                } else {
                    // DELETING FORMER PICTURE
                    $this->unlinkPicture($editQuestion->categorie_picture);
                    // PICTURE MOVING
                    move_uploaded_file($tmpQuestionName, "./app/components/img/categorie_pictures/$questionPicture");
                }

                if (is_int($feedbackPicture)) {
                    $error = $this->errorMessage($feedbackPicture);
                    $this->setMsg("error", $error);
                    $this->view('question/create', ["error" => $error, "niveaux" => $niveaux, "categories" => $categories]);
                } else {
                    // DELETING FORMER PICTURE
                    $this->unlinkPicture($editQuestion->categorie_picture);
                    // PICTURE MOVING
                    move_uploaded_file($tmpFeedbackName, "./app/components/img/categorie_pictures/$feedbackPicture");
                }
                // var_dump($questionPicture);
                // var_dump($feedbackPicture);
                // die;
            }


            // TODO : vérifier pour faire comme dans les catégories !

            if ($_POST['categories'] != null) {
                $editedQuestion = $this->model('Question');




                $editedQuestion->niveauId = $_POST['niveaux'];
                $editedQuestion->question = $_POST['question'];
                $editedQuestion->feedback = $_POST['feedback'];
                $editedQuestion->reponse = $_POST['reponse'];
                $editedQuestion->facile = $_POST['facile'];
                $editedQuestion->normal = $_POST['normal'];
                $editedQuestion->difficile = $_POST['difficile'];
                $editedQuestion->lien = $_POST['lien'];
                $editedQuestion->update(intval($idQuestion));

                // On supprime toutes les références de la table posséder afin de les recréer ensuite
                $editedQuestion->deleteCategorieToQuestion(intval($idQuestion));

                $categories = $this->model('Question')->checkCategorieByQuestionId($idQuestion);


                foreach ($_POST['categories'] as $categorie) {
                    $categorie = intval($categorie);
                    $editedQuestion->createCategorieToQuestion($idQuestion, $categorie);
                }
                // On renvoie sur la page d'index
                header('Location: /question/index');
            } else {

                // En cas d'erreur, retour sur la page edit avec message explicatif
                header('Location: /question/edit/' . $idQuestion . '?Message=errCat');
            }
        } else {
            $this->view('question/edit', ["question" => $editQuestion, "niveaux" => $niveaux, "categories" => $categories, "categorieNames" => $categorieNames]);
        }
    }

    /**
     * Function that display all data for a specific question and allows admin to delete the question
     * @param int $idQuestion : the id of the question to delete
     * @return void
     */
    public function delete($idQuestion)
    {
        $deleteQuestion = $this->model('Question')->getQuestionById($idQuestion);
        $deleteCategories = $this->model('Question')->getCategoryNameByQuestionId($idQuestion);

        if (isset($_POST['deleteQuestion'])) {
            $deleteQuestion->delete($deleteQuestion->id_question);
            header('Location: /question/index');
        } else {
            $this->view('question/delete', [$deleteQuestion, $deleteCategories]);
        }
    }
}