<?php

class HomeController extends Controller
{
    public function index()
    {
        if (isset($_POST["login"])) {
            $user = $this->model('User')->findUserByMail($_POST["email"]);

            if ($user != null && password_verify($_POST["password"], $user->password_hash)) {
                session_start();
                $_SESSION["user_id"] = $user->id;
                header('Location: /quiz/index');
            } else {
                $this->view('home/index', 'Erreur de connexion : combinaison indentifiant / mot de passe incorrecte !');
            }
        } else {
            $this->view('home/index');
        }


        $this->view('home/index');
    }
}