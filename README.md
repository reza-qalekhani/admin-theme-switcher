# Admin Theme Switcher 🚀

A lightweight WordPress plugin that adds a dark/light mode switcher and customizable admin font family selector to the WordPress admin dashboard.

## 📝 Description

Admin Theme Switcher enhances the WordPress admin experience with two key features:

1. **Dark Mode Toggle** — A quick-access button in the admin bar to switch between light and dark themes. User preference is saved per user.
2. **Admin Font Selector** — A settings page to choose from multiple font families for the admin interface, including support for Persian fonts like Vazirmatn, IranSansX, and IranYekan.

## ✨ Features

### Dark Mode Toggle

- **Admin Bar Button** — Quick toggle in the admin bar (displays ☀️ or 🌙 based on current mode)
- **AJAX-Based** — Instant switching without page reload
- **Per-User Preference** — Each user's preference is stored independently
- **Block Editor Support** — Styles apply to both classic admin and block editor iframe
- **Nonce Protected** — AJAX requests are secured with WordPress nonce verification

### Font Settings

- **Settings Page** — Dedicated settings page under **Settings → Admin Appearance**
- **Multiple Font Options** — Choose from Default, Vazirmatn, IranSansX, or IranYekan
- **Admin-Only** — Requires `manage_options` capability
- **Persistent Storage** — Font choice is saved as a WordPress option
- **Block Editor Support** — Custom fonts apply to the block editor canvas
- **Font Fallback** — Missing font files safely fall back to sans-serif

## 💻 Requirements

- **PHP:** 7.0 or higher
- **WordPress:** 5.0 or higher

## 🛠️ Installation

