# TYPO3 Extension `replaceli`

This extension simply replaces the `ß` with `ss` in the full content. This is especially useful for fallbacks to swiss language

It must be enabled per site language:

```yaml
  -
    title: 'CH - DE'
    enabled: true
    languageId: '9'
    base: /de-ch/
    replaceli: 1
```

**Be aware**: Currently it replaces it everywhere, also in links.

## Installation

Use `composer require studiomitte/replaceli`.
