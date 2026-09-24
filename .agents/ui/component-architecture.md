# Component Architecture Map — Vision Church

**Status:** Architecture only — do not implement yet  
**Sources:** Live Blade/Filament code · [`.agents/ui/design-system.md`](design-system.md) · [`.agents/UI_RULES.md`](../UI_RULES.md)  
**Namespace (planned):** Blade `x-public.*` under `resources/views/components/public/`  
**Admin boundary:** Filament owns tables, modals, resource forms, toasts. Do **not** rebuild those for `/admin` or `/community`. Theme Filament to brand tokens instead.

---

## Guiding rules (before any new component)

1. **Extend before inventing.** Same job + different content → props/slots, not a new component name.
2. **One card system.** Events and ministries share `ContentCard` (not `EventCard` + `MinistryCard`).
3. **One field system.** `FormField` wraps primitives; do not ship parallel “labeled input” components.
4. **One alert system.** `Alert` covers flash + inline notices via `tone`.
5. **No ecommerce/dashboard ghosts.** Do not create SearchBar, ProductCard, UserCard, ProductGrid, CheckoutSection, DashboardHeader, ProfileSection — they have no domain in this app today.
6. **Public vs Filament.** Public site = this map. Admin = Filament primitives + brand theme.

### Current codebase reality

| Layer | Reality |
|-------|---------|
| Public pages | Inline Tailwind utilities in `layouts/public.blade.php` + `views/public/*` |
| Shared Blade components | **Not referenced** by pages (`x-public.*` usage = 0). Any files under `components/public/` are drafts/orphans until wired. |
| Filament | Stock resources/pages; one custom view `filament/pages/manage-church-info.blade.php` |

When implementing later: **align drafts to this map**, then replace inline markup — do not keep two parallel APIs.

---

## Architecture diagram

```text
┌─────────────────────────────────────────────────────────────┐
│ L3 Page-level                                                │
│  SiteHeader · SiteFooter · HomeHero · CtaBand                │
│  EventRegistrationPanel · ContactSidebar · ComingSoonPanel   │
│  ContentCardGrid (events/ministries)                         │
└───────────────┬─────────────────────────────────────────────┘
                │ composes
┌───────────────▼─────────────────────────────────────────────┐
│ L2 Composite                                                 │
│  FormField · ContentCard · ListTile · Alert · EmptyState     │
│  SectionHeader · PageHeader · NavLink · StatusChip           │
│  Pagination · Container                                      │
└───────────────┬─────────────────────────────────────────────┘
                │ composes
┌───────────────▼─────────────────────────────────────────────┐
│ L1 Primitive                                                 │
│  Button · TextInput · Textarea · Select · Checkbox · Radio   │
│  Text · Heading · Icon · Badge · Divider · Spinner · Avatar  │
└─────────────────────────────────────────────────────────────┘

Filament (out of scope for public components):
  Tables · Modals · Resource forms · Notifications · Sidebar
```

---

# Level 1 — Primitive components

Primitives are the smallest reusable UI atoms. Prefer these inside composites; pages should rarely call primitives except `Heading`/`Text`/`Button`.

---

### Button

| Field | Spec |
|-------|------|
| **Purpose** | Trigger navigation or an action |
| **Props** | `variant`, `size`, `href?`, `type?` (`button`/`submit`), `disabled?`, `icon?`, `iconPosition?` (`leading`/`trailing`), `block?`, slot = label |
| **Variants** | `primary` · `secondary` · `ghost` · `destructive` · `link` |
| **States** | default · hover · active · focus-visible · disabled · (optional loading via Spinner) |
| **Responsive** | `block` full-width on mobile forms; default auto width in nav |
| **A11y** | Real `<button>` or `<a>`; disabled not focus-trapping; focus ring; loading ⇒ `aria-busy` + disabled |
| **Currently used** | Inline on every public page (hero CTAs, nav CTA, form submits, “Xem tất cả”) |
| **Reuse?** | **Extend into one `Button`.** No separate PrimaryButton / LinkButton components |

---

### TextInput

| Field | Spec |
|-------|------|
| **Purpose** | Single-line text entry |
| **Props** | `name`, `id?`, `type?`, `value?`, `placeholder?`, `autocomplete?`, `required?`, `disabled?`, `readonly?`, `invalid?`, `describedBy?` |
| **Variants** | none (type covers email/tel/date/text) |
| **States** | default · hover · focus · invalid · disabled · readonly |
| **Responsive** | Full width of field column; height 44px always |
| **A11y** | id wired to label via FormField; `aria-invalid`; `aria-describedby` |
| **Currently used** | I’m New, Contact, Event register forms (inline) |
| **Reuse?** | **New primitive**; consumed only through `FormField` in pages |

