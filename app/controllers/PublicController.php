<?php

class PublicController extends Controller
{
    /**
     * Function that displays the public/index view with the last three categories in DB
     * @return void
     */
    public function index()
    {
        $thematiques = $this->model('Categorie')->getThreeLastCategories();

        $this->view('public/index', ["title" => "Accueil", "thématiques" => $thematiques]);
    }

    public function categories()
    {

        $categories = $this->model('Categorie')->getOrderedCategories();

        $this->view('public/categories', ["title" => "Thématiques du quiz", "categories" => $categories]);
    }
}