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
                if ($picture == 1) {
                    $error = $this->errorMessage(1);
                } else if ($picture = 2) {
                    $error = $this->errorMessage(2);
                } else if ($picture = 3) {
                    $error = $this->errorMessage($_FILES["categoriePicture"]["error"]);
                }
                $this->setMsg("error", $error);
                $this->view('categorie/create');
            } else {
                // CHECKING IF CATEGORY ALREADY EXISTS IN BD
                $checkCategorie = $this->model('Categorie')->getCategoryByName($_POST["newCategory"]);

                if ($checkCategorie == false) {
                    // PICTURE MOVING
                    move_uploaded_file($tmpName, "./app/components/img/categorie_pictures/$picture");

                    // CATEGORY CREATION
                    $newCategory = $this->model('Categorie');

                    $newCategory->name = $_POST["newCategory"];
                    $newCategory->categoriePicture = $picture;
                    // TODO : ajouter une image en blanc <=> en BDD white_picture et main_picture pour la principale
                    $newCategory->description =  $_POST["description"];
                    $newCategory->infos =  $_POST["infos"];
                    $newCategory->create();

                    // REDIRECTION
                    header('Location: /categorie/index');
                } else {
                    $this->setMsg("error", "Cette catégorie existe déjà dans la base de données !");
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

        // TODO : Si on a une erreur dans le $_FILEs (par ex. 4, pas d'image) : on conserve l'image en cours
        // TODO : vérifier pour remplacer l'image par une autre tout en conservant le même nom !

        if (isset($_POST['updateCategorie'])) {
            var_dump($_POST);
            var_dump($_FILES);
            die;

            // $picture = $_FILES["categoriePicture"];
            // var_dump($_POST);
            // var_dump($picture["error"]);
            // if ($picture["error"] == 4) {
            // }
            // die;

            $categorie->name = $_POST['categorieName'];
            $categorie->description = $_POST['description'];
            $categorie->infos = $_POST['infos'];
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
            $cwd = getcwd(); // CHECK : vérifier le chemin une fois en production !!!
            $cwd = str_replace("\\", "/", $cwd);
            $unlink = unlink($cwd . '/app/components/img/categorie_pictures/' . $categorie->categorie_picture);
            $categorie->delete();
            $this->setMsg("success", "L'image et la catégorie ont bien été supprimées !");
            header('Location: /categorie/index');
        } else {
            $this->view('categorie/delete', ["title" => "Page de connexion", "catégorie" => $categorie]);
        }
    }
}