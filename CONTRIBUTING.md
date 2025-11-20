# Contributing to Chipmunk Theme
 
First off, thank you for considering contributing to Chipmunk Theme! It's people like you that make open-source projects thrive. We welcome contributions from developers of all skill levels.
 
## Table of Contents
 
- [Code of Conduct](#code-of-conduct)
- [How Can I Contribute?](#how-can-i-contribute)
  - [Reporting Bugs](#reporting-bugs)
  - [Suggesting Features](#suggesting-features)
  - [Code Contributions](#code-contributions)
  - [Documentation](#documentation)
- [Development Setup](#development-setup)
- [Coding Standards](#coding-standards)
- [Pull Request Process](#pull-request-process)
- [Style Guidelines](#style-guidelines)
- [Community](#community)
 
## Code of Conduct
 
This project and everyone participating in it is governed by our [Code of Conduct](CODE_OF_CONDUCT.md). By participating, you are expected to uphold this code. Please report unacceptable behavior to piotr@kulpinski.pl.
 
## How Can I Contribute?
 
### Reporting Bugs
 
Bugs are tracked as [GitHub issues](https://github.com/chipmunktheme/chipmunk/issues). Before creating a bug report, please check existing issues to avoid duplicates.
 
**When submitting a bug report, include:**
 
- **Clear title and description** - Explain the problem in detail
- **Steps to reproduce** - Provide specific steps to reproduce the issue
- **Expected behavior** - What you expected to happen
- **Actual behavior** - What actually happened
- **Environment details:**
  - WordPress version
  - PHP version
  - Theme version
  - Browser and version (for front-end issues)
  - Active plugins
- **Screenshots or videos** - If applicable
- **Error messages** - Any errors from debug.log or browser console
 
**Example bug report:**
 
```markdown
**Bug Description:**
Bookmarks are not being saved when users click the bookmark button.
 
**Steps to Reproduce:**
1. Go to any resource page while logged in
2. Click the bookmark icon
3. Reload the page
4. The resource is not bookmarked
 
**Expected Behavior:**
The resource should remain bookmarked after page reload.
 
**Environment:**
- WordPress: 6.4.1
- PHP: 8.1
- Theme: 1.19.1
- Browser: Chrome 120
- Console Error: "Uncaught ReferenceError: chipmunk is not defined"
```
 
### Suggesting Features
 
We love feature suggestions! Before creating a feature request:
 
1. Check if the feature already exists in the latest version
2. Search existing issues to avoid duplicates
3. Consider if the feature aligns with the theme's purpose
 
**When suggesting a feature, include:**
 
- **Clear use case** - Explain why this feature would be useful
- **Detailed description** - How should it work?
- **Examples** - Mock-ups, screenshots, or links to similar implementations
- **Alternatives considered** - Other ways to solve the problem
 
### Code Contributions
 
We welcome code contributions! Here's how to get started:
 
1. **Fork the repository**
2. **Create a feature branch** (`git checkout -b feature/amazing-feature`)
3. **Make your changes** following our [coding standards](#coding-standards)
4. **Test thoroughly** - Ensure nothing breaks
5. **Commit with clear messages** (`git commit -m 'Add amazing feature'`)
6. **Push to your fork** (`git push origin feature/amazing-feature`)
7. **Open a Pull Request**
 
### Documentation
 
Documentation improvements are always welcome! You can contribute by:
 
- Fixing typos or clarifying existing docs
- Adding missing documentation
- Creating tutorials or guides
- Improving code comments
- Translating documentation
 
## Development Setup
 
Follow these steps to set up your development environment:
 
### Prerequisites
 
- PHP >= 7.4 with Composer
- Node.js >= 12.0 with npm
- Git
- Local WordPress installation
 
### Setup Steps
 
1. **Fork and clone:**
   ```bash
   git clone https://github.com/YOUR_USERNAME/chipmunk.git
   cd chipmunk
   ```
 
2. **Install dependencies:**
   ```bash
   composer install
   cd vendor/chipmunk-theme/almond
   npm install
   ```
 
3. **Configure ACF Pro:**
   ```bash
   composer config http-basic.connect.advancedcustomfields.com YOUR_KEY YOUR_KEY
   ```
 
4. **Start development:**
   ```bash
   gulp watch
   ```
 
5. **Make changes** to files in `static/src/` or `includes/`
 
6. **Test your changes** in a local WordPress installation
 
## Coding Standards
 
### PHP Standards
 
We follow [WordPress PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/) with some additions:
 
**General Rules:**
- Use PSR-4 autoloading with `Chipmunk\` namespace
- Use type hints for function parameters and return types where possible
- Write clear, descriptive function and variable names
- Add DocBlocks for all classes, methods, and functions
- Keep functions small and focused on a single task
 
**Example:**
 
```php
<?php
 
namespace Chipmunk\Extensions;
 
/**
 * Handles bookmark functionality for resources.
 *
 * @since 1.0.0
 */
class Bookmarks {
    /**
     * Add a bookmark for a user.
     *
     * @param int $user_id The user ID.
     * @param int $resource_id The resource ID.
     * @return bool True on success, false on failure.
     */
    public function add_bookmark( int $user_id, int $resource_id ): bool {
        // Implementation
    }
}
```
 
**Sanitization & Security:**
- Always sanitize user input
- Escape output appropriately (`esc_html()`, `esc_url()`, `esc_attr()`)
- Use nonces for forms and AJAX requests
- Verify user capabilities before privileged operations
 
### JavaScript Standards
 
**General Rules:**
- Use ES6+ modern JavaScript
- Use meaningful variable names
- Add comments for complex logic
- Keep functions small and focused
- Use `const` and `let`, never `var`
 
**Example:**
 
```javascript
/**
 * Handle bookmark button click
 * @param {Event} event - Click event
 */
const handleBookmarkClick = (event) => {
  event.preventDefault();
  const button = event.currentTarget;
  const resourceId = button.dataset.resourceId;
 
  // Toggle bookmark via AJAX
  toggleBookmark(resourceId);
};
```
 
### CSS/SCSS Standards
 
**General Rules:**
- Use BEM-like naming convention for classes
- Use SCSS variables for colors, fonts, and spacing
- Mobile-first responsive design
- Keep specificity low
- Group related properties together
 
**Example:**
 
```scss
// Variables
$primary-color: #007bff;
$spacing-unit: 1rem;
 
// Component
.resource-card {
  padding: $spacing-unit;
  background: white;
 
  &__title {
    color: $primary-color;
    font-size: 1.5rem;
  }
 
  &__meta {
    color: #666;
    font-size: 0.875rem;
  }
 
  // Responsive
  @media (min-width: 768px) {
    padding: $spacing-unit * 2;
  }
}
```
 
### File Organization
 
**PHP Files:**
- One class per file
- File names match class names
- Place in appropriate directory under `includes/`
 
**SCSS Files:**
- Split into logical modules in `static/src/styles/`
- Import in main stylesheet
- Use partials with underscore prefix
 
**JavaScript Files:**
- Modular structure in `static/src/scripts/modules/`
- Import in `theme.js`
- Keep modules focused on single functionality
 
## Pull Request Process
 
### Before Submitting
 
1. **Test thoroughly** in multiple browsers
2. **Check for console errors** (browser and PHP)
3. **Ensure code follows standards**
4. **Update documentation** if needed
5. **Add yourself to credits** if it's your first contribution
 
### PR Description Template
 
```markdown
## Description
Brief description of changes
 
## Type of Change
- [ ] Bug fix (non-breaking change which fixes an issue)
- [ ] New feature (non-breaking change which adds functionality)
- [ ] Breaking change (fix or feature that would cause existing functionality to not work as expected)
- [ ] Documentation update
 
## Testing
How has this been tested?
 
- [ ] Local WordPress installation
- [ ] Different browsers (Chrome, Firefox, Safari)
- [ ] Mobile devices
- [ ] With/without specific plugins
 
## Checklist
- [ ] My code follows the project's coding standards
- [ ] I have tested my changes thoroughly
- [ ] I have commented my code where necessary
- [ ] I have updated the documentation
- [ ] My changes generate no new warnings or errors
- [ ] I have added tests that prove my fix is effective or that my feature works
 
## Screenshots
If applicable, add screenshots to help explain your changes.
 
## Related Issues
Closes #(issue number)
```
 
### Review Process
 
1. Maintainers will review your PR within a few days
2. Address any requested changes
3. Once approved, your PR will be merged
4. Your contribution will be credited in the changelog
 
## Style Guidelines
 
### Git Commit Messages
 
- Use present tense ("Add feature" not "Added feature")
- Use imperative mood ("Move cursor to..." not "Moves cursor to...")
- Limit first line to 72 characters
- Reference issues and pull requests after the first line
 
**Examples:**
 
```
Fix bookmark AJAX handler returning wrong status
 
The bookmark handler was returning success even when the database
update failed. Added proper error checking and return appropriate
status codes.
 
Fixes #123
```
 
```
Add filter for customizing resource query args
 
Allows developers to modify the query arguments used when fetching
resources. Useful for adding custom sorting or filtering logic.
 
- Added `chipmunk_resource_query_args` filter
- Updated documentation
- Added example usage in comments
```
 
### Branch Naming
 
Use descriptive branch names with prefixes:
 
- `feature/` - New features
- `fix/` - Bug fixes
- `docs/` - Documentation changes
- `refactor/` - Code refactoring
- `test/` - Adding tests
 
**Examples:**
- `feature/add-custom-sorting`
- `fix/bookmark-ajax-error`
- `docs/update-installation-guide`
 
## Community
 
### Getting Help
 
- **GitHub Discussions** - Ask questions, share ideas
- **GitHub Issues** - Report bugs, suggest features
- **Code Reviews** - Learn from PR feedback
 
### Recognition
 
Contributors are recognized in:
- [CHANGELOG.md](CHANGELOG.md) - For each release
- GitHub contributors page
- Special mentions for significant contributions
 
## Questions?
 
Don't hesitate to ask questions! You can:
- Open a discussion on GitHub
- Comment on relevant issues
- Email the maintainer at piotr@kulpinski.pl
 
---
 
Thank you for contributing to Chipmunk Theme! 🐿️
