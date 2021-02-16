<?php

class QuizController extends Controller
{
    public function index()
    {
        if (isset($_POST) && isset($_POST["level"])) {
            // var_dump($_POST["level"]);

            $level = $_POST["level"];
            $newCategories = $this->model("Quiz")->getCategoriesByLevel($level);
            // var_dump($newCategories);

            $categories = [];

            foreach ($newCategories as $newCat) {
                // var_dump($newCat["name"]);
                $categories[$newCat["id_categorie"]] = $newCat["name"];
            }

            echo json_encode($categories);
        } else {
            $niveaux = $this->model('Niveau')->getNiveauxByID();
            $categories = $this->model('Categorie')->getCategoriesByName();
            $questionMax = $this->model('Quiz')->getMaxQuestion();
            $questionMax = intval($questionMax[0]);

            $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories, "questionMax" => $questionMax]);
        }
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
        var_dump($_POST);
        // Si on a un POST
        if (isset($_POST) && !empty($_POST)) {

            // Si on a un POST mais pas de catégorie sélectionnée
            if (empty($_POST["Categories"]) or $_POST["levels"] === "0" or empty($_POST["levels"])) {
                $error = "Veuillez sélectionner au moins une catégorie ou un niveau !";
                $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories, "erreur" => $error, "questionMax" => $questionMax]);
            }

            // Si tout est ok, on lance le quizz
            else {
                // $nb = $quiz->countQuestionsByLevel($_POST["Categories"], $_POST["levels"]);
                // var_dump($nb[0]);
                var_dump($_POST);

                // $_POST["questionNb"] = nombre de questions à envoyer pour le quiz

                // lancer quizz avec en paramètres les 2 données (niveau + catégorie(s))
                $this->view('quiz/quiz');
            }
        }

        // Si pas de POST, on renvoie sur la page d'index
        else {
            $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories, "questionMax" => $questionMax]);
        }
    }
}