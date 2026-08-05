<?php
declare(strict_types=1);

define('DATA_DIR', __DIR__ . '/../data');

/** Load a page's content JSON as an associative array. */
function load_json(string $name): array
{
    $path = DATA_DIR . '/' . basename($name) . '.json';
    if (!is_file($path)) {
        return [];
    }
    $raw = file_get_contents($path);
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

/** Save an associative array back to a page's content JSON (pretty-printed). */
function save_json(string $name, array $data): bool
{
    $path = DATA_DIR . '/' . basename($name) . '.json';
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        return false;
    }
    return file_put_contents($path, $json . "\n", LOCK_EX) !== false;
}
