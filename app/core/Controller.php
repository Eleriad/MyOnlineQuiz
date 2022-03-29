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
     * Function that secures all data from an array
     * This function strips HTML or PHP tags from a string; converts special characters to HTML entities; 
     * strips whitespace (or other characters) from the beginning and end of a string and replaces old values by new value in array.
     * @param $array 
     * @return array array with secured data
     */
    protected function secureArray($array)
    {
        $newArray = array();
        foreach ($array as $key => $value) {

            if (!is_array($value)) {
                $value = strip_tags($value);
                $value = htmlspecialchars($value);
                $value = trim($value);
                $newArray[$key] = $value;
            } else {
                $newArray[$key] = $value;
            }
        }
        return $newArray;
    }

    /**
     * Function that secures a specific data
     * This function strips HTML or PHP tags from a string; converts special characters to HTML entities; 
     * strips whitespace (or other characters) from the beginning and end of a string and replaces old values by new value in array.
     * @param $data data to secure
     * @return $data the secured data
     */
    protected function secureString($data)
    {
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        $data = trim($data);
        return $data;
    }

    /**
     * Verifies if any data is empty or not
     * @param $data : any data which can be passed in a post form
     * @return $data if $data is not empty ; return null if data is empty
     */
    protected function isEmpty($data)
    {
        if (isset($data) && $data == "") {
            $data = null;
        }
        return $data;
    }

    /******* MESSAGES *******/
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
     * @return view home/index
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
    /**
     * Function that search if $data contains any accentuated characters and, if so, replace them by non accentuated characters to avoid issues on DB
     * @param string $data
     * @return string $data
     */
    protected function characterReplace($data)
    {
        $search  = array('à', 'À', 'á', 'Á', 'ä', 'Ä', 'â', 'Â', 'é', 'É', 'è', 'È', 'ê', 'Ê', 'ë', 'Ë', 'î', 'Î', 'ï', 'Ï', 'ô', 'Ô', 'ö', 'Ö', 'ù', 'Ù', 'û', 'Û', 'ü', 'Ü', ' '); // checked characters
        $replace = array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', '_'); // replacement's characters

        return str_replace($search, $replace, $data);
    }

    /**
     * Function that checks all information about a picture in order to see if the specificities asked by the website have been correctly done
     * In this case, check the extension adn the size of the picture then give a name to the picture
     * @param $data <=> $_FILES data
     * @param int $sizeMax <=> the max size allowed by the Administrator for any picture
     */
    protected function checkPictureValidity($data, $sizeMax)
    {
        // CHECKING    
        isset($_FILES["categoriePicture"]) ? $_FILES["categoriePicture"] = $_FILES["categoriePicture"] : $_FILES["categoriePicture"] = null;
        isset($_FILES["questionPicture"]) ? $_FILES["questionPicture"] = $_FILES["questionPicture"] : $_FILES["questionPicture"] = null;
        isset($_FILES["feedbackPicture"]) ? $_FILES["feedbackPicture"] = $_FILES["feedbackPicture"] : $_FILES["feedbackPicture"] = null;
        isset($_FILES["editCategoriePicture"]) ? $_FILES["editCategoriePicture"] = $_FILES["editCategoriePicture"] : $_FILES["editCategoriePicture"] = null;

        // SETTING VARIABLES
        $name = $data["name"];
        $type = $data["type"];
        $tmpName = $data["tmp_name"];
        $error = $data["error"];
        $size = $data["size"];

        // SETTING $post
        if ($data == $_FILES["categoriePicture"]) {
            $post = $_POST["newCategory"];
        } else if ($data == $_FILES["editCategoriePicture"]) {
            $post = $_POST["categorieName"];
        } else if ($data == $_FILES["questionPicture"]) {
            $post = $_FILES["questionPicture"]["name"];
        } else if ($data == $_FILES["feedbackPicture"]) {
            $post = $_FILES["feedbackPicture"]["name"];
        }

        // Au cas où on aurait une image dont le nom contient déjà une extension, on l'enlève
        $post = explode('.', $post);

        if ($error != 0) {
            $result = null;
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
                $maxSize = $sizeMax;

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

    /**
     * Function that checks the error int given if any error appears while trying to insert a picture in DB
     * @param string $picture <=> result of the previous function 
     * @param [type] $fileError <=> error int in the $_FILES data
     * @return void
     */
    protected function checkErrorMsg($picture, $fileError)
    {
        if ($picture == 1) {
            $error = $this->errorMessage(1);
        } else if ($picture = 2) {
            $error = $this->errorMessage(2);
        } else if ($picture = 3) {
            $error = $this->errorMessage($fileError);
        }
        return $error;
    }

    /**
     * Function that displays the specific message depending of the error int given when trying to insert a picture in DB
     * @param int $error
     * @return string <=> the specific message related to the error
     */
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
                return "Une extension de PHP a arrêté l'envoi de fichier, merci de réessayer !";
                break;
        }
    }

    /**
     * Function that unlink a picture
     * @param string $path <=> the place where the pciture is kept
     */
    protected function unlinkPicture($path)
    {
        $cwd = getcwd(); // TODO : vérifier le chemin une fois en production !!!
        $cwd = str_replace("\\", "/", $cwd);
        $unlink = unlink($cwd . '/app/components/img/categorie_pictures/' . $path);
    }

    /******* QUIZ *******/
    /**
     * Function that displays a specific message depending of the results of the quiz
     * @param int $score <=> score made by the user
     * @param int $maxQuestions <=> max number of questions for the quiz
     * @return string <=> the message
     */
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

    /**
     * Function that check if the user made the correct choice for a specific question during the quiz
     * @param array $choix <=> list of the possible answers
     * @param int $userAnswer <=> choice made by the user
     * @param int $correctAnswer <=> correct answer
     * @return string <=> correct, incorrect of empty depending of the result
     */
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
        $pageCount = $this->model('Page')->getPage($pageId);
        $pageCount == 0 ? $this->model('Page')->create($pageId, $title, 0) : $pageCount = $pageId;
        return $pageCount;
    }

    /**
     * Function that checks if a visitor - identified by his IP - has already visited the  page or not
     * @param int $userIp <=> IP of the visitor
     * @param int $pageId <=> ID of the visited page
     * @return boolean true if Unique IP, False if not
     */
    protected function isUniqueView($userIp, $pageId)
    {
        $check = $this->model('PageView')->checkUniqueIp($userIp, $pageId);
        $check == 0 ? $check = true : $check = false;
        return $check;
    }

    /**
     * Function thats update the number of views for a specific page depending of the previous function
     * @param int $uniqueIp <=> boolean depending of the result of the previous function
     * @param IP $visitorIp <=> IP of the visitor
     * @param int $pageId <=> ID of the visited page
     * @return void
     */
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

    /**
     * Function that checks if there is a new view or not
     * @param int $pageId <=> ID of the visited page
     * @return $addView
     */
    protected function checkNewView($pageId)
    {
        $visitorIp = $_SERVER['REMOTE_ADDR'];
        $isUniqueIp = $this->isUniqueView($visitorIp, $pageId);
        $addView = $this->addView($isUniqueIp, $visitorIp, $pageId);
        return $addView;
    }
}
