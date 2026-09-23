# Site-wide Page UI Architecture

**Foundation:** Homepage composition ([`HOME_PAGE_IA.md`](HOME_PAGE_IA.md)) + Design System ([`DESIGN_SYSTEM.md`](DESIGN_SYSTEM.md)) · Open Door Light  
**Status:** Architecture only — **do not implement yet**  
**Rule:** No unique visual style per page. Same shell, tokens, type, spacing, and components everywhere.

---

## 0. Global visual foundation (every public page)

### Shared layout shell
```
layouts.public
├── SiteHeader          (Logo, Nav, Primary CTA “Kết nối ngay”)
├── [optional Alert flash]
├── <main id="main-content">
│     └── page sections…
└── SiteFooter          (name, address, contact, social, copyright)
```

### Shared design tokens
From `DESIGN_SYSTEM.md`: Primary / Primary dark / light · Secondary · Accent · Background · Surface · Surface alt · Text · Muted · Border · Success / Warning / Error · Inverse · radii · spacing scale · Fraunces + Be Vietnam Pro.

### Shared interaction patterns
- Primary / Secondary / Ghost / Text buttons (same states)
- Content Card hover = border → Primary (lists only)
- Form controls = `.ui-control` / `FormField` focus ring Primary
- Focus-visible rings everywhere
- Vietnamese chrome; Sermons/Gallery **out of primary nav** until real

### Shared responsive breakpoints
Mobile `0` · Tablet `640` · Desktop `1024` · Large `1280` — gutters 16/24/32/40 · section py 64→80–96.

### Layout variants (reuse, don’t invent)
| Variant | Use |
|---------|-----|
| **A. Story home** | Full-bleed hero + editorial bands + limited card chapters |
| **B. Reading page** | PageHeader + prose in Reading width · uncarded |
| **C. Collection list** | PageHeader + Content Card grid (+ EmptyState / Pagination) |
| **D. Detail page** | PageHeader (with back) + meta panel + body + optional form panel |
| **E. Form page** | PageHeader + Narrow/split form Surface panel |
| **F. Placeholder** | PageHeader + calm empty message + Text/Secondary home link |

---

## 1. Public pages (visitor site)

---

### 1.1 Home `/` · `home`

| | |
|--|--|
| **Purpose** | Welcome first-time and returning visitors; tell the church’s story and guide next steps. |
| **Primary user** | First-time visitor / seeker |
| **Primary CTA** | `im-new` — “Tôi là người mới” / “Kết nối ngay” |
| **Layout variant** | **A. Story home** |

```
Page: Home
→ Layout: layouts.public (Story)
→ Sections:
   1. Hero
   2. Church introduction
   3. Visit / Find us
   4. Upcoming events
   5. Ministries
   6. Call to action
→ Components:
   HomeHero · SectionHeader · ContactInfo · ContentCard · EmptyState
   CtaBand · Button · Container · (shell Header/Footer)
→ Design tokens:
   Background · Surface · Surface alt · Accent soft (visit/CTA bands)
   Primary buttons · Text/Muted · Fraunces H1–H2 · Body
→ Responsive:
   Full-bleed hero 4:5→16:9 · stack CTAs mobile · cards 1/2/3 · visit 1→2 col
```

*(Full section detail: `HOME_PAGE_IA.md`.)*

---

### 1.2 About `/about` · `about`

| | |
|--|--|
| **Purpose** | Deepen identity: vision, mission, history, address. |
| **Primary user** | Visitor evaluating fit / learning the church’s story |
| **Primary CTA** | Secondary path: `im-new` or `contact` (footer/header still offer connect); in-page emphasis = **read** then optional Text CTA “Kết nối” |
| **Layout variant** | **B. Reading page** |

```
Page: About
→ Layout: layouts.public
→ Sections:
   1. PageHeader (title “Về {name}”, lead = founding_date if any)
   2. Vision block
   3. Mission block
   4. History block
   5. Address block
   6. Optional quiet Text CTA → im-new
→ Components:
   PageHeader · Container (reading) · Button (Text, optional) · no ContentCard
→ Design tokens:
   Background · Text · Muted · Primary for labels/links · Fraunces H1 · H2/H4 labels · Body
→ Responsive:
   Single reading column · section spacing 80–96 · blocks gap 48
```

**Do not:** Card-wrap each paragraph; invent doctrines beyond CMS fields.

---

### 1.3 I’m New `/im-new` · `im-new` (+ POST `im-new.store`)

| | |
|--|--|
| **Purpose** | Capture newcomer information so the church can follow up. |
| **Primary user** | First-time guest ready to share contact info |
| **Primary CTA** | Submit form — “Gửi thông tin” (Primary button) |
| **Layout variant** | **E. Form page** |

