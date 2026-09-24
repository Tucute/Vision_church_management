# Vision Church — Website Design System Specification (v1.0)

**Status:** Specification only — not implemented at time of writing  
**Scope:** Public Blade site + Filament `/admin` + `/community`  
**Source:** UI/UX audit findings (unify Indigo / Amber / Emerald / orphaned teal build)  
**Related canvas:** `~/.cursor/projects/home-tpn-dev-Vision-church-management/canvases/design-system-spec.canvas.tsx`

Use this document as the single source of truth for visual implementation. Do not invent parallel tokens or extra component variants without updating this spec.

---

## Design intent

One church brand across every surface:

- **Welcoming, calm, trustworthy** — not generic SaaS indigo, not purple gradients, not cream+terracotta editorial cliché.
- **Vietnamese-first** — type that renders diacritics well; UI copy may be Vietnamese without fighting the font.
- **Few variants** — solve repeated jobs once (button, field, card, nav, flash, empty state).
- **Brand mark** — `ChurchInfo.name` (and optional logo later); no emoji as the permanent brand.

**Unification rule:** Primary = Teal `#006E58` everywhere. Filament Admin and Community use the same primary; Community differs by name/content only, not by a second brand color.

---

## 1. Brand foundation — color

### 1.1 Brand & action

| Token | Hex | Purpose | Where used | Accessibility |
|-------|-----|---------|------------|---------------|
| **Primary / `brand`** | `#006E58` | Main brand & action | Primary buttons, text links, active nav, focus rings, key icons | On white ≈ AA for UI text/icons (≥3:1). For small body text prefer `ink` on canvas; use brand for links ≥14px/600. |
| **`brand-hover`** | `#005542` | Darker brand interaction | Primary hover/active, pressed icon buttons | Darker = stronger contrast on white. |
| **`brand-soft`** | `#C9F2E8` | Soft brand surface | Hero bands, selected chips, soft highlight panels | Do **not** put muted gray text on this without checking; prefer `ink` or `brand` on soft. |
| **Secondary / `secondary`** | `#001318` | Dark contrast brand | Footer, dark CTA bands, inverse sections | White text on secondary must stay ≥4.5:1 (use `#FFFFFF` / `footer-muted` carefully). |
| **Accent / `accent`** | `#B8953B` | Ceremonial highlight only | Featured badges, “special event” markers, rare flourishes | **Not** for primary CTAs (avoids competing with teal). Large text/UI only unless contrast verified. |

### 1.2 Backgrounds & surfaces

| Token | Hex | Purpose | Where used | Accessibility |
|-------|-----|---------|------------|---------------|
| **`canvas`** | `#FBFAF6` | Default page background | `<body>`, main page wash | Base for all text contrast checks. |
| **`surface`** | `#FFFFFF` | Elevated content | Cards, inputs, dropdowns, modals, sticky header | Highest elevation fill; ink on surface is primary reading combo. |
| **`surface-alt`** | `#EAF7F3` | Alternating section band | Home ministries band, soft page sections | Ink on alt must stay ≥4.5:1 (it does). |
| **`inverse`** | `#001318` | Same as secondary | Footer, dark hero overlays | Pair with `#FFFFFF` / `#C9D5D3`. |

### 1.3 Text

| Token | Hex | Purpose | Where used | Accessibility |
|-------|-----|---------|------------|---------------|
| **`ink`** | `#081822` | Primary text | Headings, body, labels | ≥4.5:1 on canvas/surface/surface-alt. |
| **`muted`** | `#495762` | Secondary text | Meta dates, help, captions, placeholders (placeholder may be lighter — see forms) | ≥4.5:1 on canvas/surface. Do not use on `brand-soft` or colored status fills without check. |
| **`on-brand`** | `#FFFFFF` | Text on brand fills | Primary button label, chips on brand | Required on `#006E58` / `#005542`. |
| **`on-inverse`** | `#FFFFFF` | Text on dark | Footer titles | Required. |
| **`on-inverse-muted`** | `#97A8AB` | Secondary on dark | Footer body, copyright | Large/secondary only; avoid for critical actions. |

### 1.4 Borders

| Token | Hex | Purpose | Where used | Accessibility |
|-------|-----|---------|------------|---------------|
| **`border`** | `#B4CAC4` | Default stroke | Cards, inputs, dividers | Not for text. Separates surfaces without heavy shadow. |
| **`border-strong`** | `#7A9690` | Emphasized stroke | Hover card, focused non-error input optional | Stronger affordance. |
| **`border-danger`** | `#B91C1C` | Error stroke | Invalid inputs | Paired with error text. |

