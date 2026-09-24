# UI Rules — Vision Church Management

**Authority:** This file is the single source of truth for visual design in this repository.  
**Token reference:** [`.agents/ui/design-system.md`](ui/design-system.md) (hex values, scales, recipes).  
**Scope:** Public Blade site and Filament panels (`/admin`, `/community`).  
**Status:** Governance only — do not implement UI from this file until explicitly asked.

Every future UI change **must** follow these rules. If a change conflicts with this document, update this document first (with intent), then implement.

Do **not** invent parallel palettes, fonts, radii, or one-off component variants.

---

## How to use this document

1. Read **Design principles** before any UI work.
2. Use tokens from `design-system.md` — never hardcode Indigo / Amber / Emerald / Inter as brand.
3. Prefer existing shared components; extend via props; add a new component only when the job is distinct.
4. Check the **DO / DON'T** for the area you touch before opening a PR.

---

## 1. Design principles

1. **One brand.** Teal primary (`#006E58`) everywhere — public site and both Filament panels. Community differs by content/name, not by a second primary color.
2. **Vietnamese-first.** `lang="vi"`. Nav and UI chrome in Vietnamese. Be Vietnam Pro for UI/body; Literata for display headings.
3. **Calm and trustworthy.** Welcoming church product — not generic SaaS, not purple gradients, not cream+terracotta editorial kitsch.
4. **Few variants.** Solve each UI job once. Max five button variants. Max two card layouts.
5. **Brand over decoration.** Wordmark from `ChurchInfo.name` (optional logo later). No emoji as permanent brand or icons.
6. **Content hierarchy.** One H1 per page. One job per section. Hero: brand + one headline + one support line + one CTA group — no stats strips or promo clutter in the first viewport.
7. **Accessibility is default.** Contrast, focus rings, labels, and keyboard paths are not optional polish.
8. **No business-logic changes** in UI-only work unless explicitly requested.

### DO

- Use design-system tokens (`brand`, `ink`, `canvas`, spacing scale, radii).
- Reuse `Button`, `FormField`, `Card`, `Flash`, `EmptyState` once they exist.
- Keep Filament primary mapped to brand teal.

### DON'T

- Ship Indigo / Amber / Emerald / Inter as the product look.
- Mix English nav with Vietnamese body on the same chrome.
- Add a new button color “just for this page.”
- Use church emoji (`⛪`) as the logo.

---

## 2. Color rules

**Source of truth for values:** `design-system.md` §1.

| Role | Token | Rule |
|------|-------|------|
| Primary actions & links | `brand` / `brand-hover` | Only teal for primary CTAs and text links |
| Soft highlight | `brand-soft` | Backgrounds only; text on it must be `ink` or `brand` |
| Dark bands / footer | `secondary` / `inverse` | Text = `on-inverse` / `on-inverse-muted` |
| Accent gold | `accent` | Ceremonial badges only — **never** primary buttons |
| Page | `canvas` | Default body background |
| Cards / inputs / header | `surface` | Elevated content |
| Alternating sections | `surface-alt` | Section bands, not random card fills |
| Body text | `ink` | Headings and paragraphs |
| Secondary text | `muted` | Meta, hints — not on soft status fills without check |
| Borders | `border` / `border-strong` | Resting vs hover/emphasis |
| Status | `success` / `warning` / `danger` / `info` | Only with paired soft backgrounds |

### DO

- Primary button: `brand` fill + white label.
- Links: `brand`; hover → `brand-hover`.
- Status chips: soft bg + matching semantic text (e.g. success soft `#E8F6EE` + `#197037`).
- Footer: `inverse` bg + white / `on-inverse-muted` text.

### DON'T

- Use gold (`accent`) for “Kết nối ngay” or submit.
- Put `muted` text on `brand-soft` without verifying contrast.
- Use Tailwind `indigo-*`, `purple-*`, or random hex outside the palette.
- Rely on color alone for status (always include text).

---

## 3. Typography rules

| Role | Font | Notes |
|------|------|-------|
| Display (H1–H2) | Literata 600/700 | Page and section titles |
| UI / body | Be Vietnam Pro 400–700 | Body, forms, nav, buttons |
| Mono | System mono | Codes/IDs only |

**Scale (desktop):** H1 40/48 · H2 32/40 · H3 24/32 · H4 20/28 · Body 16/26 · Small 14/22 · Caption 12/18 · Button/Nav 14/20.

### DO

- One H1 per page.
- Section titles = H2; card titles = H4 (or H3 if large feature).
- Button and nav labels: Be Vietnam Pro, weight 600 (nav active 600, default 500).
- Reduce H1/H2 one step on mobile (see Responsive).

