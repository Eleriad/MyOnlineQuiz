<?php

class PublicController extends Controller
{
    /**
     * Function that displays the public/index view with the last three categories in DB
     * @return view public/index
     */
    public function index()
    {
        // PAGE AND VIEWS
        $pageId = 3;
        $title = "Home";
        $this->checkPage($pageId, $title);
        $this->checkNewView($pageId);

        $currentQuestions = $this->model('Question')->countTotalQuestions();
        $thematiques = $this->model('Categorie')->getThreeLastCategories();
        $this->view('public/index', ["title" => $title, "currentQuestions" => $currentQuestions, "thématiques" => $thematiques]);
    }

    /**
     * Function that displays all the categories of the quiz with picture and short description
     * @return view public/categories
     */
    public function categories()
    {
        // PAGE AND VIEWS
        $pageId = 4;
        $title = "Thématiques";
        $this->checkPage($pageId, $title);
        $this->checkNewView($pageId);

        $categories = $this->model('Categorie')->getAllCategoriesByName();
        $this->view('public/categories', ["title" => $title, "categories" => $categories]);
    }
}