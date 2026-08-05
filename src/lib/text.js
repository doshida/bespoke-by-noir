// Editor-friendly rich text: *word* -> gold italic, newline -> line break.
// Content is HTML-escaped first, so editors never touch raw HTML.
export function rich(s = '') {
  return String(s)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/\*([^*]+)\*/g, '<span class="italic">$1</span>')
    .replace(/\n/g, '<br>');
}
