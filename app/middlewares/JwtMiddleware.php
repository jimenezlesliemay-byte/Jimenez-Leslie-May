<?php
class JwtMiddleware
{
    public function handle(Closure $next)
    {
        $lava = lava_instance();
        $lava->call->library('api');   // sends CORS headers and answers browser preflight (OPTIONS) itself
        $lava->api->require_jwt();     // returns 401 JSON if the token is missing or invalid
        return $next();
    }
}