### DON'T

- Use Inter, Roboto, Arial, or system-ui as the brand font.
- Skip heading levels for decoration (H1 → H4 with no H2).
- Set input text below 16px (iOS zoom).
- ALL-CAPS long Vietnamese sentences.

---

## 4. Spacing rules

Base unit **4px**. Allowed: `4 · 8 · 12 · 16 · 24 · 32 · 48 · 64 · 80`.

| Use | Spacing |
|-----|---------|
| Icon ↔ label | 4–8 |
| Label ↔ control | 8 |
| Fields in a form | 16 |
| Card padding | 24 |
| Card grid gap | 32 |
| Blocks inside a section | 48 |
| Section padding-y | 64 (mobile/tablet) · 80 (desktop) |
| Page gutter | 16 / 24 / 32 (mobile / tablet / desktop) |

### DO

- Stick to the scale for margin, padding, and gap.
- Use consistent form field stack = 16px.

### DON'T

- Invent 13px, 18px, 22px padding.
- Use different vertical rhythms for Events vs Ministries lists.

---

## 5. Layout rules

1. **One composition per first viewport** (public marketing pages): brand, one headline, one short support line, one CTA group, optional one dominant image — not a dashboard of widgets.
2. **One job per section:** one headline, usually one short support line.
3. **No hero clutter:** no stat strips, schedule snippets, floating badges, or promo chips on hero media.
4. **Cards are for interaction or repeated list items** — not for wrapping every block of text.
5. **Public pages share one layout shell** (header / main / footer).

### DO

- Alternate `canvas` and `surface-alt` for long pages when sections need separation.
- Keep About-style prose in a reading-width column without fake cards.

### DON'T

- Put multiple competing CTAs of equal weight in the hero.
- Wrap vision/mission paragraphs each in their own shadowed card by default.
- Build a “dashboard home” for visitors unless the page is actually a dashboard.

---

## 6. Container rules

| Container | Max width | Use |
|-----------|-----------|-----|
| Content | 72rem (1152px) | Lists, home sections, nav bar inner |
| Reading | 48rem (768px) | About, event detail, long prose |
| Narrow / form | 40rem (640px) | I’m New and similar single forms |
| Full-bleed | 100% | Hero media, footer background |

- Inner gutters: 16 / 24 / 32 by breakpoint.
- Header inner aligns with content max.
- Modals/dropdowns: surface + radius-lg; not full content width unless needed.

### DO

- Match Events index and Ministries index to the same content max + gutters.

### DON'T

- Mix `max-w-2xl`, `max-w-3xl`, `max-w-4xl`, `max-w-5xl`, `max-w-6xl` randomly for the same content type.
- Nest multiple max-width wrappers that fight each other.

---

## 7. Button rules

**Allowed variants only:** Primary · Secondary · Ghost · Destructive · Link  
**Sizes only:** Default (44px height) · Compact (36px, dense admin/tables)

| Property | Value |
|----------|-------|
| Radius | `radius-md` (10px) |
| Type | 14px / 600 / Be Vietnam Pro |
| Icon | 16px; gap 8px; leading preferred |
| Focus | 2px brand ring, 2px offset |

### DO

- One primary CTA per view section.
- Public forms: primary submit full width on mobile.
- Use Link variant for “Xem tất cả →”.
- Disabled: no hover, reduced contrast, `aria-disabled` / disabled attribute.

### DON'T

- Create “outline primary”, “soft primary”, or gradient buttons.
- Use emoji inside buttons.
- Put two primary-filled buttons side by side with equal weight.
- Remove focus styles.

---

## 8. Card rules

**Allowed layouts only:**

1. **Content card** — lists (events, ministries): surface, 1px border, radius-lg, padding 24. Hover (if link): brand border + shadow-md.
2. **List tile** — compact rows (members): padding 12–16, horizontal title + meta.

### DO

- Structure: meta → title → body (line-clamp) → optional footer.
- Whole-card links must show a visible focus ring on the card.

### DON'T

- Resting cards with heavy shadow (border only at rest).
- Glassmorphism, gradient fills, or multi-shadow stacks.
- Separate `HomeEventCard` vs `EventsIndexCard` if structure matches — one component.
- Card-wrap the hero or footer columns.

---

## 9. Form rules

**Anatomy (required order):** Label → Control → Hint (optional) → Error (optional)

| Control | Spec |
|---------|------|
| Input / select | Height 44px; padding 12×16; radius-md; bg surface |
| Textarea | Min-height 120px; resize vertical only |
| Checkbox / radio | 20×20; brand when selected |
| Switch | 44×24 track; brand when on |

