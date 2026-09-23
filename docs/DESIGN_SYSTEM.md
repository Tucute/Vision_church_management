# Design System — Hội Thánh Tin Lành Ân Điển  
### Grace Evangelical Church · “Open Door Light”

**Version:** 2.0  
**Status:** Approved and implemented on public UI  
**Authority:** Visual source of truth for a unified church identity across all public pages (and Filament theming when applied)  
**Creative basis:** [`.agents/ui/design-direction-v2.md`](../.agents/ui/design-direction-v2.md)  
**Preserves:** Routes, content, CMS/data, business logic, APIs  

**Goal:** Every page must feel like the same house of grace — warm, calm, trustworthy, gospel-centered — never like a SaaS product, startup landing page, or generic template.

---

## 0. Design principles (binding)

1. **One identity** — Same colors, type, rhythm, and component skin on every page.  
2. **Brand first** — Church name is a hero-level signal, not a tiny nav label.  
3. **Human sanctuary** — Photography, breath, and clear Word over decoration.  
4. **Few variants** — Small palette, few button styles, few card patterns.  
5. **Quiet craft** — No glassmorphism, purple gradients, neon, or trend tricks.  
6. **Vietnamese-first** — UI chrome and reading type support Vietnamese well.  
7. **Accessible by default** — Contrast, focus, labels, keyboard paths required.

---

## 1. Colors

### 1.1 Philosophy

**Ink of the Word + warmth of the house + one brass note of reverence.**

Primary is deep hymnbook ink (trust, Word), not a bright marketing hue. Surfaces are warm plaster and paper. Accent brass is rare and ceremonial — never the main CTA fill.

### 1.2 Core palette (keep small)

| Token | CSS name | Hex | Purpose |
|-------|----------|-----|---------|
| **Primary** | `--color-primary` | `#1A2744` | Brand actions, primary buttons, key links, focus rings, active nav |
| **Primary dark** | `--color-primary-dark` | `#121B30` | Primary hover/active, pressed states |
| **Primary light** | `--color-primary-light` | `#E8ECF3` | Soft selected chips, soft focus washes, subtle highlights |
| **Secondary** | `--color-secondary` | `#5C6470` | Secondary UI emphasis, icons at rest, supporting labels |
| **Accent** | `--color-accent` | `#9A7B4F` | Ceremonial highlight only (special labels, thin ornaments) |
| **Background** | `--color-background` | `#F3F1EC` | Page canvas / body background |
| **Surface** | `--color-surface` | `#FFFDF8` | Cards, forms, sticky header, elevated panels |
| **Text** | `--color-text` | `#1A2744` | Primary body and heading text (same family as Primary) |
| **Muted text** | `--color-text-muted` | `#5C6470` | Meta, hints, captions, placeholders (placeholder may use `#7A8290`) |
| **Border** | `--color-border` | `#C9C4B8` | Dividers, input/card strokes |
| **Success** | `--color-success` | `#2F6A4A` | Success messages, “open registration” |
| **Warning** | `--color-warning` | `#8A6A2F` | Caution, capacity full, pending |
| **Error** | `--color-error` | `#8F2F2F` | Errors, destructive emphasis |

### 1.3 Supporting surfaces (still minimal)

| Token | Hex | Use |
|-------|-----|-----|
| **Surface alt** | `#E7E9E2` | Alternating section bands (olive-stone) |
| **Accent soft** | `#EDE4D4` | Rare soft ceremonial band (invite strip) |
| **Inverse** | `#141C2E` | Footer / dark sanctuary band |
| **On primary** | `#FFFDF8` | Text/icons on primary-filled controls |
| **On inverse** | `#FFFDF8` | Footer titles |
| **On inverse muted** | `#A8B0BD` | Footer secondary text |

### 1.4 Soft status pairs (fixed)

| Status | Background | Foreground |
|--------|------------|------------|
| Success soft | `#E3F0E8` | Success `#2F6A4A` |
| Warning soft | `#F3ECDC` | Warning `#8A6A2F` |
| Error soft | `#F5E4E4` | Error `#8F2F2F` |
| Info soft | `#E4EAF1` | Primary / `#3A5A7A` |

### 1.5 Color rules

