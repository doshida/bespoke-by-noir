# NOIR — Bespoke Atelier (Astro + CMS)

A luxury bespoke-tailoring website for [bespokebynoir.com](https://bespokebynoir.com),
built with **Astro** (static output) and edited through **Pages CMS** — a friendly,
no-code admin panel. Content lives as JSON; publishing rebuilds and deploys automatically.

**Live:** https://doshida.github.io/bespoke-by-noir/

## Editing content (for the atelier)

1. Go to **https://app.pagescms.org** and **Sign in with GitHub**.
2. Open the **bespoke-by-noir** project.
3. Pick a page in the sidebar (Home, The Atelier, Weddings, …), edit any text or
   swap any image with the picker, then click **Save**.
4. The site rebuilds and goes live on its own in ~1 minute.

Notes for editors:
- In headline fields, wrap a word in `*asterisks*` to make it **gold italic**, and press
  Enter for a line break.
- Toggle **"Dim & warm this photo"** on any *bright* commission/wedding image so it sits in
  the dark palette.

## How it's built

| | |
|---|---|
| Framework | Astro (static site generator) — output is plain fast HTML |
| Content | JSON files in `src/data/` (one per page + `site.json` for nav/footer) |
| Templates | `src/pages/*.astro` render each page from its JSON via `src/layouts/Layout.astro` |
| Styles / JS / images | `public/css`, `public/js`, `public/assets/img` (served as-is) |
| CMS | Pages CMS, configured by `.pages.yml` |
| Deploy | GitHub Actions (`.github/workflows/deploy.yml`) → GitHub Pages on every push to `main` |

Design system (palette, type, motion) is unchanged and documented in `public/css/noir.css`.

## Local development

```bash
npm install
npm run dev      # http://localhost:4321
npm run build    # outputs to dist/
npm run preview  # serve the production build
```

Editing a JSON file in `src/data/` and refreshing shows the change — the CMS just does
this for you through a UI and commits it to GitHub.

## Adding a new image without the CMS

Drop the file into `public/assets/img/` and reference it as `assets/img/your-file.jpg`
in the relevant `src/data/*.json`.