---

### Textarea

| Field | Spec |
|-------|------|
| **Purpose** | Multi-line text entry |
| **Props** | Same as TextInput + `rows?` (default 3–4) |
| **Variants** | none |
| **States** | same as TextInput |
| **Responsive** | Full width; min-height 120px |
| **A11y** | same as TextInput |
| **Currently used** | I’m New message, Contact message (inline) |
| **Reuse?** | **New primitive** via FormField — do not duplicate as “MessageField” |

---

### Select

| Field | Spec |
|-------|------|
| **Purpose** | Choose one option from a list |
| **Props** | `name`, `options` / slot, `value?`, `required?`, `disabled?`, `invalid?`, `placeholder?` |
| **Variants** | none |
| **States** | default · hover · focus · invalid · disabled |
| **Responsive** | Height 44px; full width |
| **A11y** | Label association; keyboard operable native `<select>` |
| **Currently used** | I’m New gender (inline) |
| **Reuse?** | **New primitive** via FormField |

---

### Checkbox / Radio

| Field | Spec |
|-------|------|
| **Purpose** | Boolean or exclusive choice (future + Filament-adjacent custom views) |
| **Props** | `name`, `value?`, `checked?`, `label`, `disabled?` |
| **Variants** | none |
| **States** | unchecked · checked · focus · disabled |
| **Responsive** | 20×20 control; 44px hit area |
| **A11y** | Label click targets control; focus ring |
| **Currently used** | **Not on public site today** |
| **Reuse?** | **Defer implementation** until a public form needs them; define in architecture so they aren’t invented ad hoc. Filament already covers admin |

---

### Text

| Field | Spec |
|-------|------|
| **Purpose** | Body / small / caption copy with tone |
| **Props** | `as?` (`p`/`span`), `size?` (`body`/`small`/`caption`), `tone?` (`ink`/`muted`/`brand`/`on-inverse`/`on-inverse-muted`), slot |
| **Variants** | size × tone only |
| **States** | n/a |
| **Responsive** | size tokens follow type scale |
| **A11y** | Do not use for headings |
| **Currently used** | Inline `text-slate-*` everywhere |
| **Reuse?** | **New primitive** (or strict utility classes from tokens — one approach only) |

---

### Heading

| Field | Spec |
|-------|------|
| **Purpose** | Semantic headings H1–H4 with display/UI fonts |
| **Props** | `level` (1–4), `as?` (override element rare), slot |
| **Variants** | level maps to Literata (1–2) / Be Vietnam Pro (3–4) |
| **States** | n/a |
| **Responsive** | H1/H2 step down on mobile per design system |
| **A11y** | Correct heading level; one H1 per page (enforced by authors) |
| **Currently used** | Inline `text-3xl`/`text-4xl` headings on all pages |
| **Reuse?** | **New primitive** — replaces ad-hoc heading classes |

---

### Icon

| Field | Spec |
|-------|------|
| **Purpose** | Inline SVG icon from one set |
| **Props** | `name`, `size?` (`sm` 16 / `md` 20 / `lg` 24), `decorative?` (default true) |
| **Variants** | by `name` only |
| **States** | inherits text color |
| **Responsive** | fixed sizes |
| **A11y** | decorative ⇒ `aria-hidden`; otherwise `title`/`aria-label` on parent control |
| **Currently used** | Emoji stand-ins (⛪ ☰ 👋 🚧) |
| **Reuse?** | **New primitive**; replaces emoji icons. Do not create per-icon components |

---

### Badge

| Field | Spec |
|-------|------|
| **Purpose** | Compact non-interactive label (counts, tags) |
| **Props** | `tone?` (`neutral`/`brand`/`accent`), slot |
| **Variants** | tone |
| **States** | default only (not a button) |
| **Responsive** | caption type; radius-full |
| **A11y** | Not focusable; if status meaning, prefer `StatusChip` |
| **Currently used** | Implicit member-count text on cards (not a chip yet) |
| **Reuse?** | **New**; keep distinct from `StatusChip` (status semantics) |

---

### StatusChip *(primitive-level semantic badge)*

