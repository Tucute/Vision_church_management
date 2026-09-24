# Grace Evangelical Church — Visual Design Direction & Design System Proposal (v2)

**Church:** Grace Evangelical Church / Hội Thánh Tin Lành Ân Điển  
**Status:** Proposal only — **do not implement until approved**  
**Preserves:** Routes, content, CMS/data, business logic, APIs  
**Replaces (visually):** Current teal / utility-card / SaaS-adjacent system (v1)

---

## Why the current UI feels wrong

The live site (even after token cleanup) still reads as a **generic product website**:

- Teal primary + soft mint bands → startup / SaaS health-app cues  
- Uniform bordered cards in grids → dashboard / template kits  
- Utility-first Tailwind rhythm → “component library demo,” not a congregation  
- Weak brand presence in the first viewport → remove the nav and it could be any nonprofit SaaS  
- Little photography, little material atmosphere → flat and interchangeable  

Grace’s story (gospel, welcome, reverence, community) is not yet visible in the form.

---

# Part A — Creative foundation

## 1. Creative direction

### Name
**“Open Door Light”** (Ánh sáng nơi cửa mở)

### One-sentence concept
A gathering place of grace: soft daylight in a lived-in sanctuary, clear Word, open door — warm enough to feel human, quiet enough to feel reverent.

### Mood board keywords
Open door · soft window light · worn wood · open Bible · shared meal · quiet pew · linen · brass hymn number · olive branch · Vietnamese congregation faces · Sunday morning calm  

### What we are designing for
Not a product to convert users. A **house of grace** that invites a first-time visitor to feel: *I could belong here.*

### What we explicitly reject
| Reject | Why |
|--------|-----|
| SaaS / startup landing | Growth-hack CTAs, feature grids, indigo/teal product chrome |
| Corporate nonprofit brochure | Stock handshakes, navy+orange “impact” kits |
| Generic church template | Clip-art crosses, purple gradients, stock steeple hero |
| “AI website” look | Perfect equal cards, purple glow, glass panels, trend fonts |
| Luxury cathedral brand | Marble, gold excess, fashion-serif swagger |
| Loud revival flyer | Neon, heavy drop shadows, chaotic badges |

### Timeless stance
Modern in clarity and whitespace; traditional in hierarchy and restraint. Looks correct in 2026 and still honest in 2032.

---

## 2. Brand personality

| Trait | Design implication |
|-------|-------------------|
| **Christian / Gospel-centered** | Word and welcome lead; cross may appear as quiet mark, never decoration spam |
| **Warm** | Warm stone surfaces, soft light, human photography |
| **Welcoming** | Open-door metaphor; clear primary invite; Vietnamese-first voice |
| **Trustworthy** | Steady navy-ink, readable type, no gimmicks |
| **Community** | Faces, gatherings, ministries as people — not icon rows |
| **Grace** | Soft luminosity; generous space; never aggressive sales urgency |
| **Reverence** | Calm motion, reserved accent metal, dignified display type |
| **Human** | Slightly imperfect warmth; avoid sterile pure-white corporate slabs |

**Personality opposite:** cold tech, luxury fashion, entertainment megachurch neon.

**Voice in UI chrome:** Vietnamese, plain, kind — “Kết nối với chúng tôi,” not “Get started.”

---

## 3. Color philosophy

### Idea
**Ink of the Word + warmth of the house + a single brass note of reverence.**

Not “brand teal for conversion.” Color should feel like **printed hymnbook + Sunday morning plaster + candle brass.**

### Palette (proposed)

