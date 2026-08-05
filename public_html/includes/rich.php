<?php
declare(strict_types=1);

/**
 * Editor-friendly rich text: *word* -> gold italic, newline -> line break.
 * Mirrors the original src/lib/text.js rich() helper. Escapes HTML first,
 * so editors typing plain text can never inject markup.
 */
function rich(string $s = ''): string
{
    $escaped = htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    $withItalic = preg_replace('/\*([^*]+)\*/', '<span class="italic">$1</span>', $escaped);
    return nl2br($withItalic, false);
}

/** Plain-escaped output helper for non-rich fields. */
function e(?string $s): string
{
    return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}
