<?php

class Controller
{
    /**
     * Function that returns a model
     * @return object
     */
    protected function model($model)
    {
        $modelPath = 'app/models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        } else {
            return null;
        }
    }

    /**
     * Function that returns a view
     * @return object
     */
    protected function view($view, $data = [])
    {
        $viewPath = 'app/views/' . $view . '.php';

        if (file_exists($viewPath)) {
            include_once('app/views/includes/header.php');
            include_once($viewPath);
            include_once('app/views/includes/footer.php');
        } else {
            echo "ERREUR : la vue intitulée $view n'existe pas !";
        }
    }
}