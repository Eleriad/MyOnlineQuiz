<?php

class CategorieController extends Controller
{
    /**
     * Function that displays all categories
     * @return void
     */
    public function index()
    {
        $categories = $this->model('Categorie')->getCategories();
        $this->view('categorie/index', ["categories" => $categories]);
    }

    /**
     * Function that allows an administrator to create a new category by giving a name, a description and a picture
     * @return void
     */
    public function create()
    {
        if (isset($_POST["addCategory"])) {
            $tmpName = $_FILES["categoriePicture"]["tmp_name"];

            // CHECK PICTURE'S VALIDITY
            $picture = $this->checkPictureValidity($_FILES["categoriePicture"], 2000000);

            if (is_int($picture)) {
                $error = $this->errorMessage($picture);
                $this->setMsg("error", $error);
                $this->view('categorie/create', ["error" => $error]);
            } else {
                // CHECKING CATEGORY
                $checkCategorie = $this->model('Categorie')->getCategoryByName($_POST["newCategory"]);

                if ($checkCategorie == false) {
                    // PICTURE MOVING
                    move_uploaded_file($tmpName, "./app/components/img/categorie_picture/$picture");

                    // CATEGORY CREATION
                    $newCategory = $this->model('Categorie');

                    $newCategory->name = $_POST["newCategory"];
                    $newCategory->categoriePicture = $picture;
                    $newCategory->description =  $_POST["description"];;
                    $newCategory->create();

                    // REDIRECTION
                    header('Location: /categorie/index');
                } else {
                    $this->setMsg("error", "Cette catégories existe déjà dans la Base de Données !");
                    $this->view('categorie/create');
                }
            }
        } else {
            $this->view('categorie/create');
        }
    }

    public function edit($idCategorie)
    {
        $categorie = $this->model('Categorie')->getCategorieById($idCategorie);

        // TODO : vérifier si le nom de l'image correspond à un nom déjà existant ou pas afin de ne pas redemander à chaque fois la même image...

        if (isset($_POST['updateCategorie'])) {

            // $picture = $_FILES["categoriePicture"];
            // var_dump($_POST);
            // var_dump($picture["error"]);
            // if ($picture["error"] == 4) {
            // }
            // die;

            $categorie->name = $_POST['categorieName'];
            $categorie->description = $_POST['description'];
            $categorie->update();
            header('Location: /categorie/index');
        } else {
            $this->view('categorie/edit', ["title" => "Page de connexion", "catégorie" => $categorie]);
        }
    }

    public function delete($idCategorie)
    {
        $categorie = $this->model('Categorie')->getCategorieById($idCategorie);

        if (isset($_POST['deleteCategorie'])) {
            $categorie->delete();

            // TODO : aller supprimer la photo correspondanete dans le dossier components/img/categorie_picture

            header('Location: /categorie/index');
        } else {
            $this->view('categorie/delete', ["title" => "Page de connexion", "catégorie" => $categorie]);
        }
    }
}