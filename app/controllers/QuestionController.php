<?php

class QuestionController extends Controller
{
    public function index()
    {
        $this->view('question/index');
    }

    public function create()
    {
        $niveaux = $this->model('Niveau')->getNiveaux();
        $categories = $this->model('Categorie')->getCategories();

        if (isset($_POST["addQuestion"])) {

            $question = $this->model('Question');

            $categories = implode(',', $_POST['categories']);

            $question->categorieId = $categories;
            $question->niveauId = $_POST['niveaux'];
            $question->question = $_POST['question'];
            $question->feedback = $_POST['feedback'];
            $question->reponse = $_POST['reponse'];
            $question->facile = $_POST['facile'];
            $question->normal = $_POST['normal'];
            $question->difficile = $_POST['difficile'];
            $question->create();
            header('Location: /question/index');
        } else {
            $this->view('question/create', ["niveaux" => $niveaux, "categories" => $categories]);
        }
    }
}
