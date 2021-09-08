<?php

class AjaxController extends Controller
{
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

    public function getMaxQuestions()
    {
        $maxNb = $this->model("Quiz")->getQuestionsNb($_POST["data"], $_POST["level"]);

        echo json_encode($maxNb);
    }
}