| Token | Hex | Role | Emotion |
|-------|-----|------|---------|
| **`ink`** | `#1A2744` | Primary text, primary buttons, key UI | Word, trust, evening service |
| **`ink-soft`** | `#2C3F66` | Hover links, secondary emphasis | Softened authority |
| **`canvas`** | `#F3F1EC` | Page background (warm stone plaster — *not* paired with terracotta) | House walls, calm |
| **`surface`** | `#FFFdf8` | Cards, forms, header (warm paper, not pure #FFF) | Open Bible page |
| **`surface-alt`** | `#E7E9E2` | Alternating bands (olive-stone) | Garden / peace undertone |
| **`line`** | `#C9C4B8` | Borders, quiet rules | Mortar, restraint |
| **`muted`** | `#5C6470` | Meta, captions | Soft speech |
| **`brass`** | `#9A7B4F` | Rare sacred accent only | Communion vessel, hymn board |
| **`brass-soft`** | `#EDE4D4` | Soft ceremonial wash | Candle warmth without glow spoons |
| **`inverse`** | `#141C2E` | Footer / dark band | Night sanctuary |
| **`on-ink`** | `#FFFdf8` | Text on ink buttons | Clear |
| **Semantic success** | `#2F6A4A` | Open registration, success | Life / growth (not brand teal takeover) |
| **Semantic warning** | `#8A6A2F` | Full / caution | Brass-adjacent warning |
| **Semantic danger** | `#8F2F2F` | Errors | Honest, not neon |
| **Semantic info** | `#3A5A7A` | Info notices | Soft ink |

### Rules
1. **Primary action color = `ink`**, not a bright “marketing” hue.  
2. **`brass` never fills primary CTAs** — only thin accents, small marks, special labels.  
3. **No purple. No teal-as-brand. No terracotta clay accent.**  
4. **No gradient washes as identity** — use photography and surface shifts. Soft hero scrim only for text legibility on images.  
5. Surfaces carry warmth; color accents stay scarce so the site feels calm.

### Accessibility
- `ink` on `canvas` / `surface` ≥ 4.5:1  
- `on-ink` on `ink` ≥ 4.5:1  
- `muted` on `canvas` verified ≥ 4.5:1  
- Brass text only at large sizes or as non-text decoration  

---

## 4. Typography direction

### Pairing
| Role | Family | Why |
|------|--------|-----|
| **Display** | **Fraunces** (600–700) | Soft, human serif with optical warmth — “grace” without luxury fashion swagger or newspaper broadsheet hardness |
| **Body / UI** | **Be Vietnam Pro** (400–700) | Excellent Vietnamese diacritics; contemporary clarity |

### Rejected for this brand
- Inter / Roboto / system UI stacks (generic product)  
- Literata + mint teal (current SaaS-church hybrid)  
- Ultra-condensed display or decorative blackletter  

### Scale philosophy
- **Larger display, fewer words** in heroes  
- Body stays 16–18px for Vietnamese reading comfort  
- Display tracking slightly tight (−0.02em); body neutral  
- One H1; section H2 in Fraunces; card titles in Be Vietnam Pro semibold (UI voice)

### Sample hierarchy (desktop)
| Style | Size / line | Weight |
|-------|-------------|--------|
| H1 | 44–48 / 1.15 | Fraunces 700 |
| H2 | 32–36 / 1.2 | Fraunces 600–700 |
| H3 | 22–24 / 1.3 | Be Vietnam Pro 600 |
| Body | 17 / 1.65 | Be Vietnam Pro 400 |
| Small | 14 / 1.55 | 400–500 |
| Nav / Button | 14–15 / 1.3 | 600 |

---

## 5. Layout philosophy

### Principle: **Sanctuary editorial**, not product dashboard

1. **Breath first** — more empty plaster than packed widgets.  
2. **One job per section** — one headline, one support line, one primary action max.  
3. **Brand before pitch** — church name is a hero-level signal, not a tiny nav word.  
4. **Photography as architecture** — full-bleed hero plane; not inset cards of images.  
5. **Cards are tools, not decoration** — only for interactive lists (events, ministries). Prose pages stay uncarded.  
6. **Asymmetry with calm** — e.g. home after-hero: text block + one image column, not three equal marketing tiles.  
7. **Footer as quiet room** — dark ink, sparse links, no icon soup.

### Composition metaphor
Sunday morning bulletin clarity + living-room hospitality — not a landing-page “conversion funnel.”

---

## 6. Component philosophy

### Build fewer, quieter components
Keep the architecture map’s levels, but **change their visual character**:

| Component | New character |
|-----------|----------------|
| **Button primary** | Solid `ink`, soft radius (8px), no glow; label calm |
| **Button secondary** | Paper surface + `line` border; hover fills `surface-alt` |
| **Button link** | Ink text, underline on hover — like a footnote invite |
| **Card** | Paper surface, 1px `line`, radius 8–10px, **no resting shadow**; hover = ink border only |
| **Nav** | Textual, weight shift for active; single ink CTA |
| **Inputs** | Paper fill, `line` border, ink focus ring; 44px tall |
| **Alert** | Soft semantic washes; no loud banners |
| **Hero** | Image + scrim + brand + one line + CTA group — **no cards, no stats, no badges** |

### Do not invent
Glass cards, gradient buttons, floating promo chips, icon-feature grids, pill clouds, metric strips.

### Filament
Same ink primary (`#1A2744` palette) so staff tools feel like the same family — still Filament chrome, not a second product brand.

---

## 7. Photography / image direction

### Subject matter (priority)
1. Congregation worship / singing (respectful, candid)  
2. Open door / entrance with light  
3. Hands, shared fellowship, teaching moments  
4. Quiet sanctuary details (wood, light, Bible) — supporting, not stock “steeple porn”

### Treatment
- Natural light; slight warm grade; avoid HDR crunch  
- Full-bleed heroes; faces large enough to feel human  
- Prefer real church photos over generic stock  
- Logo: simple wordmark or restrained cross+wordmark SVG — no emoji  

### Alt text
Descriptive, respectful, Vietnamese when UI is Vietnamese.

### Asset folders (when implementing later)
`public/images/brand/`, `public/images/home/hero` — currently empty; direction requires filling them.

---

## 8. Spacing philosophy

### Idea: **Liturgical breathing room**
Space is pastoral care for the eye — unhurried.

| Use | Guidance |
|-----|----------|
| Base unit | Still 4px for engineering discipline |
| Section vertical | 80–120px desktop; 64–80 mobile — slightly **more** than SaaS density |
| Card padding | 24px |
| Grid gap | 24–32px (never cramped 16px marketing grids) |
| Max measure for prose | ~40–48rem |
| Content width | ~72rem for grids |

Whitespace > decoration.

---

## 9. Responsive philosophy

| Viewport | Behavior |
|----------|----------|
| **Mobile** | Single column; brand large; CTAs stack; hamburger quiet; hero image still full-bleed (taller crop) |
| **Tablet** | 2-col cards; prose comfortable |
| **Desktop** | Full nav; hero editorial; optional 2-col story bands |
| **Large** | More margin, not more widgets |

Touch targets ≥ 44px. No horizontal scroll. Prefer **reflow**, not hiding meaning behind icons-only chrome.

---

## 10. Homepage visual concept

### First viewport (hero)
**Full-bleed photograph** (gathering or open-door light) with soft dark-to-ink scrim on the lower/left third for text.

Content only:
1. **Church name** (Fraunces, large) — brand as hero  
2. **One welcome line** (short)  
3. **One supporting sentence** (mission excerpt)  
4. **CTA group:** primary “Tôi là người mới” + secondary “Xem sự kiện”  

No stats, no event chips, no floating badges, no card overlays.

### Below the fold
1. **Welcome / grace statement** — short editorial block (maybe with a secondary quiet image) — uncarded  
2. **Sự kiện sắp tới** — Section title + 1–3 list cards (or empty state) + “Xem tất cả”  
3. **Ban ngành** — olive-stone band; same card system; people-forward titles  
4. **Invite band** — ink or soft brass-soft wash; “Lần đầu đến với chúng tôi?” + single CTA  
5. **Footer** — inverse ink room  

### Motion (2–3 max)
- Hero image slow ken-burns **off** by default; prefer static  
- Fade-in of hero text once (~200ms)  
- Card border hover (~150ms)  
Respect `prefers-reduced-motion`.

---

# Part B — Complete Design System proposal (v2)

## B1. Color tokens (implementation-ready)

```text
ink / brand action     #1A2744
ink-soft               #2C3F66
canvas                 #F3F1EC
surface                #FFFDF8
surface-alt            #E7E9E2
line / border          #C9C4B8
muted                  #5C6470
brass                  #9A7B4F
brass-soft             #EDE4D4
inverse                #141C2E
on-ink / on-inverse    #FFFDF8
on-inverse-muted       #A8B0BD
success / soft         #2F6A4A / #E3F0E8
warning / soft         #8A6A2F / #F3ECDC
danger / soft          #8F2F2F / #F5E4E4
info / soft            #3A5A7A / #E4EAF1
```

## B2. Typography tokens

- `--font-display: Fraunces`  
- `--font-sans: Be Vietnam Pro`  
- Scale as in §4  

## B3. Radius

| Token | Value | Use |
|-------|-------|-----|
| `radius-sm` | 4px | Chips |
| `radius-md` | 8px | Buttons, inputs |
| `radius-lg` | 10px | Cards, panels |
| `radius-xl` | 12px | Rare large media mask |
| `full` | pill | Status only |

**Intentional change from v1:** smaller radii → less “bubbly SaaS.”

## B4. Elevation

- Resting UI: **border only**  
- Hover card: ink/`line` emphasis, optional `shadow-sm`  
- Overlay (menu/modal): `shadow-md` max  
- No colored shadows, no glass  

## B5. Spacing scale

`4 · 8 · 12 · 16 · 24 · 32 · 48 · 64 · 80 · 96 · 120`  
(Extra large steps for sanctuary section padding.)

## B6. Components (same inventory, new skin)

Retain architecture: Button, FormField, ContentCard, ListTile, Alert, EmptyState, SectionHeader, PageHeader, SiteHeader/Footer, Logo, HomeHero, CtaBand, StatusChip, Container, Icon.

**Visual rewrite required** — do not keep mint/teal utility look.

## B7. Navigation

- Vietnamese labels; omit unfinished Sermons/Gallery from primary nav  
- Wordmark Fraunces ink  
- Active = weight + quiet underline in ink  
- One primary CTA in ink  

## B8. Accessibility (unchanged bar)

Contrast AA, focus rings in ink, skip link, labels, `aria-current`, reduced motion — non-negotiable.

## B9. Do / Don’t (v2)

### DO
- Lead with church name and photography  
- Use ink for actions; brass only as whisper  
- Prefer editorial sections over card grids for story  
- Keep Vietnamese chrome  

### DON’T
- Teal/mint product skins  
- Purple gradients, glassmorphism stacks  
- Equal “feature” card trios for theology content  
- Terracotta + cream + fashion-serif cliché cluster  
- Emoji as brand  
- Multiple competing CTAs of equal weight  

---

# Part C — Relationship to existing docs

| Document | Action when approved |
|----------|----------------------|
| `.agents/ui/design-system.md` | Replace with v2 tokens/type above |
| `.agents/UI_RULES.md` / `docs/UI_RULES.md` | Rewrite rules to ink/Fraunces/Open Door Light |
| `.agents/ui/component-architecture.md` | Keep structure; update visual notes |
| Current Blade/CSS implementation | Full visual restyle pass — **after** your approval |

---

# Part D — Success criteria

The redesign succeeds when:

1. Removing the nav, a stranger still recognizes a **church named Ân Điển**, not a SaaS.  
2. First viewport feels like an **open door**, not a pricing hero.  
3. Vietnamese visitors feel **welcomed**, not processed.  
4. The site looks **calm in a screenshot** — no trend tricks required.  
5. Routes, CMS fields, and forms behave exactly as today.

---

**No code was modified in this step.**  

Next step when you approve: rewrite `UI_RULES` + design-system tokens to v2, then restyle layout/homepage/components to **Open Door Light** without touching business logic.
