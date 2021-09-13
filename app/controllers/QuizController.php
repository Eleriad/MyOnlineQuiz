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
        // checking the $_SESSION data
        if (isset($_SESSION['level']) && isset($_SESSION['categories']) && isset($_SESSION['questionNb'])) {

            $level = $_SESSION['level'];
            $nb = $_SESSION['questionNb'];
            $categoriesArray = $_SESSION['categories'];

            $count = count($categoriesArray); // count the number of data in categoriesArray

            // if there only one categorie is selected
            if ($count === 1) {
                $categories = intval($categoriesArray[0]);
            }
            // if more than one categorie are selected
            else {
                $categories = null;
                foreach ($categoriesArray as $nbs) {
                    $categories .= $nbs;
                    $categories .= ",";
                }
                // Delete the last comma of the categories' list
                $categories = substr($categories, 0, -1);
            }

            // Get the questions fot the quiz
            $questions = $this->model('Quiz')->getRandomQuestions($level, $categories,  $nb);

            // Définition de la variable de session
            $_SESSION["currentQuestion"] = 0;

            $questionLength = count($questions);

            $levelName = $this->model('Quiz')->getLevelName($level);
            $categorieName = $this->model('Quiz')->getCategorieName($categoriesArray);

            // Display the quiz/quiz page with the questions for the quiz
            $this->view('quiz/quiz', ["questions" => $questions, "questionLength" => $questionLength, "levelName" => $levelName, "categorieName" => $categorieName]);
        } else {
            $this->view('quiz/quiz');
        }
    }

    public function results()
    {
        $userAnswers = $_POST["userAnswers"][0];
        $userAnswersArray = explode(",", $userAnswers);

        $categoriesArray = $_SESSION['categories'];

        $count = count($categoriesArray); // count the number of data in categoriesArray

        // if there only one categorie is selected
        if ($count === 1) {
            $categories = intval($categoriesArray[0]);
        }
        // if more than one categorie are selected
        else {
            $categories = null;
            foreach ($categoriesArray as $nbs) {
                $categories .= $nbs;
                $categories .= ",";
            }
            // Delete the last comma of the categories' list
            $categories = substr($categories, 0, -1);
        }

        $categorieName = $this->model('Quiz')->getCategorieName($categoriesArray);

        $level = $_SESSION['level'];
        $levelName = $this->model('Quiz')->getLevelName($level);

        $this->view('quiz/results', ["usersAnswersArray" => $userAnswersArray, "categorieName" => $categorieName, "levelName" => $levelName]);
        //TODO : annuler les variables de session si on clique sur refaire un quiz ou refaire le même quiz !
    }
}