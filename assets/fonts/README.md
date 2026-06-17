# Font files expected here

Drop your font files into this folder using these exact filenames:

- `font-option-1.woff2` — used by "Font Option 1"
- `font-option-2.woff2` — used by "Font Option 2"
- `font-option-3.woff2` — used by "Font Option 3"

To use real font names instead of "Font Option N":
1. Update the labels in `includes/class-font-settings.php` (`FONT_LABELS` constant).
2. Update the `font-family` names in the `@font-face` rules in `assets/css/admin-fonts.css`.

If a font file is missing, the browser fails to load that `@font-face` and
falls back to `sans-serif` — the plugin won't error, it just won't visually
change until a file is added.