### 1.5 Semantic status

| Token | Hex | Purpose | Where used | Accessibility |
|-------|-----|---------|------------|---------------|
| **`success`** | `#197037` | Positive | Success flash, “open registration” | Icon+text; soft bg `#E8F6EE`, text `#197037`. |
| **`warning`** | `#A16207` | Caution | Full capacity, pending | Soft bg `#FBF3E0`, text `#A16207`. |
| **`danger`** | `#B91C1C` | Error / destructive | Error flash, field errors, destructive button | Soft bg `#FCEBEB`, text `#B91C1C`. Never rely on color alone. |
| **`info`** | `#0B6E99` | Neutral notice | Info flash | Soft bg `#E6F4FA`, text `#0B6E99`. |

### 1.6 Soft status surfaces (fixed pairs)

| Pair | Background | Foreground |
|------|------------|------------|
| Success soft | `#E8F6EE` | `#197037` |
| Warning soft | `#FBF3E0` | `#A16207` |
| Danger soft | `#FCEBEB` | `#B91C1C` |
| Info soft | `#E6F4FA` | `#0B6E99` |

**Retired as brand colors:** Tailwind Indigo (public), Filament Amber (admin), Filament Emerald (community). Semantic green for success may remain; it is not the brand primary.

---

## 2. Typography

### 2.1 Families

| Role | Family | Weights | Why |
|------|--------|---------|-----|
| **Display** | **Literata** | 600, 700 | Sacred/editorial presence; already present in orphaned build |
| **UI / Body** | **Be Vietnam Pro** | 400, 500, 600, 700 | Excellent Vietnamese diacritics; UI clarity |
| **Mono** (rare) | System mono / ui-monospace | 400 | Codes, IDs only — not marketing |

**Do not use as brand defaults:** Inter, Roboto, Arial, system-ui stacks for public UI.

### 2.2 Type scale

Desktop values. Mobile: reduce H1/H2 by one step (see Responsive).

| Style | Family | Size | Weight | Line height | Letter spacing | Use |
|-------|--------|------|--------|-------------|----------------|-----|
| **H1** | Literata | 40px | 700 | 48px (1.2) | −0.02em | Page heroes, home welcome |
| **H2** | Literata | 32px | 700 | 40px (1.25) | −0.015em | Section titles |
| **H3** | Be Vietnam Pro | 24px | 600 | 32px (1.33) | −0.01em | Subsections, card titles (large) |
| **H4** | Be Vietnam Pro | 20px | 600 | 28px (1.4) | 0 | Card titles, form group titles |
| **Body** | Be Vietnam Pro | 16px | 400 | 26px (1.625) | 0 | Paragraphs, form values |
| **Body emphasis** | Be Vietnam Pro | 16px | 600 | 26px | 0 | Strong inline |
| **Small** | Be Vietnam Pro | 14px | 400 | 22px (1.57) | 0 | Meta, secondary |
| **Caption** | Be Vietnam Pro | 12px | 500 | 18px (1.5) | 0.02em | Badges, legal, timestamps |
| **Button** | Be Vietnam Pro | 14px | 600 | 20px | 0.01em | All button labels |
| **Navigation** | Be Vietnam Pro | 14px | 500 (default) / 600 (active) | 20px | 0 | Header links |

**Rules**

- One H1 per page.
- Section titles prefer H2; do not skip for decoration.
- Links in body: `brand`, weight 500–600, underline on hover (always underline in body for clarity optional — at minimum hover + focus).

---

## 3. Spacing system

Base unit: **4px**. Scale:

| Token | Value | When to use |
|-------|-------|-------------|
| **space-1** | 4px | Icon gaps, tight inline padding |
| **space-2** | 8px | Label→input gap, chip padding-y, compact stacks |
| **space-3** | 12px | Input horizontal padding (with 16), list item gaps |
| **space-4** | 16px | Default component padding, nav item gap, form field stack |
| **space-5** | 24px | Card padding, form group gaps, section inner gaps |
| **space-6** | 32px | Between card grid items, header height rhythm |
| **space-7** | 48px | Between major blocks inside a section |
| **space-8** | 64px | Section padding-y (mobile/tablet) |
| **space-9** | 80px | Section padding-y (desktop), hero vertical breathing |

