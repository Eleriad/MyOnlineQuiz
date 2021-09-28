<?php

abstract class Controller
{
    /******* MODELS AND VIEWS *******/
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

    /******* GENERAL *******/
    /**
     * Function that prepares the displaying of a message depending on his type
     * @param $type : error or success
     * @param $text : set the text of the message in a $_SESSION variable
     * @return void
     */
    protected function setMsg($type, $text)
    {
        if ($type == "error") {
            $_SESSION['errorMsg'] = $text;
        } elseif ($type == "success") {
            $_SESSION['successMsg'] = $text;
        }
    }

    /**
     * Function that displays an alert div in case of error or success message 
     * @return void
     */
    protected function displayMsg()
    {
        if (isset($_SESSION['errorMsg'])) {
            echo '<div id="msgDiv" class="alert alert-danger" role="alert">' . $_SESSION['errorMsg'] . '</div>';
            unset($_SESSION['errorMsg']);
        } elseif (isset($_SESSION['successMsg'])) {
            echo '<div id="msgDiv" class="alert alert-success" role="alert">' . $_SESSION['successMsg'] . '</div>';
            unset($_SESSION['successMsg']);
        }
    }

    /******* SESSION *******/
    /**
     * Function that destroy the session and all his variables
     * Then, delete all cookies
     * @return void
     */
    protected function disconnect()
    {
        // Détruit toutes les variables de session
        $_SESSION = array();

        // Si vous voulez détruire complètement la session, effacez également le cookie de session.
        // Note : cela détruira la session et pas seulement les données de session !
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Finalement, on détruit la session.
        session_destroy();
    }

    /******* PICTURES *******/
    protected function characterReplace($data)
    {
        // TODO : revoir toutes les majuscules !!!
        $search  = array('à', 'ä', 'â', 'é', 'É', 'è', 'ê', 'ë', 'î', 'ï', 'ô', 'ö', 'ù', 'û', 'ü', ' '); // checked characters
        $replace = array('a', 'a', 'a', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'o', 'o', 'u', 'u', 'u', '_'); // replacement's characters

        return str_replace($search, $replace, $data);
    }

    protected function checkPictureValidity($data, $size)
    {
        // CHECKING which $_FILES is set
        isset($_FILES["categoriePicture"]) ? $_FILES["categoriePicture"] = $_FILES["categoriePicture"] : $_FILES["categoriePicture"] = null;
        isset($_FILES["questionPicture"]) ? $_FILES["questionPicture"] = $_FILES["questionPicture"] : $_FILES["questionPicture"] = null;
        isset($_FILES["feedbackPicture"]) ? $_FILES["feedbackPicture"] = $_FILES["feedbackPicture"] : $_FILES["feedbackPicture"] = null;

        // SETTING VARIABLES
        $name = $data["name"];
        $type = $data["type"];
        $tmpName = $data["tmp_name"];
        $error = $data["error"];
        $size = $data["size"];

        // SETTING $post
        if ($data == $_FILES["categoriePicture"]) {
            $post = $_POST["newCategory"];
        } else if ($data == $_FILES["questionPicture"]) {
            $post = $_FILES["questionPicture"]["name"];
        } else if ($data == $_FILES["feedbackPicture"]) {
            $post = $_FILES["feedbackPicture"]["name"];
        }

        // Au cas où on aurait une image dont le nom contient déjà une extension, on l'enlève
        $post = explode('.', $post);

        if ($error != 0) {
            $result = $this->errorMessage($error);
            return $result;
        } else {
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
                    $pictureName = mb_detect_encoding($post[0], mb_detect_order(), true);
                    $pictureName = iconv("UTF-8", "UTF-8//TRANSLIT//IGNORE", $post[0]);
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
        }
    }

