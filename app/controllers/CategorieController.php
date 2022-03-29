<?php

class CategorieController extends Controller
{
    /**
     * Function that displays all categories
     * @return view with all information about the categories
     */
    public function index()
    {
        $categories = $this->model('Categorie')->getCategories();
        $this->view('categorie/index', ["title" => "Categories - Display", "categories" => $categories]);
    }

    /**
     * Function that allows the Administrator to create a new category by giving it a name, a description and a picture
     * @return view with inputs to create the category with a message that tells if the creation was successfull or not
     */
    public function create()
    {
        if (isset($_POST["addCategory"])) {
            $_POST = $this->secureArray($_POST);

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
                    $newCategory->description =  $_POST["description"];
                    $newCategory->infos =  $_POST["infos"];
                    $newCategory->create();

                    $this->setMsg("success", "La catégorie a bien été créée !");

                    // REDIRECTION
                    header('Location: /categorie/index');
                } else {
                    $this->setMsg("error", "Cette catégorie existe déjà dans la base de données !");
                    $this->view('categorie/create');
                }
            }
        } else {
            $this->view('categorie/create', ["title" => "Categories - Create"]);
        }
    }

    /**
     * Funtion that the Administrator to modify a category identified by its ID
     * @param int $idCategorie = the ID of the category which will be modified
     * @return view with inputs to modify the category with a message that tells if the modification was successfull or not
     */
    public function edit($idCategorie)
    {
        $categorie = $this->model('Categorie')->getCategorieById($idCategorie);

        if (isset($_POST['updateCategorie'])) {
            $_POST = $this->secureArray($_POST);

            if (empty($_FILES) || $_FILES["editCategoriePicture"]["error"] == 4) {
                $categorie->categorie_picture = $categorie->categorie_picture;
            } else {
                $tmpName = $_FILES["editCategoriePicture"]["tmp_name"];

                // CHECK PICTURE'S VALIDITY
                $picture = $this->checkPictureValidity($_FILES["editCategoriePicture"], 2000000);

                if (is_int($picture)) {
                    $error = $this->checkErrorMsg($picture, $_FILES["editCategoriePicture"]["error"]);
                    $this->setMsg("error", $error);
                    header('Location: /categorie/edit');
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
            $this->view('categorie/edit', ["title" => "Categories - Update", "catégorie" => $categorie]);
        }
    }

    /**
     * Function that check if delete button is pressed and, if so, unlink the linked picture and delete the category
     * @param int $idCategorie = id of the category to delete
     * @return view of the deletion page with all the information about the category to be deleted
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
            $this->view('categorie/delete', ["title" => "Categories - Delete", "catégorie" => $categorie]);
        }
    }
}