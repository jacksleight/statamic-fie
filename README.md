# FIE

An *experimental* [Filerobot Image Editor (FIE)](https://github.com/scaleflex/filerobot-image-editor) integration for Statamic.

https://user-images.githubusercontent.com/126740/202912999-50887270-ad8d-4f02-89b1-28a520d120ad.mp4

## Installation

```bash
composer require jacksleight/statamic-fie
```

## Todo & Known Issues

- [ ] Verify user permissions, either existing or new
- [ ] Abilty to configure editor tabs, options etc.
- [ ] Colour palette z-index stacking issue
- [ ] Hide "Replace Original" if unsupported format (GIF)
- [ ] Clarify how saving works (no overwrite) in save dialog
- [ ] Review name of action (Edit Image, Modify, Adjust, Manipulate, something else?)
    - Avoid confusion with existing Edit action
- [ ] Review save options (replacement vs reupload etc.)
- [ ] Should the source image URL be cache busted?
- [ ] Does it work with S3 etc.?, I think so but check
- [ ] Aviod hacks that use the Actions API in unofifical ways
    - Storing the action item for use in `fieldItems` (can be resolved since 3.4)
    - Auto-submitting the action dialog/confirmation
