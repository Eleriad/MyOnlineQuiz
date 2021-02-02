<?php

class QuizController extends Controller
{
    public function index()
    {
        $niveaux = $this->model('Niveau')->getNiveauxByID();
        $categories = $this->model('Categorie')->getCategoriesByName();
        $questionMax = $this->model('Quiz')->getMaxQuestion();
        $questionMax = intval($questionMax[0]);

        $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories, "questionMax" => $questionMax]);
    }

    public function quiz()
    {
        // Data pour le renvoi sur la page d'index
        $niveaux = $this->model('Niveau')->getNiveauxByID();
        $categories = $this->model('Categorie')->getCategoriesByName();
        $quiz = $this->model('Quiz');
        $questionMax = $this->model('Quiz')->getMaxQuestion();
        $questionMax = intval($questionMax[0]);

        // Data pour l'affichage du quiz

        // Si on a un POST
        if (isset($_POST) && !empty($_POST) && !empty($_POST["Categories"])) {

            $nb = $quiz->countQuestions($_POST["Categories"]);
            var_dump($nb[0]);
            var_dump($nb[0]);


            // lancer quizz avec en paramètres les 2 données (niveau + catégorie(s))
            $this->view('quiz/quiz');
        }

        // Si on a un POST mais pas de catégorie sélectionnée
        else if (isset($_POST) && !empty($_POST) && empty($_POST["Categories"])) {
            $error = "Veuillez sélectionner au moins une catégorie !";
            $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories, "erreur" => $error, "questionMax" => $questionMax]);
        }

        // Si pas de POST, on renvoie sur la page d'index
        else {
            $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories, "questionMax" => $questionMax]);
        }
    }
}