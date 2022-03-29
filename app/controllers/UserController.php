<?php

class UserController extends Controller
{
    /**
     * Function that displays all users who created an account in the website
     * @return view user/index with all information about the users
     */
    public function index()
    {
        $users = $this->model('User')->getAllUsers();
        $this->view('user/index', ["users" => $users]);
    }

    /**
     * Function that allows the Administrator to create a new user by giving it a name, an email, a password as well as a role
     * @return view with inputs to create the user with a message that tells if the creation was successfull or not
     */
    public function create()
    {
        if (isset($_POST["addUser"])) {
            $_POST = $this->secureArray($_POST);

            $user = $this->model('User');

            $checkUser = $this->model('User')->checkIfUsernameExists($_POST['username']);

            if ($checkUser == 0) {
                $checkEmail = $this->model('User')->checkIfEmailExists($_POST['email']);

                if ($checkEmail == 0) {

                    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        $user->username = $_POST['username'];
                        $user->email = $_POST['email'];
                        $user->passwordHash = password_hash($_POST["password"], PASSWORD_BCRYPT);
                        $_POST['role'] == "0" ? $user->role = "user" : $user->role = $_POST['role'];

                        $user->create();

                        $this->setMsg("success", "Nouvel utilisateur créé !");

                        header('Location: /user/index');
                    } else {
                        $this->setMsg("error", "Le format de l'e-mail n'est pas valide !");
                        $this->view('user/create');
                    }
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

    /**
     * Funtion that the Administrator to modify a user identified by its ID
     * @param int $userId = the ID of the user which will be modified
     * @return view with inputs to modify the user with a message that tells if the modification was successfull or not
     */
    public function edit($userId)
    {
        $editUser = $this->model('User')->getUserById($userId);

        if (isset($_POST["editUser"])) {
            $_POST = $this->secureArray($_POST);

            $checkUser = $this->model('User')->checkIfUsernameExists($_POST['username']);

            if ($checkUser == 0) {
                $checkEmail = $this->model('User')->checkIfEmailExists($_POST['email']);

                if ($checkEmail == 0) {
                    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        $editUser->username = $_POST['username'];
                        $editUser->email = $_POST['email'];
                        $_POST["password"] = "" ? $editUser->passwordHash = $editUser->passwordHash : $editUser->passwordHash = password_hash($_POST["password"], PASSWORD_BCRYPT);
                        $editUser->role = $_POST['role'];

                        $editUser->update();

                        $this->setMsg("success", "Utilisateur modifié avec succès !");

                        header('Location: /user/index');
                    } else {
                        $this->setMsg("error", "Le format de l'e-mail n'est pas valide !");
                        $this->view('user/edit');
                    }
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

    /**
     * Function that check if delete button is pressed and, if so, delete the user
     * @param int $userId = id of the user to delete
     * @return view of the deletion page with all the information about the user to be deleted
     */
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