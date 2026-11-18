<?php
declare(strict_types=1);

function c5_sanitizar_texto(?string $valor): string
{
    if ($valor === null) {
        return '';
    }

    return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
}

function c5_sanitizar_email(?string $valor): string
{
    if ($valor === null) {
        return '';
    }

    $email = filter_var(trim($valor), FILTER_SANITIZE_EMAIL);

    return is_string($email) ? $email : '';
}

function c5_repoblar(string $campo, array $datos): string
{
    return htmlspecialchars($datos[$campo] ?? '', ENT_QUOTES, 'UTF-8', false);
}

function c5_set_flash(string $tipo, string $mensaje): void
{
    $_SESSION['c5_flash'] = [
        'tipo' => $tipo,
        'mensaje' => $mensaje,
    ];
}

function c5_get_flash(): ?array
{
    $flash = $_SESSION['c5_flash'] ?? null;
    unset($_SESSION['c5_flash']);

    return is_array($flash) ? $flash : null;
}
