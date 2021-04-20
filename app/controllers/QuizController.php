<?php

class QuizController extends Controller
{
    public function index()
    {
        $niveaux = $this->model('Niveau')->getNiveauxByID();
        $categories = $this->model('Categorie')->getCategoriesByName();
        $questionMax = $this->model('Quiz')->getMaxQuestion();
        $questionMax = intval($questionMax[0]);

        if (isset($_POST) && !empty($_POST)) {
            // Si on a un POST mais pas de catégorie sélectionnée
            if (!isset($_POST["categories"]) or $_POST["level"] === "0") {
                $error = "Veuillez sélectionner au moins une catégorie ou un niveau !";
                $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories, "erreur" => $error, "questionMax" => $questionMax]);
            }
            // Si tout est ok, on renvoie sur la page de quizz
            else {
                unset($_SESSION["level"], $_SESSION["categories"], $_SESSION["questionNb"]);
                $_SESSION["level"] = $_POST["level"];
                $_SESSION["categories"] = $_POST["categories"];
                $_SESSION["questionNb"] = $_POST["questionNb"];
                header('Location: /quiz/quiz');
            }
        } else {
            $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories, "questionMax" => $questionMax]);
        }
    }

    public function quiz()
    {
        $this->view('quiz/quiz');
    }
}