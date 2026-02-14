# WordPress Content Download Instructions (Imaging Services USA)

This runbook is for a **new AI agent** to fully sync content from the live WordPress site into this Laravel + Inertia/Vue clone.

Target site: `https://imagingservicesusa.com/`  
Repository root: `/home/sawyer/github/imaging-services-website`

---

## 1. Goal

Download and validate all current WordPress content, then update this app so:

- Blog posts match the live WordPress post content.
- Equipment detail pages match the live WordPress content.
- Marketing/static pages and metadata match current live site behavior.
- Laravel routes/content arrays stay in sync.

---

## 2. Where Content Lives In This App

Primary content source:

- `config/site_content.php`

Rendering/mapping:

- `app/Http/Controllers/SitePageController.php`
- `routes/web.php`
- `app/Http/Middleware/HandleInertiaRequests.php`

Vue pages with copy/labels that may also require edits:

- `resources/js/Pages/Home.vue`
- `resources/js/Pages/About.vue`
- `resources/js/Pages/Equipment.vue`
- `resources/js/Pages/EquipmentDetail.vue`
- `resources/js/Pages/Services.vue`
- `resources/js/Pages/Accessories.vue`
- `resources/js/Pages/Contact.vue`
- `resources/js/Pages/Payments.vue`
- `resources/js/Pages/Privacy.vue`
- `resources/js/Pages/Media.vue`
- `resources/js/Pages/BlogPost.vue`
- `resources/js/Pages/MarketingPage.vue`

---

## 3. Crawl and Download Live WordPress Data

Create a workspace:

```bash
mkdir -p /tmp/imaging_live
```

Download sitemap index + child sitemaps:

```bash
curl -fLs https://imagingservicesusa.com/sitemap_index.xml -o /tmp/imaging_live/sitemap_index.xml

for url in $(rg -o '<loc><!\[CDATA\[[^]]+\]\]></loc>' /tmp/imaging_live/sitemap_index.xml | sed -E 's#<loc><!\[CDATA\[##; s#\]\]></loc>##'); do
  name=$(basename "$url")
  curl -fLs "$url" -o "/tmp/imaging_live/$name"
done

{
  for f in /tmp/imaging_live/*-sitemap.xml; do
    rg -o '<loc><!\[CDATA\[[^]]+\]\]></loc>' "$f" | sed -E 's#<loc><!\[CDATA\[##; s#\]\]></loc>##'
  done
} | sort -u > /tmp/imaging_live/all_urls.txt
```

Expected URL count during previous run: `47`.

---

## 4. Use WordPress REST API (Preferred Source)

### 4.1 Posts (works via bulk endpoint)

```bash
curl -fLs 'https://imagingservicesusa.com/wp-json/wp/v2/posts?per_page=100&_fields=id,slug,link,title,excerpt,content,date,modified,categories,tags' -o /tmp/imaging_live/wp_posts_full.json
```

Expected current count during previous run: `10` posts.

### 4.2 Pages (bulk endpoint may return 500; fetch by slug)

Known page slugs from current sitemap:

- `about-us`
- `accessories`
- `careers`
- `contact-us`
- `equipment`
- `maintenance-page`
- `media`
- `october-2024-message`
- `payments`
- `privacy-policy-terms-of-use`
- `promo-eq-summer-24`
- `refund_returns`
- `services`
- `shop`
- `compare`
- `wishlist`
- `used-equipment`
- `chiropractic-x-ray`
- `podiatry-x-ray`
- `veterinary-x-ray`
- `mobile-x-ray`
- `extentrac-elite-m3d-device`
- `smart-c-portable-mini-c-arm`
- `planmeca-viso-for-chiropractic`
- `planmed-verity-orthopedic-imaging`
- `orthopedic-urgent-care`

Fetch per slug:

```bash
for slug in \
  about-us accessories careers contact-us equipment maintenance-page media october-2024-message \
  payments privacy-policy-terms-of-use promo-eq-summer-24 refund_returns services shop compare wishlist \
  used-equipment chiropractic-x-ray podiatry-x-ray veterinary-x-ray mobile-x-ray \
  extentrac-elite-m3d-device smart-c-portable-mini-c-arm planmeca-viso-for-chiropractic \
  planmed-verity-orthopedic-imaging orthopedic-urgent-care
do
  curl -Ls "https://imagingservicesusa.com/wp-json/wp/v2/pages?slug=$slug&_fields=id,slug,link,title,excerpt,content,date,modified" \
    -o "/tmp/imaging_live/page_$slug.json"
done
```

Note: `wishlist` previously returned an HTML error via REST. For that page, use direct HTML (`curl -Ls https://imagingservicesusa.com/wishlist/`) for title/state.

### 4.3 Front page (homepage)

Get `page_on_front` ID from:

```bash
curl -fLs https://imagingservicesusa.com/wp-json/
```

Then fetch front page directly (previous ID was `12276`):

```bash
curl -fLs 'https://imagingservicesusa.com/wp-json/wp/v2/pages/12276?_fields=id,slug,link,title,excerpt,content,date,modified' -o /tmp/imaging_live/front_page.json
```

---

## 5. Convert Elementor HTML to Usable Text

WordPress content is mostly Elementor HTML. Use extraction scripts to capture headings + paragraphs:

