<?php
/**
 * Local-dev-only router for `php -S`.
 * PHP's built-in server doesn't read .htaccess, so this mirrors that protection
 * (blocking direct access to /data/ and /includes/) for local testing parity
 * with real Apache/LiteSpeed hosting. Not used in production.
 */
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (preg_match('#^/(data|includes)/#', $path)) {
    http_response_code(404);
    echo 'Not found';
    return true;
}

return false; // let the built-in server handle everything else normally