| DO | DON’T |
|----|-------|
| Use Primary for CTAs and text links | Use Accent as a primary button fill |
| Use Background + Surface for most UI | Introduce teal, purple, or terracotta brand colors |
| Use Border for structure (not heavy shadows) | Rainbow status without text labels |
| Keep Accent scarce | Gradient fills as brand identity |

### 1.6 Accessibility

- Text / Muted text on Background or Surface: **≥ 4.5:1**  
- On primary on Primary: **≥ 4.5:1**  
- Accent as text: large text only, or decorative non-text  
- Never convey state by color alone  

---

## 2. Typography

### 2.1 Families

| Role | Family | Notes |
|------|--------|-------|
| **Display** | **Fraunces** | Soft, human serif — grace and welcome; H1–H2, wordmark |
| **UI / Body** | **Be Vietnam Pro** | Vietnamese diacritics; body, nav, buttons, forms |
| **Mono** | System mono | Rare (IDs/codes only) |

**Do not use:** Inter, Roboto, Arial, system-ui as brand defaults.

### 2.2 Scale

Desktop values. Mobile: step H1/H2 down one increment (see Responsive).

| Style | Family | Size | Weight | Line height | Letter spacing | Use |
|-------|--------|------|--------|-------------|----------------|-----|
| **Display** | Fraunces | 56px | 700 | 64px (1.14) | −0.025em | Optional oversized wordmark moments |
| **H1** | Fraunces | 44px | 700 | 52px (1.18) | −0.02em | Page heroes — one per page |
| **H2** | Fraunces | 32px | 600 | 40px (1.25) | −0.015em | Section titles |
| **H3** | Be Vietnam Pro | 22px | 600 | 30px (1.36) | −0.01em | Subsections |
| **H4** | Be Vietnam Pro | 18px | 600 | 26px (1.44) | 0 | Card titles, form group titles |
| **Body** | Be Vietnam Pro | 17px | 400 | 28px (1.65) | 0 | Paragraphs, form values |
| **Small** | Be Vietnam Pro | 14px | 400 | 22px (1.57) | 0 | Meta, secondary |
| **Caption** | Be Vietnam Pro | 12px | 500 | 18px (1.5) | 0.02em | Timestamps, legal, chips |
| **Navigation** | Be Vietnam Pro | 14px | 500 / **600 active** | 20px | 0 | Header links |
| **Button** | Be Vietnam Pro | 14px | 600 | 20px | 0.01em | All button labels |

### 2.3 Hierarchy rules

- Exactly **one H1** per page.  
- Section titles use **H2** (Fraunces).  
- Card titles use **H4** styling (Be Vietnam Pro), semantically `h3` under a section `h2` is acceptable.  
- Prefer fewer words at Display/H1 sizes.  
- Links in body: Primary color, weight 500–600; underline on hover.  

---

## 3. Spacing

### 3.1 Scale (4px base)

| Token | Value | Typical use |
|-------|-------|-------------|
| `space-1` | 4px | Icon gaps |
| `space-2` | 8px | Label → control; tight stacks |
| `space-3` | 12px | Compact padding |
| `space-4` | 16px | Default control padding-x; form field stack |
| `space-5` | 24px | Card padding; group gaps |
| `space-6` | 32px | Card grid gap |
| `space-7` | 48px | Blocks within a section |
| `space-8` | 64px | Section padding-y (mobile) |
| `space-9` | 80px | Section padding-y (tablet/desktop default) |
| `space-10` | 96px | Large section breathing (desktop) |
| `space-11` | 120px | Hero vertical presence (desktop) |

**Forbidden:** One-off values (13, 18, 22…) outside type/icon needs.

### 3.2 Philosophy

Space is pastoral care for the eye — **unhurried**. Prefer more Background showing than packed widgets.

---

## 4. Containers

### 4.1 Max widths

| Container | Max width | Use |
|-----------|-----------|-----|
| **Content** | 72rem (1152px) | Nav inner, card grids, standard sections |
| **Reading** | 42rem (672px) | About, long prose, form-focused columns |
| **Narrow** | 36rem (576px) | Single-column forms (I’m New) |
| **Wide story** | 80rem (1280px) | Optional editorial image+text bands |
| **Full bleed** | 100% | Hero photography, footer background, section bands |

### 4.2 Horizontal padding (page gutters)

| Breakpoint | Padding |
|------------|---------|
| Mobile | 16px |
| Tablet (≥640px) | 24px |
| Desktop (≥1024px) | 32px |
| Large (≥1280px) | 40px |

