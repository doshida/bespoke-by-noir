<?php
declare(strict_types=1);

function field_label(array $f): string
{
    if (!empty($f['label'])) {
        return $f['label'];
    }
    $spaced = preg_replace('/(?<!^)[A-Z]/', ' $0', $f['name']);
    return ucfirst((string) $spaced);
}

/** Renders a list of sibling fields (used at the top level and inside groups). */
function render_fields(array $fields, array $value, string $path): string
{
    $html = '';
    foreach ($fields as $f) {
        $html .= render_field($f, $value[$f['name']] ?? null, $path . '[' . $f['name'] . ']');
    }
    return $html;
}

function render_field(array $f, $value, string $path): string
{
    $label = e(field_label($f));
    $hint = !empty($f['hint']) ? '<p class="f-hint">' . e($f['hint']) . '</p>' : '';

    switch ($f['type']) {
        case 'string':
            return "<div class=\"f\"><label>{$label}</label>"
                . "<input type=\"text\" name=\"{$path}\" value=\"" . e((string) ($value ?? '')) . "\">"
                . "{$hint}</div>";

        case 'text':
        case 'text-nl':
        case 'text-rich':
            return "<div class=\"f\"><label>{$label}</label>"
                . "<textarea name=\"{$path}\" rows=\"4\">" . e((string) ($value ?? '')) . "</textarea>"
                . "{$hint}</div>";

        case 'boolean':
            $checked = !empty($value) ? ' checked' : '';
            return "<div class=\"f f-bool\"><label class=\"f-checkline\">"
                . "<input type=\"hidden\" name=\"{$path}\" value=\"0\">"
                . "<input type=\"checkbox\" name=\"{$path}\" value=\"1\"{$checked}> {$label}</label></div>";

        case 'image':
            $val = (string) ($value ?? '');
            $preview = $val !== ''
                ? '<img class="f-thumb" src="../' . e($val) . '" alt="">'
                : '<span class="f-thumb f-thumb--empty">No image</span>';
            return "<div class=\"f f-image\"><label>{$label}</label>"
                . "<div class=\"f-image-row\">{$preview}"
                . "<div><input type=\"hidden\" name=\"{$path}\" value=\"" . e($val) . "\">"
                . "<input type=\"file\" name=\"{$path}\" accept=\"image/jpeg,image/png,image/webp,image/avif,image/svg+xml\">"
                . "<p class=\"f-hint\">Leave blank to keep the current image.</p></div></div></div>";

        case 'group':
            return "<fieldset class=\"f-group\"><legend>{$label}</legend>"
                . render_fields($f['fields'], is_array($value) ? $value : [], $path)
                . "</fieldset>";

        case 'list':
            return render_list($f, is_array($value) ? array_values($value) : [], $path);

        case 'list-string':
            return render_list_string($f, is_array($value) ? array_values($value) : [], $path);

        default:
            return '';
    }
}

function render_list(array $f, array $items, string $path): string
{
    $label = e(field_label($f));
    $itemsHtml = '';
    foreach ($items as $i => $item) {
        $itemsHtml .= render_list_item($f['fields'], is_array($item) ? $item : [], $path, (string) $i);
    }
    $template = render_list_item($f['fields'], [], $path, '__INDEX__');

    return "<fieldset class=\"f-list\" data-list-name=\"" . e($f['name']) . "\"><legend>{$label}</legend>"
        . "<div class=\"f-list-items\">{$itemsHtml}</div>"
        . "<template class=\"f-list-template\">{$template}</template>"
        . "<button type=\"button\" class=\"f-add\">+ Add</button>"
        . "</fieldset>";
}

function render_list_item(array $childFields, array $item, string $path, string $idx): string
{
    $inner = render_fields($childFields, $item, $path . '[' . $idx . ']');
    return "<div class=\"f-list-item\">{$inner}"
        . "<button type=\"button\" class=\"f-remove\">Remove</button></div>";
}

function render_list_string(array $f, array $items, string $path): string
{
    $label = e(field_label($f));
    $itemType = $f['itemType'] ?? 'string';
    $itemsHtml = '';
    foreach ($items as $i => $v) {
        $itemsHtml .= render_list_string_item($itemType, (string) $v, $path, (string) $i);
    }
    $template = render_list_string_item($itemType, '', $path, '__INDEX__');

    return "<fieldset class=\"f-list\" data-list-name=\"" . e($f['name']) . "\"><legend>{$label}</legend>"
        . "<div class=\"f-list-items\">{$itemsHtml}</div>"
        . "<template class=\"f-list-template\">{$template}</template>"
        . "<button type=\"button\" class=\"f-add\">+ Add</button>"
        . "</fieldset>";
}

function render_list_string_item(string $itemType, string $value, string $path, string $idx): string
{
    $name = $path . '[' . $idx . ']';
    $input = $itemType === 'text'
        ? "<textarea name=\"{$name}\" rows=\"3\">" . e($value) . '</textarea>'
        : "<input type=\"text\" name=\"{$name}\" value=\"" . e($value) . '">';
    return "<div class=\"f-list-item f-list-item--string\">{$input}"
        . "<button type=\"button\" class=\"f-remove\">Remove</button></div>";
}
