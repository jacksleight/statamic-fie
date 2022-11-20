# Statamic FIE

An *experimental* [Filerobot Image Editor (FIE)](https://scaleflex.github.io/filerobot-image-editor/) integration for Statamic.

## Installation

```bash
composer require jacksleight/statamic-fie
```

## Todo & Known Issues

- [ ] Check user permissions, either existing or new
- [ ] Colour palette z-index stacking issue
- [ ] Hide "Replace Original" if unsupported format (GIF)
- [ ] Abilty to configure editor tabs, options etc.
- [ ] Clarify how saving works (no overwrite) in save dialog
- [ ] Decide name of action (Edit Image, Adjust, Manipulate, something else?)
    - Avoid confusion with existing Edit action
- [ ] Should the source image URL be cache busted?
- [ ] Does it work with S3 etc.?
- [ ] Aviod hacks that use the Actions API in unofifical ways
    - Storing the action item for use in `fieldItems`
    - Auto-submitting the action dialog/confirmation