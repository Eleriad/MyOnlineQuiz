<?php

class HomeController extends Controller
{
    /**
     * Function that displays the home/index view and allows any visitor to sing in or log in
     * @return void
     */
    public function index()
    {
        // PAGE AND VIEWS
        $pageId = 1;
        $title = "Page de connexion";
        $this->checkPage($pageId, $title);
        $this->checkNewView($pageId);

        // LOGIN
        if (isset($_POST["login"])) {
            $_POST = $this->secureArray($_POST);

            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $user = $this->model('User')->findUserByMail($_POST["email"]);

                if ($user != null and password_verify($_POST["password"], $user->password_hash)) {
                    // START SESSION
                    session_start();
                    $_SESSION["user_id"] = $user->id;
                    $_SESSION["role"] = $user->role;
                    // REDIRECTION
                    header('Location: /public/index');
                } else {
                    $this->setMsg("error", "Combinaison identifiant / mot de passe incorrecte !");
                    $this->view('home/index', ["title" => $title]);
                }
            } else {
                $this->setMsg("error", "Le format de l'adresse mail est incorrect !");
                $this->view('home/index', ["title" => $title]);
            }
        } else {
            $this->view('home/index', ["title" => $title]);
        }

        // CHECKING IF SESSION EXISTS
        if (isset($_SESSION) && isset($_SESSION["user_id"])) {
            header('Location: /public/index');
        } else {
            $this->view('home/index', ["title" => $title]);
        }
    }

    public function disconnection()
    {
        $this->disconnect();
        header('Location: /home/index');
    }
}