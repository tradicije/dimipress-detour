# DimiPress Detour

[DimiPress Detour](https://dimitrium.org/en/dimipress/detour) temporarily redirects public visitors to a published WordPress page chosen by a site administrator or a user with permission to edit pages.

The plugin does not generate or style a coming soon or maintenance page. Build the destination page with WordPress, then select it under **Settings → DimiPress Detour**. The optional **Allow destination subpages** checkbox also makes the selected page's descendants accessible. Administrators always have full access. In **Roles with full site access**, select any additional WordPress roles that should bypass the detour.

The redirect uses HTTP 302. Clear the destination selection to disable it.

## Requirements

- WordPress 6.2 or later
- PHP 7.4 or later

## Installation

1. Upload `dimipress-detour` to `/wp-content/plugins/`, or upload its ZIP from **Plugins → Add New Plugin**.
2. Activate **DimiPress Detour**.
3. Open **Settings → DimiPress Detour**, select a published page, and save.
4. Optionally enable **Allow destination subpages**.

The redirect covers public front-end GET and HEAD requests. Administrators, users in selected roles, previews, REST and AJAX requests, cron, and non-GET/HEAD requests are excluded.

## Development

See [CONTRIBUTING.md](CONTRIBUTING.md) for contribution guidance and [CHANGELOG.md](CHANGELOG.md) for release history.

## License

Created by [Aleksa Dimitrijević](https://dimitrium.org/en/dimipedia/aleksa-dimitrijevic). Copyright (C) 2026 Aleksa Dimitrijević. This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version. See [LICENSE](LICENSE) for the complete license text.