**Layout constants**

| Token | Value | Use |
|-------|-------|-----|
| Content max | 72rem (1152px) | Main content (`max-w-6xl` equivalent) |
| Narrow content | 40rem (640px) | Forms (I’m New) |
| Reading content | 48rem (768px) | About, event detail |
| Page gutter | 16px mobile / 24px tablet / 32px desktop | Horizontal page padding |
| Header height | 64px | Sticky header |

**Forbidden:** One-off values like 18px, 22px, 13px except inside the type scale.

---

## 4. Border radius

| Token | Value | Apply to |
|-------|-------|----------|
| **radius-sm** | 6px | Small chips, checkbox (if rounded), tiny controls |
| **radius-md** | 10px | **Buttons, inputs, select, textarea** |
| **radius-lg** | 14px | **Cards, flash banners, dropdown panels, modals** |
| **radius-xl** | 20px | Large media frames, hero image mask (if used) |
| **radius-full** | 9999px | Avatar, status pill, icon-only circular buttons |

**Consistency rule:** Controls = `md`. Containers = `lg`. Do not mix `rounded-lg` and `rounded-xl` randomly for the same component type (current audit debt).

---

## 5. Shadows (elevation)

Prefer **border** for resting cards. Shadow = interaction or overlay.

| Token | Value (approx.) | Use |
|-------|-----------------|-----|
| **shadow-none** | none | Default resting card, inputs |
| **shadow-sm** | `0 1px 2px rgba(8,24,34,0.06)` | Subtle lift optional |
| **shadow-md** | `0 4px 12px rgba(8,24,34,0.10)` | Card hover, sticky header optional |
| **shadow-lg** | `0 12px 32px rgba(8,24,34,0.16)` | Dropdown, modal, mobile nav panel |

**Rules:** Max 4 elevation levels. No multi-layer glow. No colored brand shadows.

---

## 6. Buttons

### 6.1 Variants (only these five + disabled state)

| Variant | Use |
|---------|-----|
| **Primary** | Main action: submit, “Kết nối ngay”, register |
| **Secondary** | Alternative: “Xem sự kiện”, cancel-adjacent |
| **Ghost** | Tertiary in toolbars / low emphasis |
| **Destructive** | Delete / irreversible (admin-facing mostly) |
| **Link** | Inline / “Xem tất cả →” |

### 6.2 Shared metrics

| Property | Default | Compact (tables/admin denser UI) |
|----------|---------|----------------------------------|
| Height | **44px** | 36px |
| Padding-x | 20px (default) / 16px (compact) | — |
| Padding-y | derived by height | — |
| Radius | `radius-md` (10px) | same |
| Typography | Button style (14/20, 600) | same |
| Icon | 16px; gap 8px; icon-only button = 44×44 | 16px |
| Min width | touch target 44×44 | 36×36 (desktop dense only) |

### 6.3 Variant recipes

**Primary**

- Default: bg `brand`, text `on-brand`, border transparent
- Hover: bg `brand-hover`
- Active: bg `brand-hover`, slight scale none (no bounce)
- Focus-visible: outline 2px `brand`, offset 2px on `canvas`
- Disabled: bg `#9BBBB3`, text `#F5FFFC`, no pointer, no hover

**Secondary**

- Default: bg `surface`, text `ink`, border 1px `border`
- Hover: bg `surface-alt`, border `border-strong`
- Active: bg `brand-soft`
- Focus: same ring as primary
- Disabled: text `muted`, border `border`, bg `canvas`

**Ghost**

- Default: transparent, text `brand`
- Hover: bg `brand-soft`
- Active: bg `#B8E8DC` (between soft and brand)
- Focus: ring
- Disabled: text `#9AA8A3`

**Destructive**

- Default: bg `danger`, text white
- Hover: `#991B1B`
- Focus: ring using `danger`
- Disabled: washed red `#E5A3A3`

**Link**

- Default: text `brand`, underline none, padding 0, height auto
- Hover: underline
- Focus: ring around text box
- Disabled: `muted`, no underline

**Icon behavior:** Leading icon preferred; trailing only for “external / continue →”. Do not pair emoji with buttons in the system.

---

## 7. Form controls

### 7.1 Shared field anatomy

```
[Label *]
[Control]
[Hint text]     ← muted, optional
[Error text]    ← danger, optional; aria-describedby
```

