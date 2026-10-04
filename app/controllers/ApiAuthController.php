<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('AuthModel');
    }

    public function register()
    {
        $b = $this->api->body();
        foreach (['firstname', 'lastname', 'email', 'username', 'password'] as $f) {
            if (empty($b[$f])) $this->api->respond_error("$f is required", 422);
        }
        if ($this->AuthModel->find_by('username', $b['username'])) {
            $this->api->respond_error('Username already taken', 409);
        }
        if ($this->AuthModel->find_by('email', $b['email'])) {
            $this->api->respond_error('Email already registered', 409);
        }

        $this->AuthModel->insert([
            'firstname' => $b['firstname'],
            'lastname'  => $b['lastname'],
            'email'     => $b['email'],
            'username'  => $b['username'],
            'password'  => password_hash($b['password'], PASSWORD_DEFAULT),
        ]);
        $this->api->respond(['message' => 'User registered'], 201);
    }

    public function login()
    {
        $b    = $this->api->body();
        $user = $this->AuthModel->find_by('username', trim($b['username'] ?? ''));

        if (!$user || !($user['is_active'] ?? 1) || !password_verify($b['password'] ?? '', $user['password'])) {
            $this->api->respond_error('Invalid username or password', 401);
        }

        $tokens = $this->api->issue_tokens(['id' => $user['id'], 'role' => $user['role'] ?? 'user']);
        $this->api->respond([
            'message' => 'Login successful',
            'user'    => ['id' => $user['id'], 'username' => $user['username']],
            'tokens'  => $tokens,
        ]);
    }

    public function refresh()
    {
        $b = $this->api->body();
        $this->api->refresh_access_token($b['refresh_token'] ?? '');
    }

    public function logout()
    {
        $b = $this->api->body();
        $this->api->revoke_refresh_token($b['refresh_token'] ?? '');
        $this->api->respond(['message' => 'Logged out']);
    }
}