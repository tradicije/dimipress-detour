# DimiPress Detour

[DimiPress Detour](https://dimitrium.org/en/dimipress/detour) temporarily redirects public visitors to a WordPress page you choose while your site is being updated.

Create and design the destination page with the WordPress editor and your existing theme. Detour does not generate a maintenance page, add a design, or require a particular theme.

## The idea

DimiPress Detour follows a simple principle: a plugin should do one thing and do it well. Its one job is to send public visitors to the page you selected while you work on the rest of the site.

There is no Pro edition, paid feature gate, required theme, bundled page builder, or extra maintenance-page system to install. Use the WordPress site and theme you already have. The plugin is intentionally small and designed to work across WordPress sites regardless of which theme they use.

## What it does

- Redirects public front-end `GET` and `HEAD` requests to a published page selected in the settings.
- Uses a temporary HTTP 302 redirect, suitable for a temporary work period.
- Lets you optionally allow the selected page and its descendant pages to remain accessible.
- Always gives administrators full access to the site.
- Lets you select additional WordPress roles that should have full site access during the detour.
- Leaves WordPress admin, REST API, AJAX, cron, preview, and non-`GET`/`HEAD` requests alone.
- Can be disabled by clearing the selected destination page.

## What it does not do

- It does not create, write, or design a coming soon or maintenance page.
- It does not require a specific theme, a special theme, a page builder, or a Pro add-on.
- It does not replace your theme or change the design of your selected page.

## Requirements

- WordPress 6.2 or later
- PHP 7.4 or later

## Installation

### Install from a ZIP file

1. Download or create a ZIP archive containing the `dimipress-detour` plugin folder.
2. In WordPress admin, go to **Plugins → Add New Plugin → Upload Plugin**.
3. Choose the ZIP file and select **Install Now**.
4. Select **Activate Plugin** after installation completes.

### Install manually

1. Copy the `dimipress-detour` folder into your site's `/wp-content/plugins/` directory.
2. In WordPress admin, open **Plugins → Installed Plugins**.
3. Find **DimiPress Detour** and select **Activate**.

## Setup and use

1. Create and publish the page you want visitors to see during site work. You can use the normal WordPress block editor and your current theme to build it.
2. In WordPress admin, open **Settings → DimiPress Detour**.
3. Select the published page under **Destination page** and save the settings.
4. If visitors should also be able to open nested child pages below that page, enable **Allow destination subpages**.
5. Administrators already have full site access. Under **Roles with full site access**, select any other roles whose users should be able to browse the entire site while the detour is active.
6. To end the detour, return to the settings and choose **Disabled — do not redirect**, then save.

The redirect is temporary (HTTP 302). If your site uses a page cache, proxy, or CDN, clear its cache after enabling or disabling the detour so it does not continue serving an older redirect response.

## How the redirect works

When WordPress handles a public front-end page request, Detour checks whether a published destination page is configured. If it is, Detour sends visitors to that page unless the request is exempt:

- Administrators always bypass the redirect.
- Users whose WordPress role is selected in **Roles with full site access** bypass it.
- The destination page is accessible. If **Allow destination subpages** is enabled, its child pages at any depth are accessible too.
- WordPress administration, REST API, AJAX, cron, and preview requests are not redirected.
- Requests using methods other than `GET` or `HEAD` are not redirected.

This is a request-level redirect and does not depend on theme templates or styling. The selected page itself is rendered by your active theme, like any other WordPress page.

## Frequently asked questions

### Does Detour create a maintenance or coming soon page?

No. You create or select a page that already exists. This keeps the page content and appearance under your control and lets you use any WordPress editor or theme you prefer.

### Do I need a special theme or a compatible theme?

No special theme is needed. Detour works independently of theme design and redirects through WordPress before the active theme renders the requested front-end page. Your active theme renders the destination page normally.

### Is there a Pro version or a paid feature limit?

No. The plugin is intended to stay small and provide its functionality without a Pro edition, paid feature gates, or required add-ons.

### Who can see the full site while the detour is active?

Administrators always can. You can also select additional WordPress roles in the plugin settings. Users with one of those roles must be signed in for the exemption to apply.

### What does “Allow destination subpages” mean?

It allows the selected destination page and all of its descendant pages to load normally. Other public front-end pages still redirect to the selected destination.

### Can I use a page in a language other than English?

Yes. Select any published WordPress page available on your site. The plugin does not require a particular language or translation plugin.

### Will it redirect REST API, AJAX, previews, or form submissions?

No. REST API, AJAX, cron, preview requests, and requests other than `GET` and `HEAD` are excluded to avoid disrupting those WordPress functions.

### Why do I still see a redirect after I turned Detour off?

Your browser, host, caching plugin, reverse proxy, or CDN may have cached the temporary redirect. Clear the relevant caches and try again in a private browser window.

### How do I turn it off?

Choose **Disabled — do not redirect** under **Settings → DimiPress Detour** and save.

## Development and contribution

See [CONTRIBUTING.md](CONTRIBUTING.md) for contribution guidance and [CHANGELOG.md](CHANGELOG.md) for release history. Please report security issues privately according to [SECURITY.md](SECURITY.md).

## Author

[Aleksa Dimitrijević](https://dimitrium.org/en/dimipedia/aleksa-dimitrijevic) · [Plugin page](https://dimitrium.org/en/dimipress/detour)

## License

Copyright (C) 2026 Aleksa Dimitrijević. DimiPress Detour is free software licensed under the GNU Affero General Public License, version 3 or (at your option) any later version. See [LICENSE](LICENSE) for the complete license text.
