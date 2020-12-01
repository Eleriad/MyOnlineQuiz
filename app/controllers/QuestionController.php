<?php

class QuestionController extends Controller
{
    public function index()
    {
        $questions = $this->model('Question')->getAllQuestions();

        foreach ($questions as &$question) {
            // var_dump($question);
            $question->categories = $this->model('Question')->getCategoryNameByQuestionId($question->id_question);
            // var_dump($categories);
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
}
