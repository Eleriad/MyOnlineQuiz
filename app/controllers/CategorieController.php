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
            $tmpName = $_FILES["categoriePicture"]["tmp_name"];

            $picture = $this->checkPictureValidity($_FILES["categoriePicture"], 2000000);

            if (is_int($picture)) {
                $error = $this->errorMessage($picture);

                // TODO : créer le setMessage avec le $error et supprimer l'existant !!! 
                $this->view('categorie/create', ["error" => $error]);
            } else {
                //Déplacement de l'image dans le dossier components/img/categorie_picture
                move_uploaded_file($tmpName, "./app/components/img/categorie_picture/$picture");

                // Création de la catégorie
                $newCategory = $this->model('Categorie');

                $newCategory->name = $_POST["newCategory"]; // TODO : faire une vérification si le nom existe déjà dans la BDD !!! 
                $newCategory->categoriePicture = $picture;
                $newCategory->description =  $_POST["description"];;
                $newCategory->create();

                // Renvoi sur la page d'index
                header('Location: /categorie/index');
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

            $picture = $_FILES["categoriePicture"];
            var_dump($_POST);
            var_dump($picture["error"]);
            if ($picture["error"] == 4) {
            }
            die;

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