<?php

class AjaxController extends Controller
{
    /**
     * Function that get all categories given a specific level
     * @return void
     */
    public function getCategoriesByLevel()
    {
        if (isset($_POST) && isset($_POST["level"])) {
            $level = $_POST["level"];
            $newCategories = $this->model("Quiz")->getCategoriesByLevel($level);

            foreach ($newCategories as $newCat) {
                $categories[$newCat["id_categorie"]] = $newCat["name"];
                // TODO : voir comment récupérer l'image !!!
                // $categories[$newCat["test"]] = $newCat["categorie_picture"];
            }

            echo json_encode($categories);
        }
    }

    /**
     * Function that get the maximum number of questions in order to display it on the quiz/index view
     * @return void
     */
    public function getMaxQuestions()
    {
        $maxNb = $this->model("Quiz")->getQuestionsNb($_POST["data"], $_POST["level"]);

        echo json_encode($maxNb);
    }
}