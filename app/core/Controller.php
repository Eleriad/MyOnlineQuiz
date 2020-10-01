<?php

class COntroller
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
            include($viewPath);
        } else {
            echo "ERREUR : la vue intitulée $view n'existe pas !";
        }
    }
}
