# NOIR — Bespoke Atelier (PHP + custom lightweight CMS)

A luxury bespoke-tailoring website for [bespokebynoir.com](https://bespokebynoir.com),
built as plain PHP with a small, purpose-built admin panel. No database, no framework,
no third-party accounts required to run or edit it — everything lives in this one folder.

## Editing the site

1. Go to `yourdomain.com/admin/`.
2. **First time only:** you'll see "Create the admin account" — choose a username and
   password. This is the only time that screen appears.
3. After that, sign in normally. Pick a section (Home, The Atelier, Weddings, …),
   edit any text or swap any image, then click **Save**.
4. The change is live immediately — there's no build step or wait.

Notes for editors:
- In headline fields, wrap a word in `*asterisks*` for **gold italic**, and press
  Enter for a line break (shown under the field when it applies).
- Toggle **"Dim & warm this photo"** on any bright commission/wedding image so it sits
  in the dark palette.
- Use **+ Add** / **Remove** to add or delete items in a list (testimonials, gallery
  photos, house codes, etc.).

## How it's built

| | |
|---|---|
| Pages | Plain PHP templates in `public_html/*.php` (one per page) |
| Content | JSON files in `public_html/data/*.json` — one per page + `site.json` for nav/footer |
| Shared layout | `public_html/includes/layout_top.php` / `layout_bottom.php` (head, nav, curtain, footer) |
| Styles / JS / images | `public_html/css`, `public_html/js`, `public_html/assets/img` — unchanged design |
| Admin panel | `public_html/admin/` — schema-driven forms (`schema.php` defines every editable field) |
| Auth | Session + CSRF, bcrypt-hashed password in `data/admin-users.json` (gitignored, never committed) |

No Node, no build tool, no GitHub dependency to run the live site. This whole folder
*is* the deployable site.

## Run it locally

Requires PHP (8.1+; install via `brew install php` on macOS if you don't have it).

```bash
cd public_html
php -d upload_max_filesize=16M -d post_max_size=20M -S localhost:4650 -t . _devrouter.php
```

Then open **http://localhost:4650**. The `_devrouter.php` file only exists to mirror,
for local testing, the `.htaccess` protection that a real Apache/LiteSpeed host applies
automatically — it's not used in production and is blocked from being served if uploaded.

## Deploying to Hostinger (or any PHP host)

1. In hPanel, create the hosting plan / domain if you haven't already.
2. Upload the **entire contents of `public_html/`** into your hosting account's
   `public_html` folder (via the File Manager or FTP/SFTP) — the folder name should
   line up with what your host expects as the web root.
3. Make sure `public_html/assets/img/` and `public_html/data/` are **writable** by PHP
   (this is the default on most shared hosting; only relevant if uploads/saves fail).
4. Visit `yourdomain.com/admin/` and complete the one-time "Create the admin account" step.
5. That's it — no build, no deploy pipeline, no external service.

To update the design or add a new page later, edit the PHP/CSS/JS directly and
re-upload just the changed files.

## Security notes

- Passwords are bcrypt-hashed (`password_hash`); never stored or logged in plain text.
- Every save is protected by a CSRF token tied to the session.
- Uploaded images are validated by their actual file content (not the filename or
  claimed type), restricted to JPG/PNG/WEBP/AVIF/SVG, capped at 12MB, and renamed to a
  safe generated filename.
- `data/` and `includes/` are blocked from direct browser access via `.htaccess`.
- This is a small, purpose-built admin for one site with one or a few trusted editors —
  it does not aim to be a general-purpose CMS. Reasonable for a small business site;
  if the needs grow significantly (many editors, complex permissions, plugins), that's
  a sign to reconsider.

## Not yet wired (future, if wanted)

- The appointment form (`appointment.php`) submits visually but doesn't send anywhere
  yet — the button just reveals a confirmation message client-side. Now that this is a
  real PHP backend, wiring it to send an email or hit a booking API (Acuity, etc.) is a
  small, self-contained addition whenever you want it.