- Label: Small 14px / 600 / `ink`
- Required: asterisk in label, `aria-required="true"`
- Control height: **44px** (inputs, select)
- Padding: 12px 16px
- Radius: `radius-md`
- Border: 1px `border`
- Background: `surface`
- Text: `ink` / placeholder `#7A8B94`
- Font: Body 16px (avoid zoom-forcing <16px on iOS)

### 7.2 States (all text controls)

| State | Border | Ring / other |
|-------|--------|--------------|
| Default | `border` | none |
| Hover | `border-strong` | none |
| Focus | `brand` | 2px ring `brand` @ 20% or offset ring |
| Error | `border-danger` | ring `danger` |
| Disabled | `border`, bg `canvas` | text `muted`, not-editable |
| Read-only | same as disabled visually but selectable | — |

### 7.3 Control-specific

| Control | Spec |
|---------|------|
| **Input** | type text/email/tel/date/password; height 44; same states |
| **Textarea** | min-height 120px; resize vertical only; same border/focus |
| **Select** | height 44; chevron 16px `muted`; same states |
| **Checkbox** | box 20×20; radius-sm; checked fill `brand`; focus ring |
| **Radio** | 20×20 circle; selected `brand` |
| **Switch** | track 44×24; thumb 20; on = `brand`; off = `#C5D0CD` |
| **Search** | Input + leading search icon 16px; optional clear button |

### 7.4 Form layout

- Stack fields with **16px** gap
- Two-column fields only from **tablet+**; mobile always single column (fixes audit issue)
- Primary submit: full width on mobile; auto width or full width in card on desktop (public forms: full width OK)
- Group related fields with H4 + 24px before group

---

## 8. Cards

### 8.1 Standard content card (events, ministries)

| Part | Spec |
|------|------|
| Container | bg `surface`, border 1px `border`, radius `lg`, padding **24px** |
| Hover (if link) | border `brand`, shadow `md`; transition 150ms |
| Meta | Small / `brand` or `muted` (date) |
| Title | H4 |
| Body | Small or Body, `muted`, max 2–3 lines (`line-clamp`) |
| Footer | Caption / brand text (e.g. member count) |
| Focus | If whole card is link: focus ring on container |

### 8.2 List tile (ministry members, compact rows)

- Padding 12–16px
- Radius `md` or `lg`
- Horizontal: primary text left, meta right
- No heavy shadow

### 8.3 What is not a card

- Hero
- Footer columns
- Flash banners (use Alert)
- Bare text sections (About)

**Max layouts:** 2 (content card, list tile). Do not invent “glass”, “elevated gradient”, or “stat strip” cards.

---

## 9. Navigation

### 9.1 Desktop (≥1024px)

- Sticky header: height 64px, bg `surface`, border-bottom `border`, optional `shadow-sm` when scrolled
- Left: Logo / wordmark (`ChurchInfo.name`, Literata 700, `brand` or `ink`)
- Center/right: Nav links gap **24px**
- Far right: **one** Primary button CTA (“Kết nối ngay”)
- Language of labels: **Vietnamese** (unify with `lang="vi"`) — e.g. Trang chủ, Giới thiệu, Người mới, Sự kiện, Ban ngành, Liên hệ
- Phase-2 items (Sermons/Gallery): **omit from primary nav** until real, or park under a single “Thêm” only if needed — do not keep coming-soon in primary nav

**Hover:** text `brand`  
**Active:** text `brand`, weight 600, `aria-current="page"` (optional 2px brand underline)

### 9.2 Mobile (<1024px)

- Logo left; icon button right (SVG menu, 44×44 hit area, `aria-expanded`, `aria-controls`)
- Panel: full-width sheet under header or full-screen; bg `surface`; `shadow-lg`
- Stack links: padding 16px; min height 44px
- Include Primary CTA inside panel
- Close on navigate / Escape

### 9.3 Dropdowns (if needed later)

- Radius `lg`, shadow `lg`, border `border`, padding 8px
- Item height 40–44px; hover `surface-alt`
- Keyboard: arrows + Escape
- **Do not** implement dropdowns for the current IA if flat links suffice

---

## 10. Responsive system

