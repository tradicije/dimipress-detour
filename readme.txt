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

DimiPress Detour temporarily redirects public front-end requests to a published WordPress page chosen in Settings → DimiPress Detour.

The plugin does not create, supply, or style a coming soon or maintenance page. Create and design any destination page with your normal WordPress tools, then select it in the plugin settings.

The optional “Allow destination subpages” setting keeps the selected page and its nested child pages accessible. Administrators always have full access. In the settings, choose any additional WordPress roles that should also have full access while the detour is active.

The redirect uses HTTP 302 so it is temporary and safe to change during ongoing work. Disable the destination selection to turn redirection off.

== Installation ==

1. Upload the `dimipress-detour` folder to `/wp-content/plugins/` or install the packaged ZIP through Plugins → Add New Plugin → Upload Plugin.
2. Activate DimiPress Detour in the Plugins screen.
3. Open Settings → DimiPress Detour.
4. Select a published page and save. Optionally enable access to its child pages.

== Frequently Asked Questions ==

= Does this plugin create a maintenance page? =

No. You choose and design an existing published page yourself.

= Who can access the rest of the site during the detour? =

Administrators always have full access. Under “Roles with full site access”, select any additional WordPress roles whose signed-in users should be exempt from redirection.

= What does “Allow destination subpages” do? =

It exempts the selected page and its descendant pages from redirection. Other pages remain redirected.

= Are admin, REST, AJAX, preview, cron, and form submissions redirected? =

No. The redirect applies to public front-end GET and HEAD requests. Administrative and integration endpoints, previews, and other HTTP methods are left alone.

== Changelog ==

= 1.0.1 =
* Add the plugin and author profile URLs.
* Refine the plugin description and documentation.

= 1.0.0 =
* Initial release.
* Add a settings screen to select a published destination page.
* Add an option to allow the selected page's descendants.
* Always exempt administrators and allow additional roles to be selected for full site access.
* Exempt essential WordPress endpoints from redirects.
