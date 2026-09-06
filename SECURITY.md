# Security Policy

## Supported versions

Security fixes are applied to the latest version on the `main` branch.

## Reporting a vulnerability

Please do not open a public issue for a suspected vulnerability. Use GitHub's private vulnerability reporting feature or contact the repository owner privately with:

- A clear description of the vulnerability
- Reproduction steps or a proof of concept
- The affected route, component, or dependency
- Any suggested mitigation

Do not include passwords, API tokens, database exports, or other private data in a report.

## Local security requirements

- Keep `.env` out of Git and use the hosting provider's secret manager in production.
- Never commit database dumps, `database/*.sqlite`, logs, `vendor`, or `node_modules`.
- Rotate any credential that has ever been exposed in a commit, terminal log, screenshot, or issue.
- Keep Composer, npm, and GitHub Actions dependencies updated.