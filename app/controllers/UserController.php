<?php

class UserController extends Controller
{
    public function index()
    {
        $users = $this->model('User')->getAllUsers();
        $this->view('user/index', ["users" => $users]);
    }
}