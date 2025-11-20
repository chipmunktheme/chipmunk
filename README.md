# Chipmunk Theme
 
<p align="center">
  <strong>A modern WordPress theme for content curation websites</strong>
</p>
 
<p align="center">
  <a href="https://github.com/chipmunktheme/chipmunk/blob/main/LICENSE">
      <img src="https://img.shields.io/badge/license-GPL--3.0-blue.svg" alt="License">
    </a>
    <a href="https://github.com/chipmunktheme/chipmunk/releases">
      <img src="https://img.shields.io/badge/version-1.19.1-green.svg" alt="Version">
    </a>
  </p>
 
---
 
## Overview
 
Chipmunk is a clean, modern WordPress theme built specifically for **content curation websites**. Whether you're building a marketing resource hub, establishing authority in your niche, or creating a community-driven collection, Chipmunk makes it ridiculously easy—no coding skills required.
 
Built with professional development practices and optimized for speed, Chipmunk combines powerful curation features with a highly customizable interface that both site owners and visitors will love.
 
## Features
 
### Content Curation
- **Custom Resource Post Type** - Dedicated post type designed specifically for curated content
- **Smart Taxonomies** - Organize resources with hierarchical collections and flexible tags
- **AJAX-Powered Browsing** - Infinite scroll and lazy loading for seamless content discovery
- **Advanced Filtering & Sorting** - Filter by collection, tag, date, popularity, ratings, and more
- **REST API Ready** - Full REST API support for headless CMS implementations
 
### User Engagement
- 🔖 **Bookmarks** - Let users save their favorite resources for later
- ⬆️ **Upvotes** - Community-driven voting system to surface the best content
- ⭐ **Ratings** - 5-star rating system for detailed feedback (optional addon)
- 💬 **Threaded Comments** - Native WordPress comments with full threading support
- 📊 **View Tracking** - Automatic view counting and display
 
### Community Features
- 📝 **User Submissions** - Accept resource submissions from your community
- 🛡️ **reCAPTCHA Integration** - Spam protection for submission forms
- 👥 **Member System** - User registration, login, and member profiles (optional addon)
- 🔔 **Email Notifications** - Automated emails for submissions and interactions
 
### Design & Customization
- 🎨 **Visual Customizer** - 80+ theme options accessible through WordPress Customizer
- 🌈 **Color Control** - Customize primary colors, links, backgrounds, and sections
- 📝 **Typography Options** - Choose from hundreds of Google Fonts
- 📱 **Fully Responsive** - Mobile-first design that looks great on all devices
- 🎯 **Multiple Page Templates** - Full-width, wide, normal, narrow layouts plus custom pages
- 🖼️ **Custom Image Sizes** - Optimized image sizes for different contexts
 
### Social & SEO
- 🌐 **Open Graph Meta Tags** - Perfect social media sharing with rich previews
- 🔗 **Social Profiles** - Link to 14+ social networks
- 📣 **Share Buttons** - Built-in social sharing functionality
- 🔍 **SEO-Friendly** - Semantic HTML5 markup and proper heading hierarchy
 
### Developer Experience
- ⚡ **Modern Build Tools** - Gulp-based asset pipeline with SCSS and JavaScript minification
- 📦 **Composer Dependencies** - Professional PHP dependency management
- 🎯 **PSR-4 Autoloading** - Clean, namespaced object-oriented code
- 🔧 **Modular Architecture** - Well-organized, extensible codebase
- 🎨 **SCSS Stylesheets** - Maintainable styles with variables and mixins
- 🚀 **Asset Versioning** - Automatic cache busting with manifest.json
- 🌍 **Translation Ready** - Full i18n support with .pot files
 
## Requirements
 
