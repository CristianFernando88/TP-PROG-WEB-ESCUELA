<?php
declare(strict_types=1);

session_start();
session_unset();
session_destroy();

$cookieParams = session_get_cookie_params();
setcookie(
    session_name(),
    '',
    time() - 42000,
    $cookieParams['path'],
    $cookieParams['domain'],
    $cookieParams['secure'],
    $cookieParams['httponly']
);

header('Location: login.php');
exit;
