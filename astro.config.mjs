import { defineConfig } from 'astro/config';

// Flat-file output (index.html, atelier.html, …) + relative asset paths keep the
// site working on the GitHub Pages project subpath (/bespoke-by-noir/) with no base config.
export default defineConfig({
  site: 'https://doshida.github.io',
  build: { format: 'file' },
  trailingSlash: 'never',
});