```
Page: I’m New
→ Layout: layouts.public
→ Sections:
   1. PageHeader (welcome title + lead copy)
   2. Newcomer form panel
   3. Flash Alert (success/info via session — shell)
→ Components:
   PageHeader · Container (narrow) · FormField · Button (Primary, block)
   Alert (layout) · form Surface + Border
→ Design tokens:
   Background · Surface form · Border · Primary CTA · Error soft for validation
   Body 17px inputs · label Small/600
→ Responsive:
   Fields stack · grid-cols-1; sm:grid-cols-2 for phone/email & gender/DOB pairs
```

**Reuse:** Same FormField / Button patterns as Contact and Event register.

---

### 1.4 Contact `/contact` · `contact` (+ POST `contact.store`)

| | |
|--|--|
| **Purpose** | Let anyone send a message; surface address/phone/email. |
| **Primary user** | Visitor with a question |
| **Primary CTA** | Submit — “Gửi tin nhắn” |
| **Layout variant** | **E. Form page** (split) |

```
Page: Contact
→ Layout: layouts.public
→ Sections:
   1. PageHeader (title + lead)
   2. ContactInfo stack
   3. Contact form panel
→ Components:
   PageHeader · ContactInfo · FormField · Button · Container (content)
   two-column from lg
→ Design tokens:
   Same as I’m New · Primary links on tel/mailto
→ Responsive:
   1 col mobile · 2 col lg (info | form) · form fields single column
```

---

### 1.5 Events index `/events` · `events.index`

| | |
|--|--|
| **Purpose** | Browse open/closed public events. |
| **Primary user** | Member or guest looking for what’s on |
| **Primary CTA** | Open an event card → `events.show`; secondary “Kết nối” remains in header |
| **Layout variant** | **C. Collection list** |

```
Page: Events index
→ Layout: layouts.public
→ Sections:
   1. PageHeader (“Sự kiện”)
   2. Event grid OR EmptyState
   3. Pagination (if any)
→ Components:
   PageHeader · ContentCard · StatusChip · EmptyState · Container · Pagination links
→ Design tokens:
   Background · Surface cards · Border · Primary meta · Success/neutral chips
→ Responsive:
   Grid 1 / 2 / 3 · gap 32 · PageHeader full content width
```

**Same card skin as Home events chapter** — not a new “events theme.”

---

### 1.6 Event detail `/events/{event}` · `events.show` (+ POST register)

| | |
|--|--|
| **Purpose** | Show event details; allow registration when open and not full. |
| **Primary user** | Attendee / registrant |
| **Primary CTA** | “Đăng ký ngay” when open; else no form — Alert only |
| **Layout variant** | **D. Detail page** |

```
Page: Event detail
→ Layout: layouts.public
→ Sections:
   1. PageHeader (event name + back → events.index)
   2. Meta panel (time, location, capacity, status chip)
   3. Description body
   4a. Registration form panel  OR
   4b. Alert warning (full) / Alert info (closed)
→ Components:
   PageHeader · StatusChip · FormField · Button · Alert · Container (reading)
→ Design tokens:
   Surface alt meta panel · Surface form · Primary submit · semantic Alert pairs
→ Responsive:
   Meta 1→2 col from sm · form fields 1→2 col · reading width
```

---

### 1.7 Ministries index `/ministries` · `ministries.index`

| | |
|--|--|
| **Purpose** | Browse ministries / serving teams. |
| **Primary user** | Visitor exploring belonging/service |
| **Primary CTA** | Open ministry card → `ministries.show` |
| **Layout variant** | **C. Collection list** |

```
Page: Ministries index
→ Layout: layouts.public
→ Sections:
   1. PageHeader (“Các ban ngành”)
   2. Ministry grid OR EmptyState
→ Components:
   PageHeader · ContentCard · EmptyState · Container
→ Design tokens:
   Identical card system to Events · optional page Background (not required Surface alt full page — band reserved for home chapter; list pages stay Background for calm consistency)
→ Responsive:
   Grid 1 / 2 / 3 · gap 32
```

---

### 1.8 Ministry detail `/ministries/{ministry}` · `ministries.show`

| | |
|--|--|
| **Purpose** | Describe a ministry; list public members (name + role only). |
| **Primary user** | Visitor considering involvement |
| **Primary CTA** | Soft: Text → `contact` or header “Kết nối”; no join-form in product today |
| **Layout variant** | **D. Detail page** |

```
Page: Ministry detail
→ Layout: layouts.public
→ Sections:
   1. PageHeader (name, lead = description, back → ministries.index)
   2. Members heading
   3. ListTile grid OR EmptyState
→ Components:
   PageHeader · ListTile · EmptyState · Container (reading)
→ Design tokens:
   Background · Surface tiles · Border · Text/Muted
→ Responsive:
   Members 1→2 col · no PII beyond name/role
```

---

### 1.9 Coming soon `/sermons` · `/gallery` · `comingSoon`