```bash
python3 - <<'PY'
import json,re,html,glob
from pathlib import Path

def clean(s:str)->str:
    s=re.sub(r'<script\\b.*?</script>',' ',s,flags=re.I|re.S)
    s=re.sub(r'<style\\b.*?</style>',' ',s,flags=re.I|re.S)
    s=re.sub(r'<[^>]+>',' ',s)
    s=html.unescape(s)
    s=re.sub(r'\\s+',' ',s).strip()
    return s

summary={"pages":{},"posts":{}}

for f in sorted(glob.glob('/tmp/imaging_live/page_*.json')):
    slug=Path(f).stem.replace('page_','')
    raw=Path(f).read_text(errors='ignore').strip()
    if raw.startswith('<'):
        summary["pages"][slug]={"error":"html_error"}
        continue
    data=json.loads(raw or "[]")
    if not data:
        continue
    item=data[0]
    content=item.get('content',{}).get('rendered','')
    summary["pages"][slug]={
        "title": clean(item.get('title',{}).get('rendered','')),
        "excerpt": clean(item.get('excerpt',{}).get('rendered','')),
        "headings":[clean(h) for h in re.findall(r'<h[1-4][^>]*>(.*?)</h[1-4]>',content,flags=re.I|re.S) if clean(h)],
        "paragraphs":[clean(p) for p in re.findall(r'<p[^>]*>(.*?)</p>',content,flags=re.I|re.S) if clean(p)],
    }

posts=json.loads(Path('/tmp/imaging_live/wp_posts_full.json').read_text())
for item in posts:
    content=item.get('content',{}).get('rendered','')
    summary["posts"][item["slug"]]={
        "title": clean(item.get('title',{}).get('rendered','')),
        "date": item.get('date',''),
        "excerpt": clean(item.get('excerpt',{}).get('rendered','')),
        "headings":[clean(h) for h in re.findall(r'<h[1-4][^>]*>(.*?)</h[1-4]>',content,flags=re.I|re.S) if clean(h)],
        "paragraphs":[clean(p) for p in re.findall(r'<p[^>]*>(.*?)</p>',content,flags=re.I|re.S) if clean(p)],
    }

Path('/tmp/imaging_live/parsed_content.json').write_text(json.dumps(summary,indent=2))
print('wrote /tmp/imaging_live/parsed_content.json')
PY
```

---

## 6. Map WordPress Data Into Laravel Content Arrays

Update `config/site_content.php` keys:

- `home`
- `about`
- `equipment`
- `equipment_details`
- `services`
- `accessories`
- `contact`
- `payments`
- `privacy`
- `marketing_pages`
- `blog_posts`

Important route-coupled keys:

- `equipment_details` keys must match route slugs for `/equipment/{equipmentSlug}`.
- `blog_posts` keys must match route slugs for `/{postSlug}`.
- `marketing_pages` keys must match route slugs for `/{pageSlug}`.

If you rename slugs or titles, verify route constraints in `routes/web.php`.

---

## 7. Full Blog + Equipment Detail Completion Task

For this next pass, do **longform parity**, not short summaries:

- For each blog post in `blog_posts`, copy major section headings and substantive paragraphs from WordPress post content.
- For each equipment detail entry in `equipment_details`, include fuller descriptive bullets and key product sections from WordPress equipment page body.
- Keep text readable in current Vue layout; if needed, adjust `BlogPost.vue` and `EquipmentDetail.vue` to support longer content blocks cleanly.

Current post slugs to cover:

- `the-economics-of-digital-x-ray-is-it-actually-saving-you-money`
- `reducing-radiation-exposure-how-modern-digital-x-ray-systems-are-making-imaging-safer`
- `the-future-of-digital-x-ray-5-game-changing-innovations-to-watch`
- `beyond-the-basics-how-to-maximize-the-roi-of-your-digital-x-ray-equipment`
- `why-your-x-ray-processor-is-holding-you-back-5-signs-its-time-for-a-change`
- `the-hidden-costs-of-outdated-x-ray-processors-is-it-time-to-upgrade`
- `celebrating-45-years-of-services-in-digiting-imaging`
- `the-chiropractic-compass-podcast-interview-19`
- `chiropractic-rocks-2019-interview-with-jim-chester`
- `are-you-an-active-participant-in-your-growth`

Current equipment detail slugs to cover:

- `chiropractic-x-ray`
- `podiatry-x-ray`
- `veterinary-x-ray`
- `mobile-x-ray`
- `extentrac-elite-m3d-device`
- `smart-c-portable-mini-c-arm`
- `planmeca-viso-for-chiropractic`
- `planmed-verity-orthopedic-imaging`
- `orthopedic-urgent-care`

---

## 8. Assets/Images

If live team/media images are needed, download to `public/site-assets/images/...` and reference local paths in config.

Previously added team assets:

- `public/site-assets/images/team/kathryn-tokash.png`
- `public/site-assets/images/team/jordan-desjardins.jpg`
- `public/site-assets/images/team/stephen-sawyer.jpg`

---

## 9. Validation Checklist

Run before finalizing:

```bash
vendor/bin/pint --dirty --format agent
php artisan test --compact
npm run build
```

Then verify key routes manually:

- `/`
- `/equipment` and all `/equipment/{slug}` pages
- `/media` and all post routes
- `/about-us`, `/services`, `/accessories`, `/contact-us`, `/payments`, `/privacy-policy-terms-of-use`
- marketing pages: `/used-equipment`, `/october-2024-message`, `/promo-eq-summer-24`, `/careers`, `/refund_returns`, `/shop`, `/compare`, `/wishlist`, `/maintenance-page`

---

## 10. Known Edge Cases

- WordPress `wp/v2/pages?per_page=100` may return `500`; use per-slug fetch.
- `wishlist` page may fail via REST but still render live HTML (`200`).
- `shop/compare/wishlist` may be WooCommerce utility pages with minimal static body text.
- Elementor markup may include duplicated/noisy content; use heading + paragraph extraction and then curate.

---

## 11. Handoff Note

This repo already has a first-pass sync completed.  
Your follow-up task is to finish **full longform parity** for blog and equipment detail pages and re-verify all routes/content.