### 4.3 Section spacing

| Context | Vertical padding |
|---------|------------------|
| Mobile | 64px |
| Tablet | 80px |
| Desktop | 80–96px |
| Hero (desktop) | 96–120px (or image-driven min-height) |

### 4.4 Grid system

| Pattern | Columns | Gap |
|---------|---------|-----|
| Mobile | 1 | — |
| Tablet | 2 | 32px |
| Desktop lists | 3 | 32px |
| Contact split | 1 → 2 at `lg` | 48px |
| Member tiles | 1 → 2 at `md` | 12–16px |

**Align** to Content max width. Do not mix competing max-width wrappers for the same content type.

---

## 5. Buttons

### 5.1 Variants (only these)

| Variant | Use |
|---------|-----|
| **Primary** | Main action: connect, submit, register |
| **Secondary** | Alternative: view events, cancel-adjacent |
| **Ghost** | Low emphasis on light bands |
| **Text** | Inline “Xem tất cả”, back links |
| **Destructive** | Irreversible admin-adjacent actions only (rare on public) |

### 5.2 Shared metrics

| Property | Default | Compact |
|----------|---------|---------|
| Height | **44px** | 36px (dense tables only) |
| Padding-x | 20px | 16px |
| Radius | **8px** (`radius-md`) | same |
| Type | Button style (14/20, 600) | same |
| Icon | 16px; gap 8px; leading preferred | same |
| Min hit area | 44×44 | 36×36 desktop dense |

### 5.3 Recipes & states

#### Primary
| State | Spec |
|-------|------|
| Default | bg Primary · text On primary · border none |
| Hover | bg Primary dark |
| Active | bg Primary dark |
| Focus-visible | 2px outline Primary · 2px offset on Background |
| Disabled | bg `#9AA3B5` · text `#F5F2EC` · no hover · `disabled` |

#### Secondary
| State | Spec |
|-------|------|
| Default | bg Surface · text Text · border 1px Border |
| Hover | bg Surface alt · border `#B5AFA3` |
| Active | bg Primary light |
| Focus-visible | same ring as Primary |
| Disabled | text Muted · border Border · bg Background |

#### Ghost
| State | Spec |
|-------|------|
| Default | transparent · text Primary |
| Hover | bg Primary light |
| Active | bg `#D9DEE8` |
| Focus-visible | Primary ring |
| Disabled | text `#9AA3B5` |

#### Text
| State | Spec |
|-------|------|
| Default | text Primary · no padding box · underline none |
| Hover | underline |
| Active | Primary dark |
| Focus-visible | ring around text |
| Disabled | Muted · no underline |

#### Destructive
| State | Spec |
|-------|------|
| Default | bg Error · text On primary |
| Hover | `#7A2828` |
| Focus-visible | Error ring |
| Disabled | washed `#E0B3B3` |

### 5.4 Button rules

- One Primary CTA per section.  
- No gradient buttons, no Accent-filled CTAs.  
- No emoji in buttons.  

---

## 6. Cards

### 6.1 Philosophy

**Few patterns.** Cards are for **interaction** (browse events/ministries) — not for wrapping every paragraph.

### 6.2 Allowed patterns (only two)

#### A. Content card (lists)
| Part | Spec |
|------|------|
| Container | Surface · 1px Border · radius **10px** · padding **24px** |
| Resting elevation | **None** (border only) |
| Hover (if link) | Border → Primary · optional `shadow-sm` · 150ms |
| Focus | Visible ring on whole card |
| Meta | Small · Primary or Muted |
| Title | H4 |
| Body | Small · Muted · max 2–3 lines |
| Footer / status | Caption or Status chip |

Used for: events, ministries (same component).

#### B. List tile (compact rows)
| Part | Spec |
|------|------|
| Container | Surface · 1px Border · radius **8px** · padding 12–16px |
| Layout | Title left · meta right |
| Hover | Only if linked — border Primary |

Used for: ministry members (public names/roles).

### 6.3 Not cards

Hero, footer columns, About prose, flash alerts, invite bands.

### 6.4 Do not create

Glass cards, gradient cards, “stat” cards, multiple competing card skins per page.

---

## 7. Images

### 7.1 Photography style

