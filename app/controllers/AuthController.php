<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->library('database');
        $this->call->model('AuthModel');
    }

    public function login()
    {
        $this->call->view('auth/login');
    }

    public function authenticate()
    {
        $username = trim($this->io->post('username'));
        $password = $this->io->post('password');

        $user = $this->AuthModel->find_by('username', $username);

       
        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Invalid username or password.';
            redirect('login');
            return;
        }
    
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];

        redirect('products');
    }

    
}