| Name | Min width | Columns / nav | Type / spacing |
|------|-----------|---------------|----------------|
| **Mobile** | 0 | 1 col; hamburger; stacked forms | H1 32/40; H2 28/36; section py 64 |
| **Tablet** | 640px | 2-col cards; forms may 2-col | H1 36/44; section py 64–80 |
| **Desktop** | 1024px | Full nav; 3-col cards; content max 72rem | Full type scale; section py 80 |
| **Large** | 1280px | Same structure; wider gutters 32–40 | Hero may full-bleed image |

**Breakpoints (Tailwind-aligned):** `sm 640` · `md 768` · `lg 1024` · `xl 1280`  
**Behavior rules:** No horizontal scroll. Touch targets ≥44px. Images `width:100%`, define aspect ratio.

---

## 11. Accessibility

| Area | Minimum requirement |
|------|---------------------|
| **Contrast** | Body/UI text ≥4.5:1; large text (≥18.66px bold / 24px) ≥3:1; non-text UI ≥3:1 |
| **Focus** | `:focus-visible` ring 2px `brand` (or `danger` on error controls), 2px offset; never `outline: none` without replacement |
| **Keyboard** | All actions reachable; logical tab order; menus Esc to close; no keyboard trap |
| **Interactive** | Buttons are `<button>` or clearly focused links; hit area ≥44×44 |
| **Forms** | `<label for>`; errors in text + `aria-invalid` + `aria-describedby`; success via `role="status"` |
| **Flash** | Success/info `role="status"`; error `role="alert"` |
| **Semantics** | `header` / `nav` / `main` / `footer`; one H1; landmark skip link “Đến nội dung chính” |
| **Motion** | Respect `prefers-reduced-motion`; transitions ≤200ms; no required motion for meaning |
| **Language** | `<html lang="vi">`; labels match page language |

---

## 12. Component principles

### Reuse when

The same **user job** appears in ≥2 places with the same structure (e.g. primary CTA, text field, event card, flash, empty state).

### Extend when

≥80% shared structure; difference is a **prop** (`variant`, `size`, `href`). Example: Button variants; Card with/without meta.

### Create new when

A **distinct job** appears that existing components cannot express without awkward props. Example: Registration capacity alert ≠ generic flash if it has unique actions — still prefer extending Alert with `tone="warning"` first.

### Do not create

- Extra button sizes beyond default + compact
- Color variants of cards
- Separate “HomeEventCard” vs “EventsIndexCard” if layout matches
- Emoji-icon components as brand
- Parallel design tokens (CDN indigo + Vite teal)

### Initial public component set (extract when implementing)

1. `Button`
2. `FormField`
3. `Card` / `ListTile`
4. `PageHeader`
5. `SectionHeader`
6. `Flash` / `Alert`
7. `EmptyState`
8. `StatusChip`
9. `Logo` + `SiteNav` + `SiteFooter`

### Filament alignment (when implementing)

- Set panel `primary` to brand teal (both panels)
- `brandName` ← `ChurchInfo` name (or same string source)
- Do not invent a parallel admin palette beyond semantic status

---

## Implementation notes (for later)

1. Replace Tailwind CDN with Vite + CSS variables matching this spec.
2. Load Literata + Be Vietnam Pro (build already had these fonts).
3. Map tokens to `@theme` in `app.css`.
4. Refactor public layout/pages to components above without changing business logic.
5. Hide or remove Sermons/Gallery from primary nav until Phase 2.
6. Keep success/error copy and routes as they are.

---

## CSS variable mapping (suggested for implementation)

```css
@theme {
  --font-sans: "Be Vietnam Pro", ui-sans-serif, system-ui, sans-serif;
  --font-display: "Literata", ui-serif, "Times New Roman", serif;

  --color-brand: #006E58;
  --color-brand-hover: #005542;
  --color-brand-soft: #C9F2E8;
  --color-secondary: #001318;
  --color-accent: #B8953B;
  --color-canvas: #FBFAF6;
  --color-surface: #FFFFFF;
  --color-surface-alt: #EAF7F3;
  --color-ink: #081822;
  --color-muted: #495762;
  --color-border: #B4CAC4;
  --color-border-strong: #7A9690;
  --color-border-danger: #B91C1C;
  --color-success: #197037;
  --color-warning: #A16207;
  --color-danger: #B91C1C;
  --color-info: #0B6E99;
  --color-on-brand: #FFFFFF;
  --color-on-inverse: #FFFFFF;
  --color-on-inverse-muted: #97A8AB;
}
```

---

*Saved for development progress lookup. Spec v1.0.*