- PHP >= 7.4
- WordPress >= 5.0
- [Composer](https://getcomposer.org/) (for dependency management)
- [Node.js](https://nodejs.org/) >= 12.0 (for local development)
- MySQL >= 5.7 OR MariaDB >= 10.2
 
### Recommended
- PHP >= 8.0
- MySQL >= 8.0
- WordPress >= 6.0
 
## Installation
 
### Standard Installation
 
1. **Download the theme**
   ```bash
      git clone https://github.com/chipmunktheme/chipmunk.git
      cd chipmunk
      ```
    
2. **Install PHP dependencies**
   ```bash
      composer install --no-dev
      ```
    
   > **Note:** You'll need an Advanced Custom Fields Pro license key. Set it in your environment or use composer config:
      > ```bash
      > composer config http-basic.connect.advancedcustomfields.com your-key your-key
      > ```
    
3. **Upload to WordPress**
   - Copy the entire theme folder to `wp-content/themes/chipmunk`
      - Activate the theme in WordPress Admin → Appearance → Themes
    
4. **Configure the theme**
   - Navigate to Appearance → Customize
      - Configure your logo, colors, fonts, and features
      - Save and publish your changes
    
### Quick Start with Pre-built Assets
 
If you just want to use the theme without building assets:
 
1. Download or clone the repository
2. Run `composer install --no-dev`
3. Upload to `wp-content/themes/`
4. Activate and configure
 
The theme comes with pre-built assets in `static/dist/`, so you can use it immediately.
 
## Local Development
 
### Prerequisites
 
- PHP >= 7.4 with Composer
- Node.js >= 12.0 with npm
- Local WordPress development environment ([Local](https://localwp.com/), [XAMPP](https://www.apachefriends.org/), [MAMP](https://www.mamp.info/), etc.)
- Git
 
### Setup
 
1. **Clone the repository**
   ```bash
      cd wp-content/themes/
      git clone https://github.com/chipmunktheme/chipmunk.git
      cd chipmunk
      ```
    
2. **Install PHP dependencies**
   ```bash
      composer install
      ```
    
   Configure ACF Pro credentials if needed:
      ```bash
      composer config http-basic.connect.advancedcustomfields.com your-license-key your-license-key
      ```
    
3. **Install Node dependencies**
   ```bash
      cd vendor/chipmunk-theme/almond
      npm install
      ```
    
4. **Activate the theme**
   - Log in to WordPress Admin
      - Go to Appearance → Themes
      - Activate "Chipmunk Theme"
    
### Development Workflow
 
The theme uses a Gulp-based build system (Almond) for compiling assets:
 
```bash
cd vendor/chipmunk-theme/almond
```
 
**Available commands:**
 
- `gulp` - Build all assets once
- `gulp watch` - Watch for changes and rebuild automatically (with BrowserSync)
- `gulp styles` - Compile SCSS to CSS
- `gulp scripts` - Minify JavaScript
- `gulp images` - Optimize images
- `gulp clean` - Clean the dist folder
 
**Development process:**
 
1. Make changes to source files in `static/src/`:
   - **Styles:** `static/src/styles/` (SCSS files)
      - **Scripts:** `static/src/scripts/` (JavaScript modules)
      - **Images:** `static/src/assets/`
    
2. Run `gulp watch` to compile automatically on save
 
3. Built assets are output to `static/dist/`
 
4. The theme automatically loads versioned assets using `static/dist/manifest.json`
 
### File Structure
 
```
chipmunk/
├── includes/                   # PHP classes (PSR-4 autoloaded)
│   ├── Setup.php              # Theme initialization
│   ├── Assets.php             # Asset management
│   ├── Features.php           # Post types, taxonomies, menus
│   ├── Customizer.php         # Theme customization options
│   ├── Helpers.php            # Utility functions
│   ├── Query.php              # Custom database queries
│   ├── Actions.php            # AJAX handlers
│   ├── Extensions/            # Core features (bookmarks, upvotes, etc.)
│   ├── Addons/                # Optional addons (members, ratings)
│   └── Vendors/               # Third-party integrations
│
├── templates/                 # Template partials
│   ├── partials/             # Reusable components
│   ├── sections/             # Content sections
│   ├── shortcodes/           # Shortcode templates
│   └── addons/               # Addon templates
│
├── static/
│   ├── src/                  # Source files (for development)
│   │   ├── styles/          # SCSS files
│   │   └── scripts/         # JavaScript modules
│   └── dist/                # Compiled assets (for production)
│       ├── css/
│       ├── js/
│       └── manifest.json    # Asset version map
│
├── vendor/                    # Composer dependencies
│   └── chipmunk-theme/
│       └── almond/           # Build system
│           ├── gulpfile.js
│           └── package.json
│
├── functions.php             # Theme entry point
├── style.css                 # Theme metadata
├── *.php                     # WordPress template files
└── composer.json             # PHP dependencies
```
 
## Configuration
 
### Theme Options
 
Access all theme settings via **WordPress Admin → Appearance → Customize**:
 
#### General Settings
- **Logo** - Upload your site logo
- **Favicon** - Set browser icon
- **Colors** - Primary color, link color, background, sections
- **Typography** - Choose Google Fonts for body and headings
- **Layout** - Content width (6-12 columns)
 
#### Features
- **Bookmarks** - Enable/disable bookmark functionality
- **Upvotes** - Enable/disable voting system
- **Submissions** - Enable user-submitted resources
- **Views** - Track and display view counts
- **Comments** - Enable/disable comments on resources
- **Ratings** - Enable 5-star rating system (addon)
 
#### Social Settings
- **Social Profiles** - Link to your social media accounts
- **Share Buttons** - Configure social sharing options
 
#### Advanced
- **reCAPTCHA** - Add site key and secret for spam protection
- **Custom CSS** - Add your own CSS without editing files
- **Scripts** - Add custom JavaScript (header/footer)
 
### Addons
 
Optional addons can be enabled in the Customizer:
 
- **Members** - User registration, login, and member profiles
- **Ratings** - 5-star rating system for resources
 
### Custom Post Type: Resources
 
The theme registers a custom post type called "Resources" with:
 
- **Taxonomies:**
  - `resource-collection` (hierarchical, like categories)
    - `resource-tag` (flat, like tags)
   
- **Features:**
  - Featured images
    - Excerpts
    - Comments
    - Editor (Gutenberg)
    - REST API support
   
- **Custom Fields** (via ACF):
  - External URLs
    - Custom metadata
    - Additional resource information
   
### Shortcodes
 
Available shortcodes:
 
- `[chipmunk-counter]` - Display resource counter
- `[chipmunk-submit]` - Display submission form
 
## Customization
 
### Adding Custom Styles
 
**Option 1: Customizer (recommended)**
- Go to Appearance → Customize → Additional CSS
- Add your custom CSS
 
**Option 2: Child Theme**
1. Create a child theme following [WordPress guidelines](https://developer.wordpress.org/themes/advanced-topics/child-themes/)
2. Add your custom styles to the child theme's `style.css`
 
**Option 3: Modify Source (for developers)**
1. Edit SCSS files in `static/src/styles/`
2. Run `gulp watch` to compile
3. Built CSS appears in `static/dist/css/`
 
### Adding Custom JavaScript
 
**Customizer method:**
- Appearance → Customize → Custom Scripts
- Add scripts to header or footer sections
 
**Developer method:**
1. Add modules to `static/src/scripts/modules/`
2. Import in `static/src/scripts/theme.js`
3. Run `gulp watch` to compile
 
### Creating Custom Templates
 
1. Copy a template file (e.g., `page.php`)
2. Add template name comment at the top:
   ```php
      <?php
   /**
    *     * Template Name: My Custom Template
    */
    ```
   3. Modify the template as needed
4. Select the template in the page editor
 
## Updating
 
### From Git
 
```bash
cd wp-content/themes/chipmunk
git pull origin main
composer install --no-dev
```
 
### Manual Update
 
1. Backup your current theme
2. Download the latest release
3. Replace theme files (keep `static/dist/` if you haven't modified it)
4. Run `composer install --no-dev`
 
> **Note:** Always backup your database and files before updating.
 
## Troubleshooting
 
### Styles not loading?
 
1. Check that `static/dist/` folder exists with CSS files
2. Run `gulp` to rebuild assets
3. Clear WordPress cache
4. Check file permissions
 
### Features not working?
 
1. Ensure all Composer dependencies are installed
2. Check that ACF Pro is properly authenticated
3. Verify PHP version meets requirements
4. Enable WordPress debug mode to see errors
 
### Build errors?
 
1. Delete `node_modules` and run `npm install` again
2. Check Node.js version (>= 12.0)
3. Try `npm cache clean --force`
 
### reCAPTCHA not working?
 
1. Verify you're using reCAPTCHA v2
2. Check Site Key and Secret Key in Customizer
3. Ensure keys match your domain
4. Check browser console for JavaScript errors
 
## Contributing
 
We welcome contributions from the community! Here's how you can help:
 
- **Report bugs** - Open an issue with details and steps to reproduce
- **Suggest features** - Share your ideas for improvements
- **Submit pull requests** - Fix bugs or add features
- **Improve documentation** - Help make these docs better
- **Share feedback** - Let us know how you're using Chipmunk
 
Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.
 
## Support
 
- **Documentation** - You're reading it!
- **Issues** - [GitHub Issues](https://github.com/chipmunktheme/chipmunk/issues)
- **Discussions** - [GitHub Discussions](https://github.com/chipmunktheme/chipmunk/discussions)
 
## Credits
 
### Creator
**Piotr Kulpinski**
- Website: [kulpinski.dev](https://kulpinski.dev)
- Email: piotr@kulpinski.pl
 
### Built With
- [WordPress](https://wordpress.org/) - Content management system
- [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/) - Custom field management
- [Gulp](https://gulpjs.com/) - Build system and task runner
- [SCSS](https://sass-lang.com/) - CSS preprocessing
- Many other [open-source libraries](composer.json)
 
## License
 
Chipmunk Theme is open-source software licensed under the [GNU General Public License v3.0](LICENSE).
 
You are free to use, modify, and distribute this theme under the terms of the GPL-3.0 license.
 
## Changelog
 
See [CHANGELOG.md](CHANGELOG.md) for a detailed version history.
 
---
 
<p align="center">
    <a href="https://github.com/chipmunktheme/chipmunk">GitHub</a> •
    <a href="https://github.com/chipmunktheme/chipmunk/issues">Issues</a> •
    <a href="https://github.com/chipmunktheme/chipmunk/discussions">Discussions</a>
  </p>