1. Download the plugin files
2. Upload the `admin-theme-switcher` folder to `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Navigate to **Settings → Admin Appearance** to configure custom font families

## ⚙️ Configuration

### 1. Dark Mode

Dark mode settings are stored per user in user meta (`ats_dark_mode`). No configuration required — users can toggle in the admin bar.

### 2. Font Selection

1. Go to **Settings → Admin Appearance** in the WordPress admin
2. Select your preferred font family
3. Click **Save Changes**

### 3. Adding Custom Fonts

To use custom fonts instead of the defaults:

1. **Add font files** to `assets/fonts/` with these filenames:
   - `font-option-1.woff2` — Used by "Font Option 1"
   - `font-option-2.woff2` — Used by "Font Option 2"
   - `font-option-3.woff2` — Used by "Font Option 3"

2. **Update font labels** in `includes/class-font-settings.php`:

   ```php
   public static function get_font_labels() {
       return array(
           'default'   => __('Default', 'admin-theme-switcher'),
           'customfont' => __('My Custom Font', 'admin-theme-switcher'),
           // ...
       );
   }
   ```

3. **Update SCSS** in `assets/scss/admin-fonts.scss`:

   ```scss
   @font-face {
     font-family: "CustomFont";
     src: url("../fonts/font-option-1.woff2") format("woff2");
   }

   .ats-font-customfont {
     --wp-admin-font: "CustomFont", sans-serif;
   }
   ```

4. **Rebuild CSS:**
   ```bash
   npm run build
   ```

## 🚀 Usage

### Using Dark Mode Toggle

1. Look for the dark/light mode icon (☀️ or 🌙) in the WordPress admin bar
2. Click to toggle between dark and light modes
3. Your preference is automatically saved to your user profile
4. Styles apply immediately without page reload

### Using Font Selector

1. Navigate to **Settings → Admin Appearance**
2. Select your preferred font family from the radio buttons
3. Click **Save Changes**
4. The font applies to all admin pages for all users (global setting)

### Using Custom Fonts

1. Place font files in `assets/fonts/` folder
2. Update font options in `includes/class-font-settings.php`
3. Update CSS classes in `assets/scss/admin-fonts.scss`
4. Run `npm run build` to compile SCSS
5. Clear cache and refresh to see changes

## 📁 Project Structure

```
admin-theme-switcher/
├── admin-theme-switcher.php      # Main plugin file with hooks
├── uninstall.php                 # Cleanup on plugin uninstallation
├── package.json                  # Build dependencies (Node.js/SASS)
├── assets/
│   ├── css/                      # Compiled CSS files
│   │   ├── dark-mode.css        # Dark mode styles
│   │   └── admin-fonts.css      # Font styles
│   ├── js/
│   │   └── dark-mode-toggle.js  # AJAX toggle handler
│   ├── scss/                     # Source SCSS files
│   │   ├── dark-mode.scss       # Dark mode SCSS
│   │   └── admin-fonts.scss     # Font SCSS
│   └── fonts/                    # Font files (WOFF2 format)
├── includes/
│   ├── class-dark-mode.php      # Dark mode toggle functionality
│   └── class-font-settings.php  # Font settings page & logic
├── languages/                    # Internationalization
│   ├── admin-theme-switcher.pot # Translatable strings template
│   └── admin-theme-switcher-fa_IR.po # Farsi translation
└── README.md                     # This file
```

## 🌍 Internationalization

The plugin is fully internationalized with:

- Text domain: `admin-theme-switcher`
- Language files location: `/languages/`
- Currently supported: English, Persian (Farsi)

### Translation Files

- `admin-theme-switcher.pot` — Translation template for translators
- `admin-theme-switcher-fa_IR.po` — Persian source translations
- `admin-theme-switcher-fa_IR.mo` — Persian compiled translations

To add new language support, create a `.po` file in the `/languages/` directory following WordPress translation conventions.

## 🧪 Development

### Building Assets

Install dependencies:

```bash
npm install
```

Build minified CSS from SCSS:

```bash
npm run build
```

Watch for changes during development:

```bash
npm run watch
```

### Technologies Used

- **PHP 7.0+** — Plugin core logic
- **JavaScript (Vanilla)** — Dark mode AJAX toggle
- **SCSS** — Stylesheets (compiled to CSS)
- **Node.js + SASS** — Build process

### Code Architecture

**Main Plugin File** (`admin-theme-switcher.php`):

- Defines plugin constants and version
- Loads text domain for translations
- Initializes the two main classes

**Dark Mode Class** (`includes/class-dark-mode.php`):

- Manages dark mode user preference (stored in user meta)
- Adds admin bar toggle button
- Handles AJAX requests for toggling
- Enqueues dark mode styles and JavaScript

**Font Settings Class** (`includes/class-font-settings.php`):

- Registers a settings page under Settings menu
- Handles font selection radio buttons
- Stores font preference as WordPress option
- Applies font class to admin body element

### Hooks & Filters

| Hook                      | Used For                                 |
| ------------------------- | ---------------------------------------- |
| `init`                    | Load text domain for translations        |
| `admin_bar_menu`          | Add dark mode toggle button              |
| `admin_enqueue_scripts`   | Load CSS/JS on admin pages               |
| `enqueue_block_assets`    | Load styles in block editor iframe       |
| `admin_body_class`        | Apply CSS classes for dark mode and font |
| `wp_ajax_ats_toggle_mode` | Handle AJAX toggle requests              |
| `admin_menu`              | Register font settings page              |
| `admin_init`              | Register font settings                   |

## 🚀 Build & Release

### Version Management

Current version: **1.2**

Plugin files to update for new releases:

1. `admin-theme-switcher.php` — Update version in plugin header and constants
2. Create/update changelog in documentation

### Release Process

1. Update version number in `admin-theme-switcher.php`
2. Test all features thoroughly
3. Update documentation if needed
4. Commit changes with version tag

### Manual Build for Distribution

```bash
npm install
npm run build
# Create plugin directory and build ZIP
mkdir -p build/admin-theme-switcher
rsync -av --exclude-from=.distignore ./ build/admin-theme-switcher/
cd build && zip -r admin-theme-switcher.zip admin-theme-switcher/
```

## 🐛 Troubleshooting

### Dark Mode Toggle Not Appearing

- Ensure the plugin is activated
- Check that you're logged in as a user
- Look in the admin bar (top-left area)

### Custom Fonts Not Loading

- Verify font files are in `assets/fonts/` with correct filenames
- Check browser console for CORS or 404 errors
- Rebuild CSS: `npm run build`
- Clear browser cache and WordPress object cache

### Styles Not Applying

- Clear the WordPress plugin cache
- Rebuild CSS assets: `npm run build`
- Check that `admin-theme-switcher.php` version constant matches compiled files

## 🤝 Contributing

Contributions are welcome! When contributing:

1. Follow WordPress coding standards
2. Test your changes thoroughly
3. Ensure internationalization compatibility
4. Document new features

## 📜 License

This plugin is open-source and free to use, modify, and distribute.

## 👨‍💻 Author

**Reza Qalekhani**

- Website: [byreza.net](https://byreza.net)
- Channel: [@byreza_net](https://t.me/byreza_net)
- Telegram ID: [@reza_qalekhani](https://t.me/@reza_qalekhani)

### ❤️ Show Your Support

If you find this project useful, please:

- ⭐ Give it a star on GitHub
- 🔗 Share it with your network
- 💬 Leave feedback and suggestions
- 🐛 Report bugs and issues

---

**Made with ❤️ by Reza Qalekhani**

Last Updated: 2026-06-18
