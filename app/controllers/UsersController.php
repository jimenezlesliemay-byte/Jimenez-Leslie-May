<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->library('database');
        $this->call->model('UsersModel');
    }

    // READ
    public function index()
    {
        $data['records'] = $this->UsersModel->all();
        $this->call->view('dbcrud/index', $data);
    }

    public function create()
    {
        $this->call->view('dbcrud/create');
    }

    // CREATE
    public function store()
    {
        $username = trim($this->io->post('username'));
        $password = $this->io->post('password');
        $confirm  = $this->io->post('confirm_password');

        if ($username === '' || $password === '' || $confirm === '') {
            $_SESSION['error'] = 'Lahat ng fields ay required.';
            redirect('users/create');
            return;
        }

        if ($password !== $confirm) {
            $_SESSION['error'] = 'Hindi magkatugma ang password at confirm password.';
            redirect('users/create');
            return;
        }

        $this->UsersModel->insert([
            'username'         => $username,
            'password'         => password_hash($password, PASSWORD_DEFAULT),
            'confirm_password' => password_hash($confirm, PASSWORD_DEFAULT),
        ]);

        $_SESSION['success'] = 'Na-add na ang record.';
        redirect('users');
    }

    public function edit($id)
    {
        $record = $this->UsersModel->find($id);

        if (!$record) {
            $_SESSION['error'] = 'Record not found.';
            redirect('users');
            return;
        }

        $data['record'] = $record;
        $this->call->view('dbcrud/edit', $data);
    }

    // UPDATE
    public function update($id)
    {
        $username = trim($this->io->post('username'));
        $password = $this->io->post('password');
        $confirm  = $this->io->post('confirm_password');

        $updateData = ['username' => $username];

        if (!empty($password) || !empty($confirm)) {
            if ($password !== $confirm) {
                $_SESSION['error'] = 'Hindi magkatugma ang password at confirm password.';
                redirect('users/edit/'.$id);
                return;
            }
            $updateData['password']         = password_hash($password, PASSWORD_DEFAULT);
            $updateData['confirm_password'] = password_hash($confirm, PASSWORD_DEFAULT);
        }

        $this->UsersModel->update($id, $updateData);

        $_SESSION['success'] = 'Na-update na ang record.';
        redirect('users');
    }

    // DELETE
    public function delete($id)
    {
        $this->UsersModel->delete($id);
        $_SESSION['success'] = 'Na-delete na ang record.';
        redirect('users');
    }
}