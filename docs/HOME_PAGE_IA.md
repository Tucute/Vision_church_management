# Homepage Visual Composition & Information Architecture

**Church:** Hội Thánh Tin Lành Ân Điển / Grace Evangelical Church  
**Direction:** Open Door Light ([`docs/DESIGN_SYSTEM.md`](DESIGN_SYSTEM.md))  
**Status:** Design only — **do not implement yet**  
**Constraint:** Only content fields and data already in the product  

---

## 0. Existing content inventory (source of truth)

### From `ChurchInfo` (CMS)
| Field | Available on home? |
|-------|------------------|
| `name` | Yes |
| `mission` | Yes |
| `vision` | Yes |
| `history` | Yes (full text lives on About; home may use a short teaser + link) |
| `founding_date` | Yes |
| `address` | Yes |
| `contact_info` (phone, email) | Yes |
| `social_links` | Yes (footer) |

### From Home controller queries
| Data | Rule |
|------|------|
| Upcoming events | Up to 3 · `status = open` · `start_date >= now` · name, start_date, location |
| Ministries | Up to 6 · name, description, active memberships count |

### Existing routes used for next steps
`im-new` · `events.index` / `events.show` · `ministries.index` / `ministries.show` · `about` · `contact` · `home`

### Explicitly **not** in the data model today
| Visitor need | Gap |
|--------------|-----|
| Weekly worship **times** / service schedule | No field — **do not invent** |
| Sermons / media library | Phase 2 placeholder only — **omit from home** |
| Photo gallery / “church life” media CMS | Empty image dirs; no gallery domain — **omit dedicated section** |
| Statement of faith / distinct beliefs page | Only vision + mission (+ history) |

---

## 1. Emotional journey (first-time visitor)

| Beat | Feeling | Question answered | Home section |
|------|---------|-------------------|--------------|
| 1. Arrival | Welcome, calm | What is this place? | Header → Hero |
| 2. Recognition | “This is a church with a heart” | Who / what do they stand for? | Church introduction |
| 3. Orientation | “I could find them” | Where (and what we know about gathering)? | Visit / find us *(address + contact only)* |
| 4. Momentum | “Something is happening” | What’s on? | Upcoming events |
| 5. Belonging | “There are people & teams” | Who serves / how life is organized? | Ministries |
| 6. Invitation | “I’m invited” | How do I connect? What’s next? | Call to action → Footer |

**Story arc (one continuous composition):**  
*Open door (hero) → Word & heart (intro) → Threshold address (visit) → Life on the calendar (events) → People serving (ministries) → Step inside (CTA) → Quiet close (footer).*

Not a stack of equal marketing cards — a **paced walk from door to welcome table.**

---

## 2. Section inclusion decision

| Proposed section | Include? | Reason |
|------------------|----------|--------|
| Header | **Yes** | Site chrome; existing nav + CTA |
| Hero | **Yes** | Name + mission + CTAs; brand-first |
| Church introduction | **Yes** | Vision, mission, founding/history teaser → About |
| Service information | **Partial → “Visit / Find us”** | Address + phone/email exist; **no service times** — do not invent schedule |
| Upcoming events | **Yes** | Controller already loads events |
| Ministries | **Yes** | Controller already loads ministries |
| Sermons / teachings | **No** | No real content; Phase 2 only |
| Community / church life | **No** | No gallery/CMS media; avoid fake photo collage |
| Call to action | **Yes** | Existing I’m New path + copy pattern |
| Footer | **Yes** | Name, address, contact, social |

---

## 3. Homepage information architecture (ordered)

```
Header
Hero
Church introduction          ← vision / mission / who we are
Visit / Find us              ← address + contact (not invented times)
Upcoming events
Ministries
Call to action               ← I’m New
Footer
```

---

## 4. Section specifications

### 4.1 Header

| | |
|--|--|
| **Purpose** | Orient and offer persistent paths without competing with the hero brand. |
| **Content hierarchy** | 1) Logo/wordmark = `ChurchInfo.name` · 2) Nav (VI): Trang chủ, Giới thiệu, Người mới, Sự kiện, Ban ngành, Liên hệ · 3) One Primary CTA → `im-new` (“Kết nối ngay”). Omit Sermons/Gallery. |
| **Layout** | Sticky bar · Content max width · Logo left · Nav center/right · CTA far right. |
| **Typography** | Wordmark: Fraunces ~18–20px / 700 · Nav: Navigation style · CTA: Button. |
| **Components** | `SiteHeader`, `Logo`, `NavLink`, `Button` (Primary), `Icon` (menu). |
| **Image usage** | Optional logo SVG later; text wordmark until then. No hero image in header. |
| **Spacing** | Height 64px · gutters per Design System · nav gap 24px. |
| **Responsive** | `<lg`: hamburger + panel including CTA · `≥lg`: full nav. |

---

### 4.2 Hero

