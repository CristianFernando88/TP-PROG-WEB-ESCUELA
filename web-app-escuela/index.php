<?php
declare(strict_types=1);

session_start();

if (isset($_SESSION['rol'])) {
    header('Location: dashboard.php');
    exit;
}

header('Location: login.php');
exit;