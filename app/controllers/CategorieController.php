<?php

class CategorieController extends Controller
{
    public function index()
    {
        $categories = $this->model('Categorie')->getCategories();

        $this->view('categorie/index', ["categories" => $categories]);
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

    public function edit($idCategorie)
    {
        $categorie = $this->model('Categorie')->getCategorieById($idCategorie);

        if (isset($_POST['updateCategorie'])) {
            $categorie->name = $_POST['categorieName'];
            $categorie->update();
            header('Location: /categorie/index');
        } else {
            $this->view('categorie/edit', $categorie);
        }
    }

    public function delete($idCategorie)
    {
        $categorie = $this->model('Categorie')->getCategorieById($idCategorie);

        if (isset($_POST['deleteCategorie'])) {
            $categorie->delete();
            header('Location: /categorie/index');
        } else {
            $this->view('categorie/delete', $categorie);
        }
    }
}