- Real congregation, open door, fellowship, quiet sanctuary detail  
- Natural light; gentle warm grade; no HDR crunch  
- Prefer authentic church photos over generic stock  
- Faces readable; respectful candid framing  

### 7.2 Aspect ratios

| Context | Ratio | Notes |
|---------|-------|-------|
| Home hero | **16:9** desktop · **4:5** mobile crop | Full-bleed plane |
| Editorial story | **4:3** or **3:2** | Beside text |
| Thumbnail / card media (if any) | **16:9** | Optional future |
| Logo | Intrinsic SVG | No forced crop |

### 7.3 Border radius

| Context | Radius |
|---------|--------|
| Full-bleed hero | **0** |
| Inline editorial image | **10px** |
| Avatar (if ever) | **full** |

### 7.4 Treatment

- `object-fit: cover` for crops; never distort  
- Lazy-load below the fold; hero eager for LCP  
- Always width/height or aspect-ratio to reduce CLS  

### 7.5 Overlay usage

| Allowed | Spec |
|---------|------|
| Hero scrim | Soft gradient **ink at low opacity** (≈ 28–70%) for text legibility only |
| | Direction: bottom or content-side → transparent |

**Forbidden on images:** Floating badges, promo stickers, glass panels, multi-stop rainbow overlays.

### 7.6 Alt text

Meaningful Vietnamese (or empty alt if pure decoration). Brand logo alt = church name.

---

## 8. Icons

### 8.1 Style

- **Outline** only (single set, e.g. Heroicons-style)  
- Consistent stroke; no mixing filled + outline systems  
- No emoji as icons or brand marks  

### 8.2 Size

| Context | Size |
|---------|------|
| Inside buttons / nav | **16px** |
| Standalone UI | **20px** |
| Empty / feature moment | **24px** |

### 8.3 Stroke

**1.75px** optical (1.5–2px range); round caps/joins.

### 8.4 Color

- Inherit text color by default  
- At rest: Secondary / Text  
- Interactive: Primary on hover when appropriate  
- Decorative: `aria-hidden="true"`  

---

## 9. Border radius (global)

| Token | Value | Apply |
|-------|-------|-------|
| `radius-sm` | 4px | Chips, small controls |
| `radius-md` | 8px | Buttons, inputs, list tiles |
| `radius-lg` | 10px | Content cards, alerts, dropdowns |
| `radius-xl` | 12px | Large inline media |
| `radius-full` | 9999px | Status pills, avatars |

Smaller than typical SaaS kits — intentional, timeless.

---

## 10. Elevation / shadow

| Token | Value | Use |
|-------|-------|-----|
| `shadow-none` | none | Default resting UI |
| `shadow-sm` | `0 1px 2px rgba(26,39,68,0.06)` | Optional card hover |
| `shadow-md` | `0 8px 24px rgba(26,39,68,0.12)` | Dropdown, modal |

No colored glows. Prefer Border over shadow.

---

## 11. Forms (control skin)

Shared with buttons for coherence:

| Property | Spec |
|----------|------|
| Height | 44px |
| Padding | 12px 16px |
| Radius | 8px |
| Border | 1px Border |
| Background | Surface |
| Text | 17px Body (avoid &lt;16px on iOS) |
| Focus | Border Primary + 2px Primary ring |
| Error | Border Error + error text via `aria-describedby` |
| Label | Small 14px / 600 / Text · gap 8px |

Anatomy: **Label → Control → Hint → Error**

Mobile: single column. `sm+`: optional 2 columns.

---

## 12. Navigation

| Item | Spec |
|------|------|
| Header height | 64px |
| Background | Surface · 1px bottom Border |
| Wordmark | Fraunces · Primary · church name |
| Links | Navigation style · hover Primary · active weight 600 + `aria-current` |
| CTA | One Primary button |
| Language | Vietnamese labels |
| Phase-2 routes | Omit from primary nav until real |
| Mobile | SVG menu 44×44 · panel Surface · `shadow-md` · `aria-expanded` |
| Skip link | “Đến nội dung chính” |

---

## 13. Responsive design

| Name | Min width | Behavior |
|------|-----------|----------|
| **Mobile** | 0 | 1 col · hamburger · stacked CTAs · H1 36/44 · section py 64 · hero 4:5 crop |
| **Tablet** | 640px | 2-col cards · forms may 2-col · H1 40/48 · section py 80 |
| **Desktop** | 1024px | Full nav · 3-col cards · content 72rem · full type · hero 16:9 |
| **Large** | 1280px | Wider gutters · more margin, **not** more widgets |