**States:** default → hover (`border-strong`) → focus (brand ring) → error (`border-danger` + danger text) → disabled.

### DO

- Associate every control with a `<label>`.
- `aria-invalid` + `aria-describedby` pointing at error id.
- Single column on mobile; 2 columns only from tablet up.
- Required marker in the label + `aria-required`.

### DON'T

- Duplicate hand-styled fields per page — use `FormField`.
- Placeholder-only labels.
- Error messaging by red border alone.
- Horizontal field pairs that crush on small screens.

---

## 10. Navigation rules

### Desktop (≥1024px)

- Sticky header 64px; surface; bottom border.
- Wordmark left (`ChurchInfo.name`, Literata).
- Text links; gap 24px; Vietnamese labels.
- One primary CTA right (“Kết nối ngay”).
- Active: `brand` + weight 600 + `aria-current="page"`.
- Hover: `brand`.

### Mobile (<1024px)

- Menu control: SVG icon, 44×44, `aria-expanded` / `aria-controls`.
- Panel: surface + shadow-lg; stacked links min-height 44px; include primary CTA.
- Close on navigate and Escape.

### IA

- Do **not** put Phase-2 placeholders (Sermons / Gallery) in primary nav until real pages exist.

### DO

- Keep public nav and footer link language consistent (Vietnamese).
- Skip link: “Đến nội dung chính”.

### DON'T

- Emoji hamburger (`☰`) or emoji logo.
- English chrome (“Home”, “About”) under `lang="vi"`.
- Dropdowns unless IA truly needs them.
- Different active styles per page.

---

## 11. Icon rules

- Use a **single SVG icon set** (e.g. Heroicons-style outline) for UI.
- Default size **16px** in buttons/nav; **20–24px** for empty/feature moments.
- Color: inherit text color or `brand` / `muted` as appropriate.
- Decorative icons: `aria-hidden="true"`. Meaningful icons: accessible name on the control.

### DO

- Pair icons with text labels for primary actions when space allows.
- Use the same stroke weight across the product.

### DON'T

- Emoji as icons (`⛪`, `👋`, `🚧`, `☰`).
- Mix filled/outline systems randomly.
- Different icon libraries on public vs the same public page.

---

## 12. Image rules

- Real photography of church life / place when possible; not abstract gradient-as-content.
- Brand logo: SVG in `public/images/brand/` when available; alt = church name.
- Hero: full-bleed or edge-to-edge visual plane on promotional pages — not a small inset card image.
- Always set width/height or aspect-ratio to reduce CLS; `loading="lazy"` below the fold; eager for LCP hero.
- Object-fit: `cover` for crops; never stretch distort.

### DO

- Provide meaningful `alt` (or empty alt if pure decoration).
- Keep empty `images/brand` / `images/home` filled before relying on them in UI.

### DON'T

- Overlay floating badges/stickers on hero media.
- Use stock collage or multi-tile hero mosaics unless explicitly designed.
- Treat CSS gradient alone as the “main visual” for the brand story.

---

## 13. Responsive rules

| Name | Min width | Expectations |
|------|-----------|--------------|
| Mobile | 0 | 1 column; hamburger; stacked forms; H1 32/40; section py 64 |
| Tablet | 640px | 2-col cards; forms may 2-col; H1 36/44 |
| Desktop | 1024px | Full nav; 3-col cards; content max 72rem; full type; section py 80 |
| Large | 1280px | Same structure; wider gutters; hero may full-bleed |

Breakpoints: `sm 640` · `md 768` · `lg 1024` · `xl 1280`.

### DO

- Mobile-first CSS.
- Touch targets ≥ 44×44px.
- Test forms and nav at 320–400px width.

### DON'T

- Horizontal scroll from padding/grids.
- Hide focus outlines on “mobile only.”
- Desktop-only hover as the only affordance for an action.

---

## 14. Accessibility rules

| Requirement | Rule |
|-------------|------|
| Contrast | Body/UI ≥ 4.5:1; large text ≥ 3:1; UI non-text ≥ 3:1 |
| Focus | Visible `:focus-visible` ring; never remove outline without replacement |
| Keyboard | Full operation without mouse; Esc closes overlays; no traps |
| Semantics | `header` / `nav` / `main` / `footer`; one H1; correct button vs link |
| Forms | Labels, errors announced, required indicated |
| Flash | `role="status"` (success/info); `role="alert"` (error) |
| Language | `lang="vi"`; visible text matches |
| Motion | Honor `prefers-reduced-motion` |

### DO

- Run through keyboard-only for nav + forms before shipping UI.
- Link errors to fields with `aria-describedby`.

