<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/env.php';

$titulo_pagina = isset($titulo_pagina) && is_string($titulo_pagina) && trim($titulo_pagina) !== ''
    ? trim($titulo_pagina)
    : 'Inicio';
$descripcion_pagina = isset($descripcion_pagina) && is_string($descripcion_pagina)
    ? trim($descripcion_pagina)
    : 'Aplicación escolar del Colegio Horizonte.';
$assetBase = (defined('APP_BASE_URL') && APP_BASE_URL !== '') ? APP_BASE_URL : '.';
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= htmlspecialchars($descripcion_pagina, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
    <meta name="theme-color" content="#E8F0EC">
    <title><?= htmlspecialchars($titulo_pagina, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> | <?= htmlspecialchars(APP_NAME, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/assets/css/style.css">
    <link rel="icon" type="image/svg+xml" href="<?= htmlspecialchars($assetBase . '/assets/img/favicon.svg', ENT_QUOTES, 'UTF-8') ?>">
    <style>
        :root {
            --bg-sidebar: #E8F0EC;
            --border-sidebar: #D8E2DC;
            --color-primary: #1A3024;
            --bg-main: #F8F9FA;
        }

        body {
            background-color: var(--bg-main);
        }
    </style>
</head>
<body>
<div class="container-fluid p-3">
    <div class="row g-3">
