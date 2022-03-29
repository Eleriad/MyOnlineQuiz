<?php

class NiveauController extends Controller
{
    /**
     * Function that displays all levels
     * @return view with all information about the levels
     */
    public function index()
    {
        $niveaux = $this->model('Niveau')->getNiveaux();
        $this->view('niveau/index', ['title' => 'Niveaux - Display', 'niveaux' => $niveaux]);
    }

    /**
     * Function that allows the Administrator to create a new level by giving it a name
     * @return view with inputs to create the level with a message that tells if the creation was successfull or not
     */
    public function create()
    {
        if (isset($_POST['addLevel'])) {
            $_POST = $this->secureArray($_POST);
            $newNiveau = $this->model('Niveau');
            $newNiveau->level = $_POST['newLevel'];
            $newNiveau->create();
            $this->setMsg("success", "Le niveau a bien été créé !");
            header('Location: /niveau/index');
        } else {
            $this->view('niveau/create', ['title' => 'Niveaux - Create']);
        }
    }

    /**
     * Funtion that the Administrator to modify a level identified by its ID
     * @param int $idNiveau = the ID of the level which will be modified
     * @return view with inputs to modify the level with a message that tells if the modification was successfull or not
     */
    public function edit($idNiveau)
    {
        $editNiveau = $this->model('Niveau')->getNiveauById($idNiveau);

        if (isset($_POST['updateLevel'])) {
            $_POST = $this->secureArray($_POST);
            $editNiveau->level = $_POST['levelName'];
            $editNiveau->update();
            $this->setMsg("success", "Le nom du niveau a bien été modifié !");
            header('Location: /niveau/index');
        } else {
            $this->view('niveau/edit', ['title' => 'Niveaux - Create', "editNiveau" => $editNiveau]);
        }
    }

    /**
     * Function that check if delete button is pressed and, if so, delete the level
     * @param int $idNiveau = id of the level to delete
     * @return view of the deletion page with all the information about the level to be deleted
     */
    public function delete($idNiveau)
    {
        $editNiveau = $this->model('Niveau')->getNiveauById($idNiveau);

        if (isset($_POST['deleteLevel'])) {
            $editNiveau->delete();
            $this->setMsg("success", "Le niveau a bien été supprimé !");
            header('Location: /niveau/index');
        } else {
            $this->view('niveau/delete', ['title' => 'Niveaux - Create', 'editNiveau' => $editNiveau]);
        }
    }
}