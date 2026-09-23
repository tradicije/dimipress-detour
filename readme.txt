=== DimiPress Detour ===
Contributors: aleksadimitrijevic
Tags: redirect, maintenance, site work
Requires at least: 6.2
Requires PHP: 7.4
Stable tag: 1.0.1
License: GNU Affero General Public License v3.0 or later
License URI: https://www.gnu.org/licenses/agpl-3.0.html

Temporarily redirect public visitors to a page you choose while your WordPress site is being updated.

Plugin page: https://dimitrium.org/en/dimipress/detour
Author: Aleksa Dimitrijević (https://dimitrium.org/en/dimipedia/aleksa-dimitrijevic)

== Description ==

DimiPress Detour temporarily redirects public front-end visitors to a published WordPress page you select in Settings → DimiPress Detour. It is for times when you are working on your site and want visitors to land on a page you have prepared.

The plugin does not create, write, supply, or style a coming soon or maintenance page. Create and design the destination page with the WordPress editor and your current theme, then select it in the settings.

Detour follows a simple principle: a plugin should do one thing and do it well. Its one job is to redirect public visitors to your selected page. It has no Pro edition, paid feature gates, required theme, required page builder, or extra maintenance-page system. It is designed to work with any WordPress site and any theme.

Administrators always have full site access. You can also select additional WordPress roles whose signed-in users should have full site access during the detour. The optional “Allow destination subpages” setting keeps the selected page and its descendant pages accessible.

The redirect is temporary (HTTP 302). Clear the destination selection to turn it off. The plugin leaves WordPress admin, REST API, AJAX, cron, preview, and non-GET/HEAD requests alone.

== Installation ==

1. Upload the `dimipress-detour` folder to `/wp-content/plugins/`, or upload its ZIP through Plugins → Add New Plugin → Upload Plugin.
2. Activate DimiPress Detour in Plugins → Installed Plugins.
3. Create and publish the page you want visitors to see. Design it using your normal WordPress tools and current theme.
4. Open Settings → DimiPress Detour.
5. Select your published destination page and save.
6. Optionally enable “Allow destination subpages” and select additional roles for full site access, then save your changes.

To end the detour, choose “Disabled — do not redirect” under Destination page and save. If a browser, caching plugin, proxy, or CDN has cached a redirect, clear its cache after changing the setting.

== Frequently Asked Questions ==

= Does this plugin create a maintenance or coming soon page? =

No. You create or select an existing published page and control its content and design yourself.

= Do I need a special theme or a compatible theme? =

No. Detour redirects through WordPress independently of theme design. Your active theme renders the selected destination page like any other WordPress page.

= Is there a Pro version or a paid feature limit? =

No. The plugin is designed to do one job well, without a Pro edition, paid feature gates, or required add-ons.

= Who can access the full site while the detour is active? =

Administrators always have full access. In Settings → DimiPress Detour, select any additional WordPress roles whose signed-in users should also bypass the detour.

= What does “Allow destination subpages” do? =

It allows the selected page and its child pages at any depth to load normally. Other public front-end pages continue to redirect to the selected destination.

= Does it redirect the REST API, AJAX, previews, cron, or form submissions? =

No. The redirect only handles public front-end GET and HEAD requests. WordPress admin, REST API, AJAX, cron, preview, and other HTTP methods are excluded.

= Can I use a page in another language? =

Yes. You can select any published page available on your WordPress site. Detour does not require a specific language or translation plugin.

= Why do I still see the redirect after disabling it? =

Your browser, hosting cache, caching plugin, reverse proxy, or CDN may have cached the temporary redirect. Clear the relevant caches and try again in a private browser window.

== Changelog ==

= 1.0.1 =
* Add the plugin and author profile URLs.
* Refine the plugin description and update documentation.

= 1.0.0 =
* Initial release.
* Add a settings screen to select a published destination page.
* Add an option to allow the selected page's descendants.
* Always exempt administrators and allow additional roles to be selected for full site access.
* Exempt essential WordPress endpoints from redirects.
