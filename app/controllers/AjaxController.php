<?php

class AjaxController extends Controller
{
    public function getCategoriesByLevel()
    {
        if (isset($_POST) && isset($_POST["level"])) {
            $level = $_POST["level"];
            $newCategories = $this->model("Quiz")->getCategoriesByLevel($level);

            $categories = [];

            foreach ($newCategories as $newCat) {
                $categories[$newCat["id_categorie"]] = $newCat["name"];
            }

            echo json_encode($categories);
        }
    }
}