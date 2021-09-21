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

            $user->username = $_POST['username'];
            $user->email = $_POST['email']; // TODO : vérifier si l'email est au bon format avec une regex
            $user->password_hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $user->role = $_POST['role'];

            $user->create();

            header('Location: /user/index');
        } else {
            $this->view('user/create');
        }
    }

    public function edit($userId)
    {

        $editUser = $this->model('User')->getUserById($userId);

        if (isset($_POST["editUser"])) {

            $editUser->username = $_POST['username'];
            $editUser->email = $_POST['email']; // TODO : vérifier si l'email est au bon format avec une regex
            $_POST["password"] = "" ? $editUser->password_hash = $editUser->password_hash : $editUser->password_hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $editUser->role = $_POST['role'];

            $editUser->update();

            header('Location: /user/index');
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