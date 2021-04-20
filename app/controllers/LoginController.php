<?php

class LoginController extends Controller
{
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
                        header('Location: /home/index');
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

    public function password()
    {
        echo "mot de passe oublié ! Bien fait !!!";
    }
}