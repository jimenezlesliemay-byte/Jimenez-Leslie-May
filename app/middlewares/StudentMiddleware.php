<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * StudentMiddleware
 * ------------------------------------------------------------------
 * Laboratory Activity 3, Part E — protects /student/profile.
 *
 * Access condition (the "unique middleware access condition" the
 * activity's individualization section asks for): a visitor is only
 * let through if they have loaded the /student home page at least
 * once in this session. StudentController::index() is what sets
 * $_SESSION['student_access'] = true.
 *
 * This means jumping straight to /student/profile in the browser
 * without ever visiting /student first gets redirected back — a
 * real, demonstrable "unauthorized access" case you can screenshot,
 * rather than a condition that is always true.
 *
 * Registered under the 'student' alias in app/config/middleware.php
 * and attached only to the profile route in app/config/routes.php.
 */
class StudentMiddleware
{
    public function handle(Closure $next)
    {
        if (!isset($_SESSION['student_access'])) {
            $_SESSION['student_notice'] = 'Access denied — please open the Student Home page first.';
            redirect('student');
            return;
        }

        return $next();
    }
}
