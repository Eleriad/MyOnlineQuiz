<?php

class LoginController extends Controller
{
    /**
     * Function that check if user already exists and, if not, insert him into the DB
     * @return void
     */
    public function register()
    {
        // PAGE AND VIEWS
        $pageId = 2;
        $title = "Page d'inscription";
        $this->checkPage($pageId, $title);
        $this->checkNewView($pageId);

        // REGISTERING
        if (isset($_POST["register"])) {

            // USER CHECKING
            $user = $this->model('User');
            $verifyUserName = $user->findUserByName($_POST["username"]);
            $verifyUserMail = $user->findUserByMail($_POST["email"]);

            // FINAL CHECKING
            if ($verifyUserName == null) {
                if ($verifyUserMail == null) {
                    if ($_POST["password"] == $_POST["checkPassword"]) {
                        // CREATTING NEW USER
                        $user->username = $_POST["username"];
                        $user->email = $_POST["email"]; // TODO : vérifier si l'email est au bon format avec une regex ou JS
                        $user->password_hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
                        $user->create();
                        // SUCCESS MESSAGE
                        $this->setMsg("success", "L'utilisateur a bien été créé ! Vous pouvez vous connecter pour découvrir notre jeu de quiz !");
                        // REDIRECTION
                        header('Location: /home/index');
                    } else {
                        $this->setMsg("error", "Les mots de passe ne sont pas identiques !");
                        $this->view('login/register');
                    }
                } else {
                    $this->setMsg("error", "Cet email est déjà utilisé !");
                    $this->view('login/register');
                }
            } else {
                $this->setMsg("error", "Cet identifiant est déjà utilisé !");
                $this->view('login/register');
            }
        } else {
            $this->view('login/register', ["title" => $title]);
        }
    }
}