<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UsersController
 * 
 * Automatically generated via CLI.
 */
class UsersController extends Controller {
    public function index()
    {
        $this->call->library('database');
        $this->call->model('UsersModel');

        $users = $this->UsersModel->all();

        $data['users'] = $users;
        $this->call->view('UserView', $data);
    }
}