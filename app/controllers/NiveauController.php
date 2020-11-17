<?php

class NiveauController extends Controller
{
    public function index()
    {
        $niveaux = $this->model('Niveau')->getNiveaux();
        $this->view('niveau/index', ['niveaux' => $niveaux]);
    }
}
