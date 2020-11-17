<?php

class LoginController extends Controller
{
    public function index()
    {
        if (isset($_POST["login"])) {
            $user = $this->model('User')->findUserByMail($_POST["email"]);

            if ($user != null && password_verify($_POST["password"], $user->password_hash)) {
                $_SESSION["user_id"] = $user->id;
                header('Location: /quiz/index');
            } else {
                $this->view('login/index', 'Erreur de connexion : combinaison indentifiant / mot de passe incorrecte !');
            }
        } else {
            $this->view('login/index');
        }
    }

    public function register()
    {
        if (isset($_POST["register"])) {
            $user = $this->model('User');
            $verifyUserName = $user->findUserByName($_POST["username"]);
            $verifyUserMail = $user->findUserByMail($_POST["email"]);

            if ($verifyUserName == null) {
                if ($verifyUserMail == null) {
                    if ($_POST["password"] == $_POST["checkPassword"]) {
                        $user->username = $_POST["username"];
                        $user->email = $_POST["email"];
                        $user->password_hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
                        $user->create();
                        header('Location: /login/index');
                    } else {
                        $this->view('login/register', "Les mots de passe ne sont pas identiques !");
                    }
                } else {
                    $this->view('login/register', "Cet email est déjà utilisé !");
                }
            } else {
                $this->view('login/register', "Cet identifiant est déjà utilisé !");
            }
        } else {
            $this->view('login/register');
        }
    }
}
