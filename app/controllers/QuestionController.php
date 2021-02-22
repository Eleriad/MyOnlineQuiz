<?php

class QuestionController extends Controller
{
    public function index()
    {
        $questions = $this->model('Question')->getAllQuestions();

        foreach ($questions as &$question) {
            $question->categories = $this->model('Question')->getCategoryNameByQuestionId($question->id_question);
        }

        $this->view('question/index', ["questions" => $questions]);
    }

    public function create()
    {
        $niveaux = $this->model('Niveau')->getNiveaux();
        $categories = $this->model('Categorie')->getCategories();

        if (isset($_POST["addQuestion"])) {

            $question = $this->model('Question');

            $question->niveau_id = $_POST['niveaux'];
            $question->question = $_POST['question'];
            $question->feedback = $_POST['feedback'];
            $question->reponse = $_POST['reponse'];
            $question->facile = $_POST['facile'];
            $question->normal = $_POST['normal'];
            $question->difficile = $_POST['difficile'];
            $question->create();

            $lastId = $this->model('Question')->getLastId();

            foreach ($_POST['categories'] as $categorie) {
                $this->model('Question')->assignCategorieToQuestion($lastId, $categorie);
            }

            header('Location: /question/index');
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

            if ($_POST['categories'] != null) {
                $editedQuestion = $this->model('Question');

                $editedQuestion->niveau_id = $_POST['niveaux'];
                $editedQuestion->question = $_POST['question'];
                $editedQuestion->feedback = $_POST['feedback'];
                $editedQuestion->reponse = $_POST['reponse'];
                $editedQuestion->facile = $_POST['facile'];
                $editedQuestion->normal = $_POST['normal'];
                $editedQuestion->difficile = $_POST['difficile'];
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