| | |
|--|--|
| **Purpose** | Answer “What is this church?” in one breath: name + gospel welcome + next step. |
| **Content hierarchy** | 1) **Church name** (hero-level brand) · 2) Short welcome line built from name (existing pattern: “Chào mừng đến với {name}”) · 3) **Mission** text (`mission`, with existing fallback sentence if empty) · 4) CTA group: Primary → `im-new` (“Tôi là người mới”) · Secondary → `events.index` (“Xem sự kiện”). |
| **Layout** | **Full-bleed** visual plane · text block lower/left or centered over soft ink scrim · **no cards, stats, or badges** · one composition for the first viewport. |
| **Typography** | Name: Display or H1 Fraunces · Welcome: H1 or large Fraunces · Mission: Body / Large body Muted · Buttons: Button style. |
| **Components** | `HomeHero`, `Button` ×2, `Container` (text measure), optional `Icon` on primary. |
| **Image usage** | Full-bleed photography (open door / gathering) when assets exist · 16:9 desktop / 4:5 mobile · ink scrim for legibility only · if no photo yet: warm Background + Primary light wash — still brand-first, not a card stack. |
| **Spacing** | Hero vertical 96–120px desktop (or min-height ~85–100vh with image) · CTA gap 12–16px · text max ~42rem. |
| **Responsive** | Stack CTAs on mobile · larger type on desktop · keep single column story. |

**Visitor outcome:** Knows the church’s name and heart (mission), and the two natural next steps.

---

### 4.3 Church introduction

| | |
|--|--|
| **Purpose** | Answer “Who is this?” and “What do they value?” using vision + mission (+ optional founding/history bridge). |
| **Content hierarchy** | 1) Section H2 (e.g. “Chúng tôi là ai”) — **label only**, not CMS · 2) **Vision** — label + `vision` · 3) **Mission** — label + `mission` (may restate hero with more room) · 4) Optional meta: founding_date if present · 5) Optional 1–2 sentence **history** excerpt + Text button → `about` (“Đọc thêm”). Do not invent doctrine statements. |
| **Layout** | **Editorial, uncarded** · Reading or Content width · Prefer **asymmetric**: text column + quiet secondary image column on desktop (image optional; omit column if no asset) · On mobile: stacked text only. Alternating Background (not a card grid). |
| **Typography** | H2 Fraunces · Field labels Small/Caption or H4 · Body for vision/mission · Text link for About. |
| **Components** | `SectionHeader` or simple H2 · `Container` · `Button` variant Text · no ContentCard. |
| **Image usage** | Optional single editorial 4:3 (community/teaching) — not a collage · radius 10px if inset · not full-bleed. |
| **Spacing** | Section py 80–96 · between vision/mission blocks 32–48 · generous measure. |
| **Responsive** | 1 col mobile · 2 col text+image from `lg` if image exists · otherwise single reading column. |

**Visitor outcome:** Feels the church’s values (vision/mission) and can go deeper on About.

---

### 4.4 Visit / Find us  
*(Supported stand-in for “Service information” — without inventing times)*

| | |
|--|--|
| **Purpose** | Answer “Where can I find this church?” with honest available data. Softly supports gathering orientation without a fake weekly schedule. |
| **Content hierarchy** | 1) H2 (e.g. “Ghé thăm chúng tôi”) · 2) **Address** (`address`) · 3) Phone / email from `contact_info` as links · 4) Text/Secondary CTA → `contact` (“Liên hệ”). **Do not** show invented Sunday times or map embeds unless product later adds them. |
| **Layout** | Quiet band — Surface alt or Accent soft · Content width · Single information block or split: copy left / contact stack right · **not** three icon-feature cards. |
| **Typography** | H2 · Body for address · Small labels · links Primary. |
| **Components** | `Container`, `ContactInfo`, `Button` (Text or Secondary). |
| **Image usage** | Optional none; or a single restrained exterior/door photo later — never required for ship. |
| **Spacing** | Section py 64–80 · internal stack 16–24. |
| **Responsive** | Stack on mobile · 2-col from `md`/`lg`. |

**Visitor outcome:** Knows physical place and how to reach someone — without false schedule certainty.

---

### 4.5 Upcoming events

| | |
|--|--|
| **Purpose** | Answer “What is happening?” with live calendar energy. |
| **Content hierarchy** | 1) H2 “Sự kiện sắp tới” · 2) Text action “Xem tất cả” → `events.index` · 3) Up to 3 events: date · name · location · link to `events.show` · 4) If empty: EmptyState (existing honest copy) + link Contact or home — **do not hide the section.** |
| **Layout** | Content width · SectionHeader row · **only place for Content Cards** in the story rhythm (interactive list) · 1/2/3 columns · cards secondary to the narrative, not the whole page identity. |
| **Typography** | H2 · Card meta Small Primary · title H4 · location Small Muted. |
| **Components** | `SectionHeader`, `ContentCard`, `EmptyState`, `Container`. |
| **Image usage** | None required (events have no image field today). |
| **Spacing** | Section py 80–96 · grid gap 32 · card padding 24. |
| **Responsive** | 1 → 2 (`sm`) → 3 (`lg`) cols. |

