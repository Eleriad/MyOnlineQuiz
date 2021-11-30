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
                $error = $this->checkErrorMsg($picture, $_FILES["categoriePicture"]["error"]);
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

        if (isset($_POST['updateCategorie'])) {
            if (empty($_FILES) || $_FILES["editCategoriePicture"]["error"] == 4) {
                $categorie->categorie_picture = $categorie->categorie_picture;
            } else {
                $tmpName = $_FILES["editCategoriePicture"]["tmp_name"];

                // CHECK PICTURE'S VALIDITY
                $picture = $this->checkPictureValidity($_FILES["editCategoriePicture"], 2000000);

                if (is_int($picture)) {
                    $error = $this->checkErrorMsg($picture, $_FILES["editCategoriePicture"]["error"]);
                    $this->setMsg("error", $error);
                    $this->view('categorie/edit');
                } else {
                    // DELETING FORMER PICTURE
                    $this->unlinkPicture($categorie->categorie_picture);
                    // PICTURE MOVING
                    move_uploaded_file($tmpName, "./app/components/img/categorie_pictures/$picture");
                }
            }
            $picture != null ? $categorie->categorie_picture = $picture : $categorie->categorie_picture = $categorie->categorie_picture;
            $categorie->name = $_POST['categorieName'];
            $categorie->description = $_POST['description'];
            $categorie->infos = $_POST['infos'];
            $categorie->update();
            $this->setMsg("success", "L'image et/ou la catégorie ont bien été modifiées !");
            header('Location: /categorie/index');
        } else {
            $this->view('categorie/edit', ["title" => "Page de connexion", "catégorie" => $categorie]);
        }
    }

    /**
     * Function that check if delete button is pressed and, if so, unlink the linked picture and delete the category
     * @param int $idCategorie <=> id of the category to delete
     */
    public function delete($idCategorie)
    {
        $categorie = $this->model('Categorie')->getCategorieById($idCategorie);

        if (isset($_POST['deleteCategorie'])) {
            $this->unlinkPicture($categorie->categorie_picture);
            $categorie->delete();
            $this->setMsg("success", "L'image et la catégorie ont bien été supprimées !");
            header('Location: /categorie/index');
        } else {
            $this->view('categorie/delete', ["title" => "Page de connexion", "catégorie" => $categorie]);
        }
    }
}