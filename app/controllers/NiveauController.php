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
        if (isset($_POST['addNiveau']))
        {
            $newNiveau = $this->model('Niveau');
            $newNiveau->name = $_POST['newNiveau'];
            $newNiveau->create();
            header('Location: /niveau/index/success');
        }
        else
        {
            $this->view('niveau/create');
        }
    }
}
