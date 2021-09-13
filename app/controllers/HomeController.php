<?php

class HomeController extends Controller
{
    public function index()
    {
        // PAGE AND VIEWS
        $pageId = 1;
        $title = "Page de connexion";
        $this->checkPage($pageId, $title);
        $this->checkNewView($pageId);


        // LOGIN
        if (isset($_POST["login"])) {
            // var_dump($_SESSION);

            $user = $this->model('User')->findUserByMail($_POST["email"]);

            if ($user != null and password_verify($_POST["password"], $user->password_hash)) {
                session_start();
                $_SESSION["user_id"] = $user->id;
                $_SESSION["role"] = $user->role;
                header('Location: /public/index');
            } else {
                $this->setMsg("error", "Combinaison identifiant / mot de passe incorrecte !");
                $this->view('home/index', ["title" => $title]);
            }
        } else {
            $this->view('home/index', ["title" => $title]);
        }
        $this->view('home/index', ["title" => $title]);
    }

    // TODO : disconnect function à revoir !!!
    public function disconnect()
    {
        $title = "Page de connexion";
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

        $this->view('home/index', ["title" => $title]);
    }
}