| | |
|--|--|
| **Purpose** | Honest placeholder for Phase 2 routes still in the router. |
| **Primary user** | Anyone hitting an unfinished URL (should be rare if nav omits them) |
| **Primary CTA** | Secondary/Text — “Về trang chủ” → `home` |
| **Layout variant** | **F. Placeholder** |

```
Page: Coming soon
→ Layout: layouts.public
→ Sections:
   1. PageHeader (title from controller: Sermons/Media or Gallery)
   2. Short body: under construction copy
   3. Button home
→ Components:
   PageHeader · Button · Container (reading) · no emoji
→ Design tokens:
   Background · Muted lead · Secondary button
→ Responsive:
   Centered calm stack
```

**Do not:** Build sermon/gallery visual systems until CMS exists. Keep out of primary nav.

---

### 1.10 Laravel `welcome` (default)

| | |
|--|--|
| **Purpose** | Framework default landing — **not** part of the church public product. |
| **Architecture** | Out of scope for Open Door Light. Do not restyle into the church system unless product decides to remove/redirect it. |

---

## 2. Staff surfaces (brand alignment only)

Public homepage is the **visual foundation for the church brand**. Filament stays Filament layout, but must **not** introduce a second brand color story.

| Surface | Path | Primary user | UI architecture note |
|---------|------|--------------|----------------------|
| Admin panel | `/admin` | Staff (admin/approver) | Filament shell · theme `primary` = Design System Primary `#1A2744` · resources: People, Events, Ministries, Finance, Notifications, Contact messages, Church Info |
| Community panel | `/community` | Active users | Same Primary token · brand name related to church · Dashboard until Community resources exist |
| Manage Church Info | Admin page | Admin | Filament form · feeds public `ChurchInfo` content |

```
Staff page (generic)
→ Layout: Filament panel
→ Sections: Filament page header + form/table
→ Components: Filament (not public ContentCard)
→ Design tokens: Primary mapped to church ink; semantic success/warning/danger aligned where possible
→ Responsive: Filament defaults
```

**Do not** rebuild admin with public Blade cards. Shared identity = color + naming, not duplicate components.

---

## 3. Cross-page consistency matrix

| Element | Home | About | Forms | Lists | Details | Coming soon |
|---------|------|-------|-------|-------|---------|-------------|
| SiteHeader / Footer | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| PageHeader | — (Hero) | ✓ | ✓ | ✓ | ✓ | ✓ |
| HomeHero / CtaBand | ✓ | — | — | — | — | — |
| ContentCard | ✓ chapters | — | — | ✓ | — | — |
| ListTile | — | — | — | — | Ministry | — |
| FormField | — | — | ✓ | — | Event reg | — |
| EmptyState | ✓ | — | — | ✓ | ✓ | — |
| Alert | flash | flash | flash | flash | + inline | flash |
| Fraunces H1/H2 | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| Card grid only for collections | ✓ limited | no | no | yes | no | no |

---

## 4. Primary CTA map (site-wide)

| Page | Primary CTA |
|------|-------------|
| Home | I’m New |
| About | Read (+ soft I’m New) |
| I’m New | Submit newcomer form |
| Contact | Submit message |
| Events index | Open event |
| Event show | Register (when allowed) |
| Ministries index | Open ministry |
| Ministry show | Connect via header/contact (no join form) |
| Coming soon | Back home |
| Header (global) | Kết nối ngay → I’m New |
| Footer | Implicit contact/social |

---

## 5. Page → architecture cheat sheet

```
Home        → A Story     → Hero, Intro, Visit, Events, Ministries, CTA
About       → B Reading   → PageHeader, vision/mission/history/address
I’m New     → E Form      → PageHeader, FormField×N, Button
Contact     → E Form split→ PageHeader, ContactInfo, FormField×N, Button
Events      → C List      → PageHeader, ContentCard grid, Pagination
Event show  → D Detail    → PageHeader, meta, body, form|Alert
Ministries  → C List      → PageHeader, ContentCard grid
Ministry    → D Detail    → PageHeader, ListTile grid
Sermons/Gal → F Placeholder→ PageHeader, home Button
Admin/*     → Filament    → Theme Primary only
```

---

## 6. Implementation order (when authorized later)

1. Apply Design System v2 tokens + Fraunces globally (replace teal/utility skin).  
2. Restyle shared shell (Header/Footer) once.  
3. Restyle Home to full IA story.  
4. Align About / Lists / Details / Forms to the same tokens/components (no new page themes).  
5. Theme Filament Primary to ink.  
6. Leave Coming soon minimal until Phase 2 content exists.

---

## 7. Non-goals

- Unique illustration systems per section  
- Different button radii/colors per page  
- Enabling Sermons/Gallery in nav without content  
- Inventing service times or gallery modules  
- Changing routes, CMS schema, or business logic  

---

*Every page must feel like one church website. Homepage defines the voice; other pages speak the same language more quietly.*