Breakpoints (Tailwind-aligned): `sm 640` · `md 768` · `lg 1024` · `xl 1280`

**Rules:** No horizontal scroll · touch ≥ 44px · reflow content rather than icon-only meaning.

---

## 14. Motion

### 14.1 Philosophy

Motion confirms place and hierarchy — **never entertainment**. Max **2–3** intentional motions on a visually led page.

### 14.2 Allowed

| Type | Spec |
|------|------|
| **Hover** | Buttons/cards: ≤ **150ms** ease-out · color/border change |
| **Fade** | Hero text or soft appear: **180–220ms** opacity |
| **Slide** | Mobile nav panel: **200ms** short translateY/opacity |
| **Page transition** | Prefer **none** (MPA). If added later: simple 150ms fade only — no shared-element theater |

### 14.3 Forbidden

Loops, parallax stacks, bounce, continuous ken-burns, scroll-hijack storytelling, glass shimmer.

### 14.4 Reduced motion

```css
@media (prefers-reduced-motion: reduce) {
  /* disable non-essential transitions and fades */
}
```

---

## 15. Feedback states

| State | Pattern |
|-------|---------|
| **Empty** | Title + one sentence + optional Secondary/Text CTA (`EmptyState`) |
| **Loading** | Disable submit + optional spinner; label “Đang gửi…” · reserve space |
| **Error** | Field: Error text + border · Page: Error soft Alert `role="alert"` |
| **Success** | Success soft Alert `role="status"` |
| **Warning / Info** | Soft pairs · text always present |

---

## 16. Component inventory (unified skin)

All pages share the same components and tokens:

`Button` · `FormField` · `ContentCard` · `ListTile` · `Alert` · `EmptyState` · `StatusChip` · `SectionHeader` · `PageHeader` · `Container` · `Logo` · `SiteHeader` · `SiteFooter` · `HomeHero` · `CtaBand` · `Icon` · `ContactInfo`

**Extend via props** before inventing new components.

---

## 17. Page coherence checklist

Before shipping any page UI:

- [ ] Uses only this palette (no indigo/teal/purple leftovers)  
- [ ] Fraunces + Be Vietnam Pro only for brand type  
- [ ] Spacing on scale; containers correct  
- [ ] Same header/footer as other pages  
- [ ] Cards only where interactive lists need them  
- [ ] Hero (if any) brand-first; no badge clutter  
- [ ] Focus rings + contrast OK  
- [ ] Vietnamese chrome  
- [ ] No business-logic changes unless requested  

---

## 18. Token mapping (for later implementation)

Suggested CSS variables:

```css
@theme {
  --font-sans: "Be Vietnam Pro", ui-sans-serif, system-ui, sans-serif;
  --font-display: "Fraunces", ui-serif, "Times New Roman", serif;

  --color-primary: #1A2744;
  --color-primary-dark: #121B30;
  --color-primary-light: #E8ECF3;
  --color-secondary: #5C6470;
  --color-accent: #9A7B4F;
  --color-background: #F3F1EC;
  --color-surface: #FFFDF8;
  --color-surface-alt: #E7E9E2;
  --color-text: #1A2744;
  --color-text-muted: #5C6470;
  --color-border: #C9C4B8;
  --color-success: #2F6A4A;
  --color-warning: #8A6A2F;
  --color-error: #8F2F2F;
  --color-inverse: #141C2E;
  --color-on-primary: #FFFDF8;
  --color-accent-soft: #EDE4D4;

  --radius-sm: 4px;
  --radius-md: 8px;
  --radius-lg: 10px;
  --radius-xl: 12px;
}
```

Filament panels (when themed): map `primary` to Primary `#1A2744` so staff tools feel related.

---

## 19. Document control

| Field | Value |
|-------|--------|
| File | `docs/DESIGN_SYSTEM.md` |
| Direction | Open Door Light |
| Church | Hội Thánh Tin Lành Ân Điển / Grace Evangelical Church |
| Implementation | **Live** — public UI + Filament primary aligned to Open Door Light |

*This design system exists so every page feels like one church — one house of grace.*
