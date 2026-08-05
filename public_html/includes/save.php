<?php
declare(strict_types=1);

/**
 * Walks the schema and rebuilds the content array from submitted form data,
 * uploading any new images along the way. $post/$files are already scoped to
 * this collection (i.e. $_POST['data'] / normalize_files($_FILES)['data']).
 *
 * @throws UploadException if an uploaded image is invalid
 */
function build_save_data(array $fields, array $post, array $files): array
{
    $out = [];
    foreach ($fields as $f) {
        $name = $f['name'];
        $out[$name] = build_save_field($f, $post[$name] ?? null, $files[$name] ?? null);
    }
    return $out;
}

function build_save_field(array $f, $post, $files)
{
    switch ($f['type']) {
        case 'string':
        case 'text':
        case 'text-nl':
        case 'text-rich':
            return is_string($post) ? $post : '';

        case 'boolean':
            return $post === '1';

        case 'image':
            if (is_array($files) && ($files['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
                return handle_upload($files);
            }
            return is_string($post) ? $post : '';

        case 'group':
            return build_save_data($f['fields'], is_array($post) ? $post : [], is_array($files) ? $files : []);

        case 'list':
            $items = [];
            foreach ((is_array($post) ? $post : []) as $key => $itemPost) {
                $itemFiles = (is_array($files) && isset($files[$key])) ? $files[$key] : [];
                $items[] = build_save_data($f['fields'], is_array($itemPost) ? $itemPost : [], $itemFiles);
            }
            return array_values($items);

        case 'list-string':
            $items = [];
            foreach ((is_array($post) ? $post : []) as $v) {
                $items[] = is_string($v) ? $v : '';
            }
            return array_values($items);

        default:
            return $post;
    }
}