**Visitor outcome:** Sees real upcoming life; can open an event or the full list.

---

### 4.6 Ministries

| | |
|--|--|
| **Purpose** | Answer “Who is this church?” through serving communities — people organized to care and disciple. |
| **Content hierarchy** | 1) H2 “Các ban ngành” · 2) “Xem tất cả” → `ministries.index` · 3) Up to 6: name · description · member count footer · link `ministries.show` · 4) EmptyState if none. |
| **Layout** | **Surface alt** band (olive-stone) to shift chapter of the story · same Content Card pattern · avoid a second unrelated card skin. |
| **Typography** | Same as events cards · H2 Fraunces. |
| **Components** | `SectionHeader`, `ContentCard`, `EmptyState`, `Container`. |
| **Image usage** | None (no ministry image field). |
| **Spacing** | Band py 80–96 · gap 32. |
| **Responsive** | Same grid as events. |

**Visitor outcome:** Sees pathways of belonging/service; can explore a ministry.

---

### 4.7 Call to action

| | |
|--|--|
| **Purpose** | Answer “How do I get connected?” and “What should I do next?” — clear single next step. |
| **Content hierarchy** | 1) H2 — existing invite title pattern (“Lần đầu đến với chúng tôi?”) · 2) Support sentence (existing welcome copy) · 3) One Primary CTA → `im-new` (“Kết nối ngay”). Optional Secondary Text → `contact` only if it doesn’t dilute the primary invite. |
| **Layout** | Reading-centered · Accent soft or Primary light band · **uncarded** · maximum calm · one focal button. |
| **Typography** | H2 · Body Muted · Button. |
| **Components** | `CtaBand`, `Button`. |
| **Image usage** | None (type + color band carry the moment). |
| **Spacing** | py 80–96 · text max ~36–42rem · button mt 24. |
| **Responsive** | Always centered stack. |

**Visitor outcome:** One obvious next action — leave their info as a newcomer.

---

### 4.8 Footer

| | |
|--|--|
| **Purpose** | Quiet close: identity, reachability, social presence. |
| **Content hierarchy** | 1) Name · 2) Address · 3) Contact phone/email · 4) Social links · 5) Copyright line. |
| **Layout** | Inverse full-bleed · Content width · 1 → 3 columns · no card chrome. |
| **Typography** | Wordmark Fraunces On inverse · Small On inverse muted · links hover On inverse. |
| **Components** | `SiteFooter`, `Logo`, `ContactInfo`. |
| **Image usage** | None. |
| **Spacing** | py 48–64 · column gap 32 · border-t copyright py 16. |
| **Responsive** | Stack columns on mobile. |

---

## 5. Continuous visual story (composition rules)

1. **Rhythm:** Full-bleed hero → calm editorial intro → soft visit band → events (cards enter as “calendar”) → ministries on olive-stone → invite band → dark footer.  
2. **Card budget:** Cards appear **only** in Events and Ministries — so the page doesn’t feel like a dashboard.  
3. **Color chapters:** Background → Background → Surface alt or Accent soft → Background → Surface alt → Accent soft / Primary light → Inverse.  
4. **One primary action per chapter;** Hero and final CTA both point to connection without identical competing strips of equal weight in between.  
5. **Type anchors the story:** Fraunces for emotional titles; Be Vietnam Pro for data and UI.  
6. **No filler sections** for sermons or gallery until CMS supports them.

---

## 6. Mapping visitor questions → sections

| Question | Where answered | Content used |
|----------|----------------|--------------|
| 1. What is this church? | Hero | `name`, `mission` |
| 2. Who is this church? | Introduction + Ministries | `vision`, `history` teaser, ministries |
| 3. What do they believe/value? | Introduction | `vision`, `mission` |
| 4. When and where do they meet? | Visit / Find us + Events | `address`, contact; event dates/locations (**not** weekly service times) |
| 5. What events are happening? | Upcoming events | Event records |
| 6. How can I get connected? | CTA + Header CTA + Ministries/Contact | `im-new`, `contact`, ministry pages |
| 7. What should I do next? | Hero primary + final CTA | `im-new` |

**Honesty note for Q4:** Until a service-schedule field exists, the site must not imply fixed Sunday times. Address + “see upcoming events” is the truthful orientation.

---

## 7. Out of scope for this homepage (until data exists)

- Sermon highlights or media embeds  
- Photo “church life” mosaic  
- Worship time tables, livestream schedules  
- Beliefs/creeds beyond vision & mission  
- Maps (unless later product decision + API)

---

## 8. Implementation readiness (later)

When implementing, reuse Design System v2 tokens and existing Blade component roles (`HomeHero`, `SectionHeader`, `ContentCard`, `CtaBand`, etc.) with a **visual restyle** — **no new CMS fields required** for this IA. Optional improvement later: dedicated `service_times` field would unlock a true Service Information section.

---

*Design only. No code modified.*
