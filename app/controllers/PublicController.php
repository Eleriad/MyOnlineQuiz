<?php

class PublicController extends Controller
{
    public function index()
    {
        $this->view('public/index');
    }

    public function categories()
    {

        $categories = $this->model('Categorie')->getOrderedCategories();

        $this->view('public/categories', ["categories" => $categories]);
    }
}