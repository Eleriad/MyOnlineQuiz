<?php

class UserController extends Controller
{
    public function index()
    {
        $users = $this->model('User')->getAllUsers();
        $this->view('user/index', ["users" => $users]);
    }

    public function create()
    {
        if (isset($_POST["addUser"])) {

            $user = $this->model('User');

            $checkUser = $this->model('User')->checkIfUsernameExists($_POST['username']);

            if ($checkUser == 0) {
                $checkEmail = $this->model('User')->checkIfEmailExists($_POST['email']);

                if ($checkEmail == 0) {
                    $user->username = $_POST['username'];
                    $user->email = $_POST['email']; // TODO : vérifier si l'email est au bon format avec une regex
                    $user->passwordHash = password_hash($_POST["password"], PASSWORD_BCRYPT);
                    $_POST['role'] == "0" ? $user->role = "user" : $user->role = $_POST['role'];

                    $user->create();

                    $this->setMsg("success", "Nouvel utilisateur créé !");

                    header('Location: /user/index');
                } else if ($checkEmail == 1) {
                    $this->setMsg("error", "Cet email est déjà utilisé par un autre utilisateur !");
                    $this->view('user/create');
                }
            } else if ($checkUser == 1) {
                $this->setMsg("error", "Ce nom d'utilisateur existe déjà !");
                $this->view('user/create');
            }
        } else {
            $this->view('user/create');
        }
    }

    public function edit($userId)
    {

        $editUser = $this->model('User')->getUserById($userId);

        if (isset($_POST["editUser"])) {

            $checkUser = $this->model('User')->checkIfUsernameExists($_POST['username']);

            if ($checkUser == 0) {
                $checkEmail = $this->model('User')->checkIfEmailExists($_POST['email']);

                if ($checkEmail == 0) {
                    $editUser->username = $_POST['username'];
                    $editUser->email = $_POST['email']; // TODO : vérifier si l'email est au bon format avec une regex
                    $_POST["password"] = "" ? $editUser->passwordHash = $editUser->passwordHash : $editUser->passwordHash = password_hash($_POST["password"], PASSWORD_BCRYPT);
                    $editUser->role = $_POST['role'];

                    $editUser->update();

                    $this->setMsg("success", "Utilisateur modifié avec succès !");

                    header('Location: /user/index');
                } else if ($checkEmail == 1) {
                    $this->setMsg("error", "Cet email est déjà utilisé par un autre utilisateur !");
                    $this->view('user/edit');
                }
            } else if ($checkUser == 1) {
                $this->setMsg("error", "Ce nom d'utilisateur existe déjà !");
                $this->view('user/edit');
            }
        } else {
            $this->view('user/edit', ["editUser" => $editUser]);
        }
    }

    public function delete($userId)
    {
        $deleteUser = $this->model('User')->getUserById($userId);

        if (isset($_POST['deleteUser'])) {
            $deleteUser->delete();
            header('Location: /user/index');
        } else {
            $this->view('user/delete', ["deleteUser" => $deleteUser]);
        }
    }
}