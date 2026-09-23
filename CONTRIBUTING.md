# Contributing

Thank you for your interest in improving DimiPress Detour.

Project page: <https://dimitrium.org/en/dimipress/detour>  
Author: [Aleksa Dimitrijević](https://dimitrium.org/en/dimipedia/aleksa-dimitrijevic)

## How to contribute

1. Check existing issues or open a discussion describing the problem or proposed change.
2. Keep changes focused and compatible with the plugin's supported WordPress and PHP versions.
3. Describe user-visible behavior, security considerations, and any manual verification performed in your pull request.
4. Update `readme.txt`, `README.md`, and `CHANGELOG.md` when behavior or setup changes.

## Development principles

- Keep the plugin small and avoid unnecessary dependencies.
- The destination is always a page chosen by the site operator; do not add generated maintenance-page content.
- Administrators always retain full site access; additional bypass access is controlled by selected WordPress roles.
- Validate and sanitize settings, escape admin output, and use WordPress APIs for redirects and capabilities.
- Do not include credentials, personal data, or unrelated site configuration in contributions.

By submitting a contribution, you agree that it is provided under the GNU Affero General Public License version 3 or, at your option, any later version.
