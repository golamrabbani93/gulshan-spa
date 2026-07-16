# Luxury Spa Gulshan — Hello Elementor Child Theme v3.0.0

Built by [Wordpressistic](https://wordpressistic.com)

---

## Template Map

All templates live in the theme root or `/templates/`. There are **no nested service sub-folders**.

### Root Templates

| File | Template Name | Assign To |
|------|--------------|-----------|
| `front-page.php` | *(auto — front page)* | Set as static front page in Reading Settings |
| `template-services.php` | Services Archive | `/services/` page |
| `template-service-detail.php` | Service Detail | Each individual service page |
| `template-about.php` | About | `/about/` page |
| `template-our-pricing.php` | Our Pricing | `/our-pricing/` page |
| `template-contact.php` | Contact | `/contacts/` page |
| `template-blog-archive.php` | Blog Archive | `/blog/` page |
| `template-hand-spa.php` | Hand Spa | `/hand-spa/` page |
| `template-privacy-policy.php` | Privacy Policy | `/privacy-policy/` page |
| `page.php` | *(default page fallback)* | Any page without a specific template |
| `single.php` | *(default single post)* | All blog posts |
| `index.php` | *(archive/search fallback)* | Archives, search results |
| `404.php` | *(404 fallback)* | Not-found pages |
| `category-massage.php` | *(massage category archive)* | `/category/massage/` |

### Service Templates (in `/templates/`)

Each of these one-liner stubs just includes `template-service-detail.php`:

- `aroma-oil-massage.php` → **Aroma Oil Massage**
- `back-and-shoulder-massage.php` → **Back and Shoulder Massage**
- `body-scrub-with-facial.php` → **Body Scrub with Facial**
- `body-to-body-massage.php` → **Body to Body Massage**
- `deep-tissue-massage.php` → **Deep Tissue Massage**
- `dry-massage.php` → **Dry Massage**
- `female-to-male-spa.php` → **Female to Male Spa**
- `four-hand-massage.php` → **Four Hand Massage**
- `full-body-massage.php` → **Full Body Massage**
- `nuru-massage.php` → **Nuru Massage**
- `sensual-massage.php` → **Sensual Massage**
- `special-massage.php` → **Special Massage**
- `thai-massage.php` → **Thai Massage**

---

## WordPress Setup Checklist

1. **Upload & Activate** — Upload the zip via Appearance → Themes → Add New → Upload. Activate.
2. **Primary Menu** — Go to Appearance → Menus. Create a menu, assign it to **Primary Menu** location.
3. **Service Pages** — Create a page with slug `/services/`, assign template **Services Archive**.
   - Under that page, create child pages for each service (e.g., `/services/aroma-oil-massage/`).
   - Assign the matching service template from `/templates/` to each child page.
   - Fill in the **Service Details** meta box (price, duration, booking link, etc.) in the page editor.
4. **Remaining Pages** — Create pages for `/about/`, `/our-pricing/`, `/contacts/`, `/blog/`, `/privacy-policy/`, `/hand-spa/` and assign the matching templates.
5. **Front Page** — Go to Settings → Reading, set **A static page**, select your homepage page. `front-page.php` activates automatically.
6. **Custom Logo** — Go to Appearance → Customize → Site Identity to upload your logo (replaces the hardcoded fallback image).

---

## Service Meta Fields

Each service page has a **Service Details** meta box in the WordPress editor:

| Field | Description |
|-------|-------------|
| `service_price` | Starting price (e.g., `6,000 tk`) |
| `service_promo_price` | Promo price — shown as badge if set |
| `service_duration` | Duration (e.g., `60 min`) |
| `service_short_benefit` | Short benefit tagline shown under heading |
| `service_category` | Category label shown as eyebrow text |
| `service_booking_cta` | Button text (default: Book Now) |
| `service_booking_link` | Booking URL or `tel:+880...` |
| `service_popular` | Checkbox — marks as Featured/Popular |

---

## Design Tokens (style.css `:root`)

```css
--lsg-bg:          #f6f1e8   /* warm cream background */
--lsg-surface:     #fffaf2   /* lighter surface */
--lsg-accent:      #b4915a   /* gold accent */
--lsg-contrast:    #2d2823   /* near-black text */
--lsg-muted:       #6f655d   /* secondary text */
```

Customise these values in `style.css` to retheme the entire site instantly.

---

## Parent Theme Requirement

Requires **Hello Elementor** (free) as the parent theme.  
Install from Appearance → Themes → Add New → search "Hello Elementor".
