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
                switch ($picture) {
                    case 1:
                        $result = "Image de taille trop importante !";
                        break;
                    case 2:
                        $result = "L'image ne possède pas la bonne extension ! Veuillez sélectionner une image au format .png, .gif ou .svg uniquement !";
                        break;
                    case 3:
                        $result = "Vous avez oublié l'image, merci de réessayer !";
                        break;
                }
                // TODO : créer le setMessage !!! 
                $this->view('categorie/create');
            } else {
                //Déplacement de l'image dans le dossier components/img/categorie_picture
                move_uploaded_file($tmpName, "./app/components/img/categorie_picture/$picture");

                // Création de la catégorie
                $newCategory = $this->model('Categorie');

                $newCategory->name = $_POST["newCategory"];
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
            $categorie->name = $_POST['categorieName'];
            $categorie->description = $_POST['description'];
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

            // TODO : aller supprimer la photo correspondanete dans le dossier components/img/categorie_picture

            header('Location: /categorie/index');
        } else {
            $this->view('categorie/delete', $categorie);
        }
    }
}