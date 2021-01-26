<?php

class QuizController extends Controller
{
    public function index()
    {
        $niveaux = $this->model('Niveau')->getNiveauxByID();
        $categories = $this->model('Categorie')->getCategoriesByName();

        $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories]);
    }

    public function quiz()
    {
        // Data pour le renvoi sur la page d'index
        $niveaux = $this->model('Niveau')->getNiveauxByID();
        $categories = $this->model('Categorie')->getCategoriesByName();

        // Data pour l'affichage du quiz

        // Si on a un POST
        if (isset($_POST) && !empty($_POST) && !empty($_POST["Categories"])) {

            $this->view('quiz/quiz');
        }

        // Si pas de POST, on renvoie sur la page d'index
        else {
            $this->view('quiz/index', ["niveaux" => $niveaux, "categories" => $categories]);
        }
    }
}