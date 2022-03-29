<?php

class QuestionController extends Controller
{
    /**
     * Function that displays all questions
     * @return view with all information about the questions
     */
    public function index()
    {
        $questions = $this->model('Question')->getAllQuestions();

        foreach ($questions as &$question) {
            $question->categories = $this->model('Question')->getCategoryNameByQuestionId($question->id_question);
        }

        $this->view('question/index', ["title" => "Questions - Display", "questions" => $questions]);
    }

    /**
     * Function that allows the Administrator to create a new question by giving it a name
     * @return view with inputs to create the question with a message that tells if the creation was successfull or not
     */
    public function create()
    {
        $niveaux = $this->model('Niveau')->getNiveaux();
        $categories = $this->model('Categorie')->getCategories();
        $question = $this->model('Question');

        if (isset($_POST["addQuestion"])) {
            $_POST = $this->secureArray($_POST);

            $question->niveauId = $_POST['niveaux'];
            $question->question = $_POST['question'];
            $question->feedback = $_POST['feedback'];
            $question->reponse = $_POST['reponse'];
            $question->facile = $_POST['facile'];
            $question->normal = $_POST['normal'];
            $question->difficile = $_POST['difficile'];
            $question->lien = $this->isEmpty($_POST['lien']);
            $question->create();

            $lastId = $this->model('Question')->getLastId();

            foreach ($_POST['categories'] as $categorie) {
                $this->model('Question')->createCategorieToQuestion($lastId, $categorie);
            }

            // LOCATION
            header('Location: /question/index');
        } else {
            $this->view('question/create', ["title" => "Questions - Create", "niveaux" => $niveaux, "categories" => $categories]);
        }
    }

    /**
     * Funtion that the Administrator to modify a question identified by its ID
     * @param int $idQuestion = the ID of the question which will be modified
     * @return view with inputs to modify the question with a message that tells if the modification was successfull or not
     */
    public function edit($idQuestion)
    {
        $editQuestion = $this->model('Question')->getQuestionById($idQuestion);
        $niveaux = $this->model('Niveau')->getNiveaux();
        $categories = $this->model('Categorie')->getCategories();
        $categorieNames = $this->model('Question')->getCategoryNameByQuestionId($idQuestion);

        if (isset($_POST['editQuestion'])) {
            $_POST = $this->secureArray($_POST);

            if ($_POST['categories'] != null) {
                $editedQuestion = $this->model('Question');

                $editedQuestion->niveauId = $_POST['niveaux'];
                $editedQuestion->question = $_POST['question'];
                $editedQuestion->feedback = $_POST['feedback'];
                $editedQuestion->reponse = $_POST['reponse'];
                $editedQuestion->facile = $_POST['facile'];
                $editedQuestion->normal = $_POST['normal'];
                $editedQuestion->difficile = $_POST['difficile'];
                $editedQuestion->lien = $this->isEmpty($_POST['lien']);
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
            $this->view('question/edit', ["title" => "Questions - Update", "question" => $editQuestion, "niveaux" => $niveaux, "categories" => $categories, "categorieNames" => $categorieNames]);
        }
    }

    /**
     * Function that check if delete button is pressed and, if so, delete the question
     * @param int $idQuestion = id of the question to delete
     * @return view of the deletion page with all the information about the question to be deleted
     */
    public function delete($idQuestion)
    {
        $deleteQuestion = $this->model('Question')->getQuestionById($idQuestion);
        $deleteCategories = $this->model('Question')->getCategoryNameByQuestionId($idQuestion);

        if (isset($_POST['deleteQuestion'])) {
            $deleteQuestion->delete($deleteQuestion->id_question);
            header('Location: /question/index');
        } else {
            $this->view('question/delete', ["title" => "Questions - Delete", "deleteQuestion" => $deleteQuestion, "deleteCategorie" => $deleteCategories]);
        }
    }
}