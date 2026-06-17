# 🎨 Admin Theme Switcher

> Enhance your WordPress admin experience with dark mode and custom fonts

[![Version](https://img.shields.io/badge/version-1.1-blue.svg)](https://github.com/rezaqalekhani/admin-theme-switcher)
[![License](https://img.shields.io/badge/license-GPL--2.0-green.svg)](#license)
[![WordPress Compatible](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)](https://wordpress.org)

## ✨ Features

- 🌙 **Dark Mode Toggle** - Switch between light and dark themes with one click
- ☀️ **Light Mode** - Eye-friendly light theme for comfortable daytime work
- 🔤 **Custom Font Support** - Choose from multiple font families including:
  - Default System Font
  - Vazirmatn (Persian)
  - IranSansX (Persian)
  - IranYekan (Persian)
- 🎛️ **Settings Panel** - Easy-to-use admin settings page
- 🌍 **Multi-language Support** - Built-in Farsi (Persian) localization
- ⚡ **Lightweight** - Minimal performance impact
- 🔐 **Per-User Settings** - Each admin user has their own preferences

## 📦 Installation

1. **Download the plugin** or clone the repository:

   ```bash
   git clone https://github.com/rezaqalekhani/admin-theme-switcher.git admin-theme-switcher
   ```

2. **Place in WordPress plugins directory:**

   ```
   /wp-content/plugins/admin-theme-switcher/
   ```

3. **Activate the plugin** from WordPress admin panel

4. **Visit Settings → Admin Appearance** to configure

## 🚀 Quick Start

### For Users

- Look for the **🌙 Dark Mode** / **☀️ Light Mode** toggle in the WordPress admin toolbar
- Click to switch themes instantly
- Visit **Settings → Admin Appearance** to select your preferred font family

### For Developers

#### Build Assets

```bash
npm install
npm run build
```

#### Watch for Changes

```bash
npm run watch
```

## 📁 Project Structure

```
admin-theme-switcher/
├── assets/
│   ├── css/                    # Compiled CSS files
│   │   ├── admin-fonts.css
│   │   └── dark-mode.css
│   ├── fonts/                  # Custom fonts (Persian)
│   │   ├── Vazirmatn.woff2
│   │   ├── IranSansX.woff2
│   │   └── IranYekan.woff2
│   ├── js/
│   │   └── dark-mode-toggle.js # Toggle functionality
│   └── scss/                   # Source SCSS files
│       ├── admin-fonts.scss
│       └── dark-mode.scss
├── includes/
│   ├── class-dark-mode.php     # Dark mode functionality
│   └── class-font-settings.php # Font selector logic
├── languages/
│   ├── admin-theme-switcher.pot          # Translation template
│   └── admin-theme-switcher-fa_IR.po     # Farsi translation
├── .github/
│   └── workflows/
│       └── release.yml         # Automated release workflow
├── admin-theme-switcher.php    # Main plugin file
├── uninstall.php               # Cleanup on uninstall
├── package.json                # Node dependencies
└── README.md                   # This file
```

## 🛠️ Core Classes

### `ATS_Dark_Mode`

Manages the dark/light mode functionality:

- Adds toolbar toggle button
- Manages user preferences via meta keys
- Enqueues styles and scripts
- Handles AJAX toggle requests

**Key Methods:**

- `init()` - Initialize hooks
- `is_dark_mode_enabled($user_id)` - Check user's theme preference
- `ajax_toggle_mode()` - Handle theme switching

### `ATS_Font_Settings`

Handles custom font selection:

- Adds admin settings page under Settings → Admin Appearance
- Manages font family preferences
- Supports Persian font families
- Enqueues font assets globally

**Key Methods:**

- `init()` - Initialize hooks
- `get_font_labels()` - Get available fonts
- `register_settings()` - Register WordPress settings
- `sanitize_font_choice()` - Validate font selection

## 📝 Configuration

### Available Font Families

```php
[
  'default'   => 'Default',
  'vazirmatn' => 'Vazirmatn',
  'iransansx' => 'IranSansX',
  'iranyekan' => 'IranYekan',
]
```

### Theme Classes

The plugin adds CSS classes to adjust styling:

- `.ats-dark` - Applied when dark mode is enabled
- `.ats-font-{family}` - Applied based on selected font

## 🌍 Localization

The plugin supports multiple languages through WordPress translation system:

- **Text Domain:** `admin-theme-switcher`
- **Language Files:** `/languages/`
- **Currently Supported:**
  - English (en_US)
  - Persian/Farsi (fa_IR)

To contribute translations:

1. Extract strings: Use WordPress translation tools
2. Translate `.pot` file to your language
3. Submit as `.mo` and `.po` files

## 🔧 Development

### Requirements

- PHP 7.2+
- WordPress 6.0+
- Node.js 18+ (for building assets)

### Setup Development Environment

```bash
# Install dependencies
npm install

# Watch SCSS files for changes
npm run watch

# Build for production
npm run build
```

### Build Workflow

The project uses GitHub Actions for automated releases:

- Extracts version from plugin header
- Builds assets with npm
- Creates deployment ZIP file
- Generates changelog from git commits

## 📦 Release Process

Releases are automated via GitHub Actions workflow:

1. **Trigger:** Manual workflow dispatch
2. **Extract Version:** From plugin header comment
3. **Build Assets:** Compile SCSS to CSS
4. **Create ZIP:** Package plugin for distribution
5. **Generate Changelog:** From recent commits
6. **Create Release:** Push to GitHub Releases

```bash
# Manual release (if using CLI)
git tag v1.1
git push origin v1.1
```

## 🐛 Troubleshooting

### Dark mode not applying?

- Clear browser cache
- Verify user meta is being saved: Check `wp_usermeta` table for `ats_dark_mode` key
- Check browser console for JavaScript errors

### Font not changing?

- Ensure browser supports WOFF2 format
- Verify font files are in `/assets/fonts/`
- Check if the selected font is properly registered in settings

### Settings page not appearing?

- Verify user has `manage_options` capability
- Check plugin activation status
- Look for PHP errors in debug.log

## 📄 License

This plugin is licensed under the **GNU General Public License v2.0** or later.

```
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
```

See the full license text at: https://www.gnu.org/licenses/gpl-2.0.html

## 👨‍💻 Author

**Reza Qalekhani**

- Website: https://byreza.net
- GitHub: [@rezaqalekhani](https://github.com/reza-qalekhani)

### Code Standards

- Follow WordPress coding standards
- Use SCSS for styles
- Keep JavaScript vanilla (no jQuery dependency)
- Ensure accessibility (WCAG 2.1 AA)

## 🗺️ Roadmap

- [ ] Support for more font families
- [ ] Custom color scheme editor
- [ ] Plugin settings export/import
- [ ] Admin interface theme customization

## 📞 Support

For issues, feature requests, or questions:

- **GitHub Issues:** https://github.com/reza-qalekhani/admin-theme-switcher/issues
- **Website:** https://byreza.net
- **Telegram Channel** https://t.me/byreza_net

## ❤️ Show Your Support

If you find this plugin useful, please:

- ⭐ Give it a star on GitHub
- 🔗 Share it with your network
- 💬 Leave feedback and suggestions
- 🐛 Report bugs and issues

---

**Made with ❤️ by Reza Qalekhani**

Last Updated: June 17, 2026
