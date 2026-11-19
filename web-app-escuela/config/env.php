<?php
declare(strict_types=1);

$envFile = dirname(__DIR__) . '/.env';
$envValues = [];

if (is_file($envFile)) {
    $parsedValues = parse_ini_file($envFile, false, INI_SCANNER_RAW);

    if ($parsedValues === false) {
        throw new RuntimeException('No se pudo leer el archivo .env.');
    }

    $envValues = $parsedValues;
}

$getConfigValue = static function (string $key, string $default) use ($envValues): string {
    $processValue = getenv($key);
    $value = $processValue !== false ? $processValue : ($envValues[$key] ?? $default);

    if (!is_string($value) || trim($value) === '') {
        return $default;
    }

    return trim($value);
};

if (!defined('APP_NAME')) {
    define('APP_NAME', $getConfigValue('APP_NAME', 'Colegio Horizonte'));
}

if (!defined('SUPPORT_EMAIL')) {
    define('SUPPORT_EMAIL', $getConfigValue('SUPPORT_EMAIL', 'soporte@colegiohorizonte.edu.ar'));
}

if (!filter_var(SUPPORT_EMAIL, FILTER_VALIDATE_EMAIL)) {
    throw new UnexpectedValueException('SUPPORT_EMAIL debe contener una dirección de correo válida.');
}

if (!defined('APP_ENV')) {
    define('APP_ENV', $getConfigValue('APP_ENV', 'local'));
}

if (!defined('APP_BASE_URL')) {
    define('APP_BASE_URL', rtrim($getConfigValue('APP_BASE_URL', ''), '/'));
}

if (!defined('DB_HOST')) {
    define('DB_HOST', $getConfigValue('DB_HOST', 'localhost'));
}

if (!defined('DB_NAME')) {
    define('DB_NAME', $getConfigValue('DB_NAME', 'colegio_horizonte'));
}

if (!defined('DB_USER')) {
    define('DB_USER', $getConfigValue('DB_USER', 'root'));
}

if (!defined('DB_PASS')) {
    define('DB_PASS', $getConfigValue('DB_PASS', ''));
}

if (!defined('DB_CHARSET')) {
    define('DB_CHARSET', $getConfigValue('DB_CHARSET', 'utf8mb4'));
}

if (!defined('DB_PORT')) {
    define('DB_PORT', $getConfigValue('DB_PORT', '3306'));
}
