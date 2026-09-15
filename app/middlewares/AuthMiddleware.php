<?php
class AuthMiddleware
{
    public function handle(Closure $next)
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Please log in to continue.';
            redirect('login');
            return;
        }

        return $next();
    }
}