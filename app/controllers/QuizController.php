<?php

class QuizController extends Controller
{
    public function index()
    {
        $niveaux = $this->model('Niveau')->getAllNiveauxById();
        $categories = $this->model('Categorie')->getAllCategoriesByName();
        $questionMax = $this->model('Quiz')->getMaxQuestion();
        $questionMax = intval($questionMax[0]);

        // UNSET ALL SESSION VARIABLES EXCEPT USER_ID and ROLE
        unset($_SESSION["randomQuiz"], $_SESSION["categories"], $_SESSION["questionNb"], $_SESSION["currentQuestion"], $_SESSION["correctAnswers"], $_SESSION["quizQuestions"], $_SESSION["level"]);

        if (isset($_POST) && !empty($_POST)) {

            if (isset($_POST["startQuiz"])) {
                // Si on a un POST mais pas de catégorie sélectionnée
                if (!isset($_POST["categories"]) or $_POST["level"] === "0") {
                    $error = "Veuillez sélectionner au moins une catégorie et un niveau !";
                    $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories, "erreur" => $error, "questionMax" => $questionMax]);
                }
                // Si tout est ok, on renvoie sur la page de quizz
                else {
                    // unset($_SESSION["level"], $_SESSION["categories"], $_SESSION["questionNb"], $_SESSION["randomQuiz"]);
                    $_SESSION["level"] = $_POST["level"];
                    $_SESSION["categories"] = $_POST["categories"];
                    $_SESSION["questionNb"] = $_POST["questionNb"];
                    $_SESSION["randomQuiz"] = false;
                    header('Location: /quiz/quiz');
                }
            } else if (isset($_POST["randomQuiz"])) {
                // unset($_SESSION["level"], $_SESSION["categories"], $_SESSION["questionNb"], $_SESSION["randomQuiz"]);
                $_SESSION["randomQuiz"] = true;
                header('Location: /quiz/randomQuiz');
            }
        } else {
            $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories, "questionMax" => $questionMax]);
        }
    }

    public function quiz()
    {
        // checking the $_SESSION data
        if (isset($_SESSION['level']) && isset($_SESSION['categories']) && isset($_SESSION['questionNb']) && $_SESSION['randomQuiz'] == false) {

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

    public function randomQuiz()
    {
        // Définition de la variable de session
        $_SESSION["currentQuestion"] = 0;

        $totalNb = $this->model('Question')->countTotalQuestions();
        $totalNb = intval($totalNb[0]);
        $totalNb < 20 ? $totalNb = $totalNb : $totalNb = 20;

        $randomNb = rand(10, $totalNb);
        $_SESSION["questionNb"] = $randomNb;
        $questions = $this->model('Question')->getRandomQuestions($randomNb);

        $this->view('quiz/randomQuiz', ["questions" => $questions]);
    }

    public function results()
    {
        $userAnswers = $_POST["userAnswers"][0];
        $userAnswersArray = explode(",", $userAnswers);

        if (isset($_POST["randomQuiz"])) {
            $categorieName = "Aléatoire";
            $levelName = null;
        } else {
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
        }

        $this->view('quiz/results', ["usersAnswersArray" => $userAnswersArray, "categorieName" => $categorieName, "levelName" => $levelName]);
    }
}