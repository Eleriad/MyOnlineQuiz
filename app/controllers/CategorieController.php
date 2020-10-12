<?php

class CategorieController extends Controller
{
    public function index()
    {
        $this->view('categorie/index');
    }

    public function create()
    {
        if (isset($_POST["addCategory"])) {
            $newCategory = $this->model('Categorie');

            $newCategory->name = $_POST["newCategory"];
            $newCategory->create();
            header('Location: /categorie/index');
        } else {
            $this->view('categorie/create');
        }
    }
}
