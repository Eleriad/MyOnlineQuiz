<?php

class NiveauController extends Controller
{
    public function index()
    {
        $niveaux = $this->model('Niveau')->getNiveaux();
        $this->view('niveau/index', ['niveaux' => $niveaux]);
    }

    public function create()
    {
        if (isset($_POST['addLevel'])) {
            $newNiveau = $this->model('Niveau');
            $newNiveau->level = $_POST['newLevel'];
            $newNiveau->create();
            header('Location: /niveau/index');
        } else {
            $this->view('niveau/create');
        }
    }

    public function edit($idNiveau)
    {
        $editNiveau = $this->model('Niveau')->getNiveauById($idNiveau);

        if (isset($_POST['updateLevel'])) {
            $editNiveau->level = $_POST['levelName'];
            $editNiveau->update();
            header('Location: /niveau/index');
        } else {
            $this->view('niveau/edit', $editNiveau);
        }
    }

    public function delete($idNiveau)
    {
        $editNiveau = $this->model('Niveau')->getNiveauById($idNiveau);

        if (isset($_POST['deleteLevel'])) {
            $editNiveau->delete();
            header('Location: /niveau/index');
        } else {
            $this->view('niveau/delete', $editNiveau);
        }
    }
}