### DON'T

- Click-only menus with no keyboard path.
- Color-only validation.
- `div`/`span` click handlers where `button`/`a` belongs.

---

## 15. Animation rules

- Purpose: hierarchy and presence — not decoration noise.
- Duration: **150–200ms** UI; ≤ **400ms** large entrances.
- Easing: standard ease-out for entrances; ease-in for exits.
- Prefer opacity + transform (translate/fade); avoid layout thrashing.
- Ship at most **2–3 intentional motions** on a visually led page (e.g. hero fade, CTA hover, card hover).
- `prefers-reduced-motion: reduce` → disable non-essential motion.

### DO

- Card hover border/shadow transition ~150ms.
- Mobile nav panel simple fade/slide.

### DON'T

- Continuous loops, parallax stacks, or bounce on buttons.
- Animate everything on scroll.
- Require motion to understand state.

---

## 16. Empty states

Every list/collection view must define an empty state (not a blank gap).

**Structure:** short title · one support sentence · optional primary CTA.

Use shared `EmptyState` component when available.

### DO

- Events empty: explain no upcoming events + link home or contact if useful.
- Keep empty state inside the content container, centered or left-aligned consistently.

### DON'T

- Hide entire home sections with no explanation when data is empty (prefer empty state or a single quiet line + CTA).
- Use construction emoji for empty data (reserve coming-soon pattern only for unfinished Phase-2 routes, preferably hidden from nav).

---

## 17. Loading states

Public site is primarily server-rendered; still define loading where async appears.

| Context | Pattern |
|---------|---------|
| Button submit | Disable button + optional spinner; keep label (“Đang gửi…”) |
| List refresh (future) | Skeleton matching card layout OR subtle progress; no layout jump |
| Filament | Prefer framework defaults; align primary color to brand |

### DO

- Prevent double-submit on public forms.
- Reserve space for content to avoid CLS.

### DON'T

- Full-page white flash with no feedback after click.
- Skeleton shapes that don’t match final cards.

---

## 18. Error states

| Level | Pattern |
|-------|---------|
| Field | Danger text below control; `border-danger`; `aria-invalid` |
| Page / flash | Danger soft banner; `role="alert"` |
| System / blocked action | Clear message + next step (e.g. event closed / full) |

### DO

- Vietnamese messages consistent with FormRequest messages where possible.
- Keep error visible until corrected.

### DON'T

- Toast-only errors that disappear before they can be read (unless also reflected on the field).
- Red border without text.

---

## 19. Success states

| Level | Pattern |
|-------|---------|
| Flash | Success soft banner; `role="status"` |
| After form | Redirect or stay with success flash (existing patterns OK) |
| Inline (rare) | Short confirmation near the action |

### DO

- Success copy: clear outcome (“Tin nhắn của bạn đã được gửi…”).
- Info vs success: use `info` soft pair for non-error notices (e.g. already registered).

### DON'T

- Celebrate with confetti/emoji spam.
- Reuse success styling for errors or warnings.

---

## Global DO

- Follow `.agents/ui/design-system.md` for token values.
- Follow this file for behavior and governance.
- Unify public + Filament under one primary teal.
- Extract shared Blade components instead of copy-paste utilities.
- Vietnamese chrome + Literata / Be Vietnam Pro.
- Border-first cards; shadow for hover/overlay only.
- 44px default controls; visible focus; semantic HTML.

## Global DON'T

- Tailwind CDN + one-off Indigo/Inter as the long-term look.
- Parallel brand colors per panel.
- Emoji branding and emoji icons.
- Unnecessary component variants.
- Coming-soon links in primary navigation.
- UI PRs that change business logic without being asked.
- Hardcoded spacing/radius outside the scales.
- Dark mode on public site until explicitly designed.

---

## Compliance checklist (before merging UI work)

- [ ] Colors are design-system tokens only  
- [ ] Typography uses Literata / Be Vietnam Pro as specified  
- [ ] Spacing and radius on scale  
- [ ] Buttons/cards/forms match allowed variants  
- [ ] Nav labels Vietnamese; no placeholder routes in primary nav  
- [ ] Empty / error / success states covered  
- [ ] Focus + contrast + labels checked  
- [ ] No new emoji icons  
- [ ] No business-logic changes unless requested  
- [ ] This document still accurate (update if you intentionally changed a rule)

---

## Document control

| Field | Value |
|-------|--------|
| Version | 1.0 |
| Depends on | `.agents/ui/design-system.md` |
| Applies to | All UI work in this repository |
| Implementation | Not started — rules only |

*Every future UI implementation in this repository must follow this document.*
