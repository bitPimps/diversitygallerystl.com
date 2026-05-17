# Diversity Gallery — diversitygallerystl.com

Website for [Diversity Gallery, LLC](https://www.diversitygallerystl.com/) — a natural hair salon and boutique in St. Louis, Missouri, founded in 2000 by Leslie Christian-Wilson.

## Pages

| File | Description |
|---|---|
| `index.html` | Homepage — services overview, carousel, hours, contact |
| `about.html` | Owner bio (Leslie Christian-Wilson), embedded video |
| `events.html` | Awards and press coverage |
| `shop-its-me.html` | Product page — *It's Me! Pheromone Wellness Oil* |
| `testimonials.html` | Customer testimonials and video |

## Tech Stack

- Static HTML5 — no build step, no framework
- [Bootstrap 3.3.7](https://getbootstrap.com/docs/3.3/)
- jQuery 3.3.1
- Font Awesome 4.7.0
- Google Analytics (GA4 — `G-RTXK8B48BE`)
- Hosted on GitHub Pages (`CNAME: diversitygallerystl.com`)

## Project Structure

```
diversitygallerystl.com/
├── index.html
├── about.html
├── events.html
├── shop-its-me.html
├── testimonials.html
├── CNAME
├── robots.txt
├── favicon.ico
├── apple-touch-icon.png
├── css/
│   ├── main.min.css        # Primary stylesheet (minified)
│   ├── main.css            # Primary stylesheet (source)
│   ├── carousel.css        # Homepage carousel styles
│   └── main-*.css          # Colour theme variants
├── img/
│   ├── diversity-gallery.png
│   ├── leslie-christian-wilson.jpg
│   ├── carousel/
│   ├── jumbotron/
│   └── pages/
│       ├── its-me-pheromone-oil-bottles.webp
│       ├── leslie-christian-wilson-with-its-me-oil.webp
│       ├── testimonial-frita.mp4
│       └── ...
└── docs/
    └── oil-and-incense.pdf
```

## Schema.org Structured Data

Each page includes a `<script type="application/ld+json">` block in `<head>`:

| Page | Schema types |
|---|---|
| `index.html` | `LocalBusiness`, `HairSalon`, `Store`, `WebSite` |
| `about.html` | `Person`, `VideoObject`, `BreadcrumbList` |
| `events.html` | `Event` ×4, `BreadcrumbList` |
| `shop-its-me.html` | `Product`, `Offer`, `BreadcrumbList` |
| `testimonials.html` | `Review` ×6, `VideoObject`, `BreadcrumbList` |

### Pending placeholders

Three fields in the JSON-LD require manual verification before full rich-result eligibility:

| File | Placeholder | How to resolve |
|---|---|---|
| `about.html` | `VERIFY_YOUTUBE_DATE` | Visit `youtube.com/watch?v=Zps-NnZlzoA`, note publish date, enter as `YYYY-MM-DD` |
| `shop-its-me.html` | `VERIFY_PRICE` | Check current price on the [Shopify product page](https://diversity-gallery.myshopify.com/products/its-me-all-natural-pheromone-1-3-oz-rollerball), enter as a number (e.g. `29.99`) |
| `shop-its-me.html` | `VERIFY_PRICE_VALID_UNTIL` | Set to ~1 year out (e.g. `2027-06-01`); update annually |
| `testimonials.html` | `VERIFY_THUMBNAIL_URL` | Extract a still frame from `img/pages/testimonial-frita.mp4`, upload it, and enter the absolute URL |

Extract a thumbnail with ffmpeg:
```bash
ffmpeg -i img/pages/testimonial-frita.mp4 -ss 00:00:01 -frames:v 1 img/pages/testimonial-frita-thumb.jpg
```

### Validation

After deploying, test each page at:
- [Google Rich Results Test](https://search.google.com/test/rich-results)
- [Schema Markup Validator](https://validator.schema.org/)

## Local Development

No build process. Open any `.html` file directly in a browser, or serve locally:

```bash
python3 -m http.server 8000
# then visit http://localhost:8000
```

## Deployment

Pushed to the `main` branch — GitHub Pages deploys automatically to `diversitygallerystl.com`.
