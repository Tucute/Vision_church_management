# UI Design System Compliance Review — 2026-09-24

Reviewed against `docs/UI_RULES.md` / `.agents/UI_RULES.md`.

## Issues found and fixed

| # | Area | File | Problem | Fix applied |
|---|------|------|---------|-------------|
| 1 | Colors | `public/*.blade.php` (non-home) | Indigo/slate/green/amber utilities | Refactored to design tokens + shared components |
| 2 | Colors | `button.blade.php` | Hardcoded hex disabled/hover | Tokenized (`brand-disabled`, `danger-hover`, etc.) |
| 3 | Colors | Filament providers | Amber / Emerald primaries | Both panels `Color::hex('#006E58')` |
| 4 | Typography | Home hero / section headers | Arbitrary `text-[…]` sizes | `.ui-h1` / `.ui-h2` / display tokens |
| 5 | Spacing / grid | Forms, event meta | `grid-cols-2` on mobile | `grid-cols-1 sm:grid-cols-2` |
| 6 | Radius / cards | List pages | `rounded-xl` + heavy resting shadow | `ContentCard` (`rounded-lg`, border-first) |
| 7 | Buttons | Forms | Inline indigo submit buttons | `x-public.button` |
| 8 | Inputs | Forms | Duplicated field markup; no a11y wiring | `x-public.form-field` + `.ui-control` |
| 9 | Cards | Events/ministries indexes | Copy-pasted cards | `ContentCard` + `StatusChip` |
| 10 | Navigation | Header | Missing `aria-expanded` / controls | ontoggle + `aria-controls` |
| 11 | Icons | Coming soon / I’m New | Emoji icons | Removed; SVG `Icon` only |
| 12 | Containers | Mixed max-widths | Random `max-w-*` | `x-public.container` widths |
| 13 | Empty states | Lists | One-line gray text / hidden | `EmptyState` |
| 14 | Error/success | Event notices | Ad-hoc amber/slate boxes | `Alert` tones |
| 15 | Component reuse | Contact + footer | Duplicated contact markup | `ContactInfo` |
| 16 | A11y | Forms | Label/error not linked | `aria-invalid` / `aria-describedby` |
| 17 | Loading | — | N/A (SSR); no spinner yet | Deferred (no async UI) |

## Intentionally unchanged

- `welcome.blade.php` — Laravel default, not church public site
- Sermons/Gallery routes still exist but stay out of primary nav
- Business logic / controllers / FormRequests

## Remaining notes

- Laravel paginator still uses framework default classes (sourced via `@source`); acceptable until a custom pagination view is required
- Mobile menu uses native `<details>` + small `ontoggle` for ARIA (no new product feature)
