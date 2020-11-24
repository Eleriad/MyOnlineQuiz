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
        if (isset($_POST['addNiveau'])) {
            $newNiveau = $this->model('Niveau');
            $newNiveau->name = $_POST['newNiveau'];
            $newNiveau->create();
            header('Location: /niveau/index');
        } else {
            $this->view('niveau/create');
        }
    }

    public function edit($idNiveau)
    {
        $editNiveau = $this->model('Niveau')->getNiveauById($idNiveau);

        if (isset($_POST['updateNiveau'])) {
            $editNiveau->name = $_POST['niveauName'];
            $editNiveau->update();
            header('Location: /niveau/index');
        } else {
            $this->view('niveau/edit', $editNiveau);
        }
    }

    public function delete($idNiveau)
    {
        $editNiveau = $this->model('Niveau')->getNiveauById($idNiveau);

        if (isset($_POST['deleteNiveau'])) {
            $editNiveau->delete();
            header('Location: /niveau/index');
        } else {
            $this->view('niveau/delete', $editNiveau);
        }
    }
}
