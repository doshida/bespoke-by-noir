<?php
declare(strict_types=1);

define('UPLOAD_DIR', __DIR__ . '/../assets/img');
define('UPLOAD_MAX_BYTES', 12 * 1024 * 1024); // 12MB — generous for high-res photography

const ALLOWED_MIME = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp',
    'image/avif' => 'avif',
    'image/svg+xml' => 'svg',
];

class UploadException extends \RuntimeException {}

/**
 * Validate and store one uploaded image. Returns the new relative path
 * (e.g. "assets/img/xxxxxxxx.jpg") to store in the JSON content.
 *
 * @param array $file One $_FILES-style entry: ['name','type','tmp_name','error','size']
 */
function handle_upload(array $file): string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        throw new UploadException('No file was uploaded.');
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new UploadException('Upload failed (error code ' . $file['error'] . ').');
    }
    if (!is_uploaded_file($file['tmp_name'])) {
        throw new UploadException('Invalid upload.');
    }
    if ($file['size'] <= 0 || $file['size'] > UPLOAD_MAX_BYTES) {
        throw new UploadException('Image is too large (max 12MB).');
    }

    // Trust the file's actual content, not the client-supplied MIME type / filename.
    $detected = mime_content_type($file['tmp_name']);
    if ($detected === false || !isset(ALLOWED_MIME[$detected])) {
        throw new UploadException('Unsupported image type. Use JPG, PNG, WEBP, AVIF, or SVG.');
    }
    $ext = ALLOWED_MIME[$detected];

    if (!is_dir(UPLOAD_DIR) && !mkdir(UPLOAD_DIR, 0755, true) && !is_dir(UPLOAD_DIR)) {
        throw new UploadException('Could not access the images folder.');
    }

    $safeName = preg_replace('/[^a-z0-9-]+/', '-', strtolower(pathinfo($file['name'], PATHINFO_FILENAME)));
    $safeName = trim($safeName, '-');
    if ($safeName === '') {
        $safeName = 'image';
    }
    $filename = $safeName . '-' . substr(bin2hex(random_bytes(4)), 0, 8) . '.' . $ext;
    $dest = UPLOAD_DIR . '/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        throw new UploadException('Could not save the uploaded image.');
    }
    chmod($dest, 0644);

    return 'assets/img/' . $filename;
}

/**
 * Recursively reshapes PHP's ugly nested $_FILES structure (for
 * name="data[a][b]" style file inputs) into a normal nested array where each
 * leaf is a single-file array — matching the shape of $_POST['data'].
 */
function normalize_files(array $files): array
{
    $out = [];
    foreach ($files as $key => $val) {
        foreach (['name', 'type', 'tmp_name', 'error', 'size'] as $attr) {
            walk_files_attr($out, [$key], $attr, $val[$attr]);
        }
    }
    return $out;
}

function walk_files_attr(array &$out, array $path, string $attr, $value): void
{
    if (is_array($value)) {
        foreach ($value as $k => $v) {
            walk_files_attr($out, array_merge($path, [$k]), $attr, $v);
        }
        return;
    }
    $ref = &$out;
    foreach ($path as $p) {
        if (!isset($ref[$p]) || !is_array($ref[$p])) {
            $ref[$p] = [];
        }
        $ref = &$ref[$p];
    }
    $ref[$attr] = $value;
}
