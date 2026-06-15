<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';

spl_autoload_register(function (string $className): void {
    $path = __DIR__ . '/../classes/' . $className . '.php';

    if (is_file($path)) {
        require_once $path;
    }
});

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}
