# NOIR — Bespoke Atelier

A luxury redesign of [bespokebynoir.com](https://bespokebynoir.com) — a by-appointment
bespoke tailoring atelier in Atlanta. Rebuilt as a dark, cinematic, editorial
experience that positions NOIR as a **bespoke house first** (individuals, C-suite,
executives), with weddings as one occasion among several.

Static, dependency-free (vanilla HTML/CSS/JS). No build step, no framework, no cart.
One action throughout: **Request a Private Appointment.**

## Run

Any static server from this folder, e.g.:

```bash
python3 -m http.server 4599
```

Then open http://localhost:4599 — or just open `index.html` directly.

## Pages

| File | Page |
|------|------|
| `index.html` | Home — hero, invitation, the ritual, the atelier, C-suite wardrobe, commissions, testimonials, CTA |
| `atelier.html` | The Atelier — founder story, house codes, the space |
| `process.html` | The Process — five-act editorial ritual |
| `commissions.html` | Commissions — filterable portfolio (Business / Black Tie / Ceremony) |
| `appointment.html` | Request an Appointment — the conversion form (front-end only) |
| `journal.html` | Journal — editorial magazine cards |

## Design system

- **Palette:** ink `#0E0D0B`, charcoal `#161411`, bone `#EDE7DC`, champagne gold `#C9A96A`. No bright white anywhere.
- **Type:** Cormorant Garamond (display) + Jost (labels/body), via Google Fonts.
- **Motion:** gold-line monogram preloader, fade-and-rise scroll reveals, custom gold-dot cursor, hero Ken Burns, horizontal-scroll commissions. Respects `prefers-reduced-motion`.
- **Shared:** `css/noir.css`, `js/noir.js`.

## Imagery

`assets/img/` — cinematic low-key photography generated with Gemini (Nano Banana Pro),
plus the one real client photo carried over from the current site
(`commission-wedding.jpg`, tonally harmonised via the `.tone-noir` class).
To regenerate or add photography, replace files in `assets/img/` keeping the same names.

> `?shot=1` on any URL disables the preloader and forces all reveals visible —
> used only for full-page screenshots.

## Notes for going live

- The appointment form is front-end only — wire `js/noir.js` `form.submit` to an
  email/Acuity/CRM endpoint, or point it at the studio's booking backend.
- Update the footer email (`atelier@bespokebynoir.com`) and Instagram link.
- Legal links live in the footer by design (kept out of the header).