    protected function errorMessage($error)
    {
        switch ($error) {
            case $error == 1:
                return "Image de taille trop importante !";
                break;
            case $error == 2:
                return "L'image ne possède pas la bonne extension ! Veuillez sélectionner une image au format .png, .gif ou .svg uniquement !";
                break;
            case $error == 3:
                return "L'image n'a été que partiellement téléchargée, merci de réessayer !";
                break;
            case $error == 4:
                return "Vous avez oublié l'image, merci de réessayer !";
                break;
            case $error == 6:
                return "Un dossier temporaire est manquant, merci de réessayer !";
                break;
            case $error == 7:
                return "Échec de l'écrire du fichier sur le disque, merci de réessayer !";
                break;
            case $error == 8:
                return "Une extension de PHP a arrêté l'envoi de fichier !";
                break;
        }
    }

    /******* QUIZ *******/
    protected function displayResult($score, $maxQuestions)
    {
        $third = 33 / 100 * $maxQuestions;
        $twoThird = 66 / 100 * $maxQuestions;

        switch ($score) {
            case $score < $third and $score == 0:
                echo "Vous ferez mieux la prochaine fois ! Votre score est de $score sur $maxQuestions";
                break;
            case $score > 0 and $score < $third:
                echo "Encore un effort ! Votre score est de $score sur $maxQuestions";
                break;
            case $score > $third and $score < $twoThird:
                echo "Vous y êtes presque ! Votre score est de $score sur $maxQuestions";
                break;
            case $score > $twoThird and $score < $maxQuestions:
                echo "Bravo ! Votre score est de $score sur $maxQuestions";
                break;
            case $score = $maxQuestions:
                echo "Excellent, vous avez parfaitement répondu à ce quizz ! Votre score est de $score sur $maxQuestions. Testez vos connaissances sur une autre thématique... et augmentez la difficulté !";
                break;
        }
    }

    protected function checkAnswers($choix, $userAnswer, $correctAnswer)
    {
        $result = array();
        for ($i = 0; $i < 4; $i++) {
            switch ($choix[$i]) {
                case  $choix[$i] == $userAnswer and $choix[$i] != $correctAnswer:
                    $result[$i] = "incorrect";
                    break;
                case  $choix[$i] != $userAnswer and $choix[$i] == $correctAnswer:
                    $result[$i] = "correct";
                    break;
                case  $choix[$i] == $userAnswer and $choix[$i] == $correctAnswer:
                    $result[$i] = "correct";
                    break;
                default:
                    $result[$i] = "";
                    break;
            }
        }
        return $result;
    }

    /******* PAGES *******/
    /**
     * Function that 1st check if the present page is already existing in DB and return 1 if yes and 0 if not.
     * Then, if the former check answers 0, it creates a new page in DB     *
     * @param int $pageId <=> the id of the page
     * @param string $title <=> The title of the page
     * @return int the ID of the page or 1 if a new page has been added in the DB
     */
    protected function checkPage($pageId, $title)
    {
        $pageCount = $this->model('Page')->countPage($pageId);
        $pageCount == 0 ? $this->model('Page')->create($pageId, $title, 0) : $pageCount = $pageId;
        return $pageCount;
    }

    protected function isUniqueView($userIp, $pageId)
    {
        $check = $this->model('PageView')->checkUniqueIp($userIp, $pageId);
        $check == 0 ? $check = true : $check = false;
        return $check;
    }

    protected function addView($uniqueIp, $visitorIp, $pageId)
    {
        if ($uniqueIp === true) {
            $pageView = $this->model('PageView')->create($visitorIp, $pageId);

            if ($pageView == 1) {
                //     // At this point unique visitor record is created successfully. Now update total_views of specific page.
                $update = $this->model('Page')->update($pageId);

                // En cas d'erreur
                if ($update == 0) {
                    "Erreur lors de la mise à jour de la BDD !";
                }
                // Si tout marche bien, on renvoie la valeur d'update (qui vaut 1)
                else {
                    return $update;
                }
            } else {
                "Erreur dans la création de la page !";
            }
        }
    }

    protected function checkNewView($pageId)
    {
        $visitorIp = $_SERVER['REMOTE_ADDR'];
        $isUniqueIp = $this->isUniqueView($visitorIp, $pageId);
        $addView = $this->addView($isUniqueIp, $visitorIp, $pageId);
        return $addView;
    }
}

// TODO Prévoir une fonction qui va vérifier tout ce qui est envoyé et assainir les strings ou array envoyés par méthode POST