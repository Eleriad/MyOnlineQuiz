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

    protected function characterReplace($data)
    {
        // TODO : revoir toutes les majuscules !!!
        $search  = array('à', 'ä', 'â', 'é', 'É', 'è', 'ê', 'ë', 'î', 'ï', 'ô', 'ö', 'ù', 'û', 'ü', ' '); // checked characters
        $replace = array('a', 'a', 'a', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'o', 'o', 'u', 'u', 'u', '_'); // replacement's characters

        return str_replace($search, $replace, $data);
    }

    protected function checkPictureValidity($data, $size)
    {
        $name = $data["name"];
        $type = $data["type"];
        $tmpName = $data["tmp_name"];
        $error = $data["error"];
        $size = $data["size"];

        if ($error == 0) {
            // Exploding the name to distinguish name and extension
            $extArray = explode('.', $name);
            // gathering the last element of array (i.e. the extension) and putting it to lower for later comparison
            $extension = strtolower(end($extArray));
            // creating an array with all authorize extensions
            $authorizedExtensions = ['png', 'gif', 'svg', 'jpg', 'jpeg'];

            if (in_array($extension, $authorizedExtensions)) {

                // Maximum size for a category picture limited to 2 Mo
                $maxSize = $size;

                if ($size <= $maxSize) {
                    // using category name to create the categorie picture's name 
                    $pictureName = mb_detect_encoding($_POST["newCategory"], mb_detect_order(), true);
                    $pictureName = iconv("UTF-8", "UTF-8//TRANSLIT//IGNORE", $_POST["newCategory"]);
                    $pictureName = mb_strtolower($pictureName);
                    $pictureName = $this->characterReplace($pictureName);

                    $fileName = $pictureName . '.' . $extension;

                    return $fileName;
                } else {
                    return 1;
                }
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }

    /**
     * Function that calculates the percentage of a given number.
     * @param int $nb The number you want a percentage of.
     * @param int $percent The percentage that you want to calculate.
     * @return int The final result.
     */
    protected function getPercentage($nb, $percent)
    {
        return ($percent / 100) * $nb;
    }
}

// TODO Prévoir une fonction qui va vérifier tout ce qui est envoyé et assainir les strings ou array envoyés par méthode POST
// TODO : définir une fonction générale qui préparera les messages d'erreur et de succès lors de la création, modification ou suppression d'un élément du quiz