| Field | Spec |
|-------|------|
| **Purpose** | Registration/event status indicator |
| **Props** | `status` (`open`/`closed`/`full`/`pending`) or `tone` + label |
| **Variants** | maps to success/warning/muted soft pairs |
| **States** | static |
| **Responsive** | wraps; caption size |
| **A11y** | Text label required (not color-only) |
| **Currently used** | Events index status pill (inline) |
| **Reuse?** | **Extend Badge pattern** — implement as `Badge` with `tone` **or** thin `StatusChip` wrapper. **Pick one:** recommend `StatusChip` as named wrapper over Badge tones to avoid misusing Badge for status |

---

### Divider

| Field | Spec |
|-------|------|
| **Purpose** | Horizontal rule between content blocks |
| **Props** | `tone?` (`default`/`inverse`) |
| **Variants** | tone |
| **States** | n/a |
| **Responsive** | full width of container |
| **A11y** | decorative (`aria-hidden`) or `<hr>` |
| **Currently used** | Footer top border only (inline) |
| **Reuse?** | **New** — optional for About sections; don’t overuse |

---

### Spinner

| Field | Spec |
|-------|------|
| **Purpose** | Indeterminate loading indicator |
| **Props** | `size?`, `label?` (sr-only default “Đang tải”) |
| **Variants** | size only |
| **States** | animating; respects `prefers-reduced-motion` |
| **Responsive** | n/a |
| **A11y** | `role="status"` + sr text |
| **Currently used** | **None** |
| **Reuse?** | **New**; used inside Button loading / future async |

---

### Avatar

| Field | Spec |
|-------|------|
| **Purpose** | Person image or initials |
| **Props** | `src?`, `name`, `size?` (`sm`/`md`/`lg`) |
| **Variants** | image · initials fallback |
| **States** | n/a |
| **Responsive** | fixed sizes |
| **A11y** | alt = name; initials decorative if name adjacent |
| **Currently used** | **None** (ministry members are text-only by design — privacy) |
| **Reuse?** | **Defer.** Do not add faces to public ministry lists unless product asks. Architecture lists it so Filament custom views don’t invent a second avatar |

---

## Level 1 — Explicitly out of scope (do not create)

| Rejected | Why |
|----------|-----|
| Separate `Link` component | Use `Button variant="link"` or Text + href |
| `PrimaryButton` / `SecondaryButton` | Variants on `Button` |
| Input variants per domain (`EmailInput`) | `TextInput` + `type` |
| Icon components per glyph | `Icon name="…"` |

---

# Level 2 — Composite components

Composites assemble primitives into reusable field/chrome patterns.

---

### FormField

| Field | Spec |
|-------|------|
| **Purpose** | Label + control + hint + error anatomy |
| **Props** | `name`, `label`, `required?`, `hint?`, `error?` (or auto from `$errors`), `control` (`text`/`email`/`tel`/`date`/`textarea`/`select`), control-specific props, slot for custom control |
| **Variants** | by control type |
| **States** | mirrors control + shows error text |
| **Responsive** | full width; parent grid handles columns |
| **A11y** | `<label for>`; `aria-required`; `aria-invalid`; `aria-describedby` → hint/error ids |
| **Currently used** | Duplicated markup on I’m New, Contact, Event register |
| **Reuse?** | **Single FormField** for all three forms. Draft `form-field.blade.php` (if present) should be rewritten to this contract |

---

### ContentCard

| Field | Spec |
|-------|------|
| **Purpose** | Clickable/list card for events **and** ministries |
| **Props** | `href`, `title`, `meta?`, `description?`, `footer?`, `status?` (slot or StatusChip), slot optional |
| **Variants** | none (one layout) — optional `as` static vs link |
| **States** | default · hover · focus-visible |
| **Responsive** | fills grid cell; title clamps; description 2–3 lines |
| **A11y** | One tab stop if whole-card link; focus ring on card; title in accessible name |
| **Currently used** | Home events/ministries; Events index; Ministries index (copy-pasted) |
| **Reuse?** | **One ContentCard** — do **not** create EventCard + MinistryCard |

---

### ListTile

| Field | Spec |
|-------|------|
| **Purpose** | Compact row: primary text + meta |
| **Props** | `title`, `meta?`, `href?` |
| **Variants** | static · link |
| **States** | default · hover (if link) · focus |
| **Responsive** | stack meta under title on very small screens if needed |
| **A11y** | same as card-link rules if `href` |
| **Currently used** | Ministry show member rows (inline) |
| **Reuse?** | **One ListTile**; draft `list-tile` aligns here |

---

### Alert

| Field | Spec |
|-------|------|
| **Purpose** | Flash and inline notices |
| **Props** | `tone` (`success`/`info`/`warning`/`danger`), `title?`, slot = message, `role?` override |
| **Variants** | tone → soft pairs |
| **States** | static (dismissible **out of scope** until needed) |
| **Responsive** | full width of container |
| **A11y** | success/info ⇒ `role="status"`; warning/danger ⇒ `role="alert"` |
| **Currently used** | Layout session success/info/error; event full/closed banners |
| **Reuse?** | **One Alert** for layout flash **and** inline event notices. Draft `flash` becomes Alert or thin wrapper |

---

### EmptyState

| Field | Spec |
|-------|------|
| **Purpose** | Empty collection placeholder |
| **Props** | `title`, `body?`, `actionLabel?`, `actionUrl?` |
| **Variants** | none |
| **States** | static |
| **Responsive** | centered in content column |
| **A11y** | headings not competing with page H1 (use H2/p) |
| **Currently used** | One-line empty text on Events/Ministries; home hides sections |
| **Reuse?** | **New shared EmptyState** on all list pages |

---

### SectionHeader

| Field | Spec |
|-------|------|
| **Purpose** | Section title + optional “view all” action |
| **Props** | `title`, `eyebrow?`, `actionLabel?`, `actionUrl?` |
| **Variants** | with/without action |
| **States** | n/a |
| **Responsive** | title + action stack on mobile; row on desktop |
| **A11y** | title as H2; action is Link button |
| **Currently used** | Home “Sự kiện sắp tới” / “Các ban ngành” (inline flex) |
| **Reuse?** | **One SectionHeader** |

---

### PageHeader

| Field | Spec |
|-------|------|
| **Purpose** | Inner-page title band (About, lists, forms) |
| **Props** | `title`, `lead?`, `backHref?`, `backLabel?` |
| **Variants** | plain · with back link · soft band (`brand-soft`) optional prop `band?` |
| **States** | n/a |
| **Responsive** | reading/content width per page container |
| **A11y** | H1 for title; back link clear name |
| **Currently used** | Ad-hoc H1s; event/ministry back links inline |
| **Reuse?** | **Merge** draft `page-hero` into **PageHeader** — do not keep both PageHero and PageHeader |

---

### NavLink

| Field | Spec |
|-------|------|
| **Purpose** | Single header/footer nav item |
| **Props** | `href`, `label`, `active?` |
| **Variants** | header · footer (tone: ink vs on-inverse) via `tone` |
| **States** | default · hover · active · focus |
| **Responsive** | desktop inline; mobile full-width row |
| **A11y** | `aria-current="page"` when active |
| **Currently used** | Inline header/footer links |
| **Reuse?** | **One NavLink**; used by SiteHeader / SiteFooter |

---

### Pagination

| Field | Spec |
|-------|------|
| **Purpose** | Style Laravel paginator for public lists |
| **Props** | `paginator` (LengthAwarePaginator) |
| **Variants** | none |
| **States** | page link default/hover/current/disabled |
| **Responsive** | simplify to prev/next + current on mobile if needed |
| **A11y** | nav landmark `aria-label="Phân trang"`; current page announced |
| **Currently used** | Events index `{{ $events->links() }}` (default Laravel) |
| **Reuse?** | **Thin wrapper / published pagination view** — do not build a custom pager from scratch |

---

### Container

| Field | Spec |
|-------|------|
| **Purpose** | Width + gutter wrapper |
| **Props** | `width?` (`content`/`reading`/`narrow`/`full`), slot |
| **Variants** | width tokens from UI_RULES |
| **States** | n/a |
| **Responsive** | gutters 16/24/32 |
| **A11y** | no role |
| **Currently used** | Mixed `max-w-*` utilities |
| **Reuse?** | **One Container** — replaces random max-width soup |

---

### NavigationMenu *(composite, not a separate product)*

| Field | Spec |
|-------|------|
| **Purpose** | Desktop link list + mobile disclosure panel |
| **Props** | `items[]` `{href,label,active}`, composed of NavLink + Icon + Button |
| **Variants** | desktop bar · mobile panel |
| **States** | open/closed mobile (`aria-expanded`) |
| **Responsive** | lg breakpoint switch |
| **A11y** | keyboard; Esc closes; focus management |
| **Currently used** | Inline in layout header |
| **Reuse?** | Implement **inside SiteHeader** (L3) rather than a standalone exported menu **unless** reused in footer — recommendation: **private partial of SiteHeader**, not a second public API |

---

### Modal / DataTable

| Field | Spec |
|-------|------|
| **Purpose** | — |
| **Decision** | **Do not create for public Phase 1.** No modal/table UX exists on public site. Admin uses **Filament** Modal/Table. |
| **Reuse?** | Filament only |

---

### SearchBar / UserCard / ProductCard

| Field | Spec |
|-------|------|
| **Decision** | **Do not create.** No search UI, user profiles, or products in the public domain. |

---

# Level 3 — Page-level components

Page sections compose L1/L2. Keep these thin; business data stays in controllers.

---

### SiteHeader

| Field | Spec |
|-------|------|
| **Purpose** | Sticky site chrome: logo, nav, CTA, mobile menu |
| **Props** | `churchInfo` (name), nav items derived from routes |
| **Variants** | none |
| **States** | mobile menu open/closed; optional scrolled shadow |
| **Responsive** | full nav ≥1024; panel below |
| **A11y** | `header`/`nav`; skip link target; menu button name |
| **Currently used** | Inline in `layouts/public.blade.php` |
| **Reuse?** | **Extract layout header** into SiteHeader; compose Logo + NavLink + Button + Icon |

---

### SiteFooter

| Field | Spec |
|-------|------|
| **Purpose** | Footer: identity, contact, social, copyright |
| **Props** | `churchInfo` (name, address, contact_info, social_links) |
| **Variants** | none |
| **States** | n/a |
| **Responsive** | 1 → 3 columns |
| **A11y** | `footer`; social links meaningful text (not raw URL alone if possible) |
| **Currently used** | Inline in layout |
| **Reuse?** | **Extract**; draft `footer` aligns here |

---

### Logo

| Field | Spec |
|-------|------|
| **Purpose** | Brand wordmark / optional SVG mark linking home |
| **Props** | `churchInfo`, `markSrc?` |
| **Variants** | text-only · mark + text |
| **States** | hover/focus on link |
| **Responsive** | truncate long names carefully |
| **A11y** | link name = church name |
| **Currently used** | Emoji + name in header/footer |
| **Reuse?** | **One Logo** shared by header/footer |

---

### HomeHero

| Field | Spec |
|-------|------|
| **Purpose** | Home first viewport: welcome + mission + CTAs (+ optional image later) |
| **Props** | `churchInfo` (name, mission), primary/secondary CTA labels+urls |
| **Variants** | text-only (v1) · with full-bleed image (v2 when assets exist) |
| **States** | n/a |
| **Responsive** | stacked CTAs on narrow screens; H1 scale |
| **A11y** | H1 once; CTAs as Buttons |
| **Currently used** | `public/home.blade.php` hero section |
| **Reuse?** | **Home-only L3** — do not reuse as PageHeader |

---

### CtaBand

| Field | Spec |
|-------|------|
| **Purpose** | Mid/end page invite band (home “Lần đầu đến…”) |
| **Props** | `title`, `body`, `actionLabel`, `actionUrl` |
| **Variants** | none |
| **States** | n/a |
| **Responsive** | centered stack |
| **A11y** | H2 + Button |
| **Currently used** | Home bottom CTA (inline) |
| **Reuse?** | **One CtaBand**; optional later on other pages — still one component |

---

### ContentCardGrid

| Field | Spec |
|-------|------|
| **Purpose** | Responsive grid of ContentCards + empty handling |
| **Props** | `items` (presenter: href, title, meta, description, footer, status), `empty` EmptyState props, `columns?` |
| **Variants** | none |
| **States** | empty · populated |
| **Responsive** | 1 / 2 / 3 cols per breakpoints |
| **A11y** | list semantics optional (`ul`/`li`); empty state rules |
| **Currently used** | Home, Events index, Ministries index grids |
| **Reuse?** | **One grid** wrapping ContentCard — avoid EventGrid + MinistryGrid |

---

### EventRegistrationPanel

| Field | Spec |
|-------|------|
| **Purpose** | Event detail registration form **or** closed/full notice |
| **Props** | `event`, form old/errors; uses FormField + Button + Alert |
| **Variants** | open · full · closed (driven by event state) |
| **States** | form validation errors; submit loading later |
| **Responsive** | single column; field pairs → 2-col from tablet |
| **A11y** | form labels; alerts for blocked states |
| **Currently used** | `public/events/show.blade.php` |
| **Reuse?** | **Page-level only**; do not generalize to “any form panel” — Contact/I’m New stay page templates composing FormField |

---

### ContactInfoBlock

| Field | Spec |
|-------|------|
| **Purpose** | Address / phone / email stack (contact page + footer overlap) |
| **Props** | `churchInfo` |
| **Variants** | `tone` (`default`/`inverse`) for footer vs page |
| **States** | n/a |
| **Responsive** | stack |
| **A11y** | `tel:` / `mailto:` links when values present |
| **Currently used** | Contact page left column; footer contact (duplicated) |
| **Reuse?** | **One ContactInfoBlock** with tone — shared by Contact page + SiteFooter |

---

### ComingSoonPanel

| Field | Spec |
|-------|------|
| **Purpose** | Placeholder for unfinished routes (if still routed) |
| **Props** | `title`, `body?` |
| **Variants** | none |
| **States** | n/a |
| **Responsive** | centered |
| **A11y** | H1; link home via Button link |
| **Currently used** | `public/coming-soon.blade.php` |
| **Reuse?** | Prefer **hiding from nav** (UI_RULES); keep thin panel if routes remain |

---

### AboutSections

| Field | Spec |
|-------|------|
| **Purpose** | Vision / mission / history / address blocks |
| **Props** | `churchInfo` |
| **Variants** | none |
| **States** | empty field → “Đang cập nhật.” |
| **Responsive** | reading container |
| **A11y** | H2 per section under page H1 |
| **Currently used** | `public/about.blade.php` |
| **Reuse?** | Optional L3 **or** leave as page template with Heading/Text — **prefer page template** unless reused elsewhere. Not required as a component if only used once |

---

## Level 3 — Explicitly out of scope

| Rejected | Why |
|----------|-----|
| DashboardHeader | No public dashboard |
| ProductGrid / CheckoutSection | No commerce |
| ProfileSection | No public profiles |
| SermonHero / GalleryGrid | Phase 2 — design when domain exists |
| Admin DataTable shells | Filament |

---

# Cross-cutting composition map

| Page / surface | L3 | L2 | L1 |
|----------------|----|----|----|
| Layout shell | SiteHeader, SiteFooter, Logo | Alert (flash), NavLink, Container | Button, Icon, Text |
| Home | HomeHero, ContentCardGrid, CtaBand | SectionHeader, ContentCard, EmptyState | Heading, Text, Button |
| About | (page template) | PageHeader, Container | Heading, Text, Divider? |
| I’m New | (page template) | PageHeader, FormField, Alert | Button, TextInput… |
| Contact | ContactInfoBlock | PageHeader, FormField | Button, … |
| Events index | ContentCardGrid | PageHeader, Pagination, StatusChip, EmptyState | — |
| Event show | EventRegistrationPanel | PageHeader, Alert, FormField | — |
| Ministries index | ContentCardGrid | PageHeader, EmptyState | — |
| Ministry show | — | PageHeader, ListTile, EmptyState | — |
| Coming soon | ComingSoonPanel | — | Heading, Button |
| Filament | — | — | Theme tokens only; use Filament components |

---

# Extension vs new — decision table

| Need | Action |
|------|--------|
| Event card vs ministry card | **Extend** ContentCard props |
| Flash vs event closed banner | **Extend** Alert `tone` |
| PageHero vs PageHeader | **Merge** → PageHeader |
| Nav CTA vs form submit | **Extend** Button `variant` / `type` / `href` |
| Footer contact vs contact page | **Extend** ContactInfoBlock `tone` |
| New sermon card (Phase 2) | **Extend** ContentCard first; new L3 only if layout differs >20% |
| Admin list/filter | **Use Filament** — do not add public DataTable |
| Modal for public | **Do not add** until a real public modal job exists |

---

# Implementation order (when authorized later)

1. Tokens in Vite/`app.css` (design system)  
2. L1: Button, Icon, Heading, Text, TextInput, Textarea, Select, Spinner  
3. L2: FormField, Alert, ContentCard, ListTile, EmptyState, SectionHeader, PageHeader, Container, StatusChip, Pagination  
4. L3: Logo, SiteHeader, SiteFooter → swap layout  
5. Replace page inline markup page-by-page (home → lists → forms → detail)  
6. Filament primary color = brand teal  

**Do not** implement in this task.

---

## Document control

| Field | Value |
|-------|--------|
| Version | 1.0 |
| Depends on | `design-system.md`, `UI_RULES.md`, live routes/views |
| Output type | Architecture map only |

*Avoid duplicate components. Extend before creating. Filament owns admin complex widgets.*
