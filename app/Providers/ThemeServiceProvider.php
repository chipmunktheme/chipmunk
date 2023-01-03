<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MadeByLess\Lessi\Factory\PostType;
use MadeByLess\Lessi\Helper\{CoreTrait, HookTrait, ThemeTrait};
use App\Services\Helper;

class ThemeServiceProvider extends ServiceProvider
{
    use CoreTrait;
    use HookTrait;
    use ThemeTrait;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Helper::class);
        $this->app->alias(Helper::class, 'helper');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addAction('after_setup_theme', [ $this, 'addSupports' ]);
        $this->addAction('after_setup_theme', [ $this, 'addImageSizes' ]);
        $this->addAction('after_setup_theme', [ $this, 'addNavMenus' ]);
        $this->addAction('after_setup_theme', [ $this, 'addTextDomains' ]);
        $this->addAction('after_setup_theme', [ $this, 'addPostTypes' ]);
        $this->addAction('after_setup_theme', [ $this, 'setupThreadedComments' ]);

        add_action('widgets_init', function () {
            $config = [
                'before_widget' => '<section class="widget %1$s %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h3>',
                'after_title' => '</h3>',
            ];

            register_sidebar([
                'name' => __('Primary', 'sage'),
                'id' => 'sidebar-primary',
            ] + $config);

            register_sidebar([
                'name' => __('Footer', 'sage'),
                'id' => 'sidebar-footer',
            ] + $config);
        });
    }

    /**
     * Registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
     */
    public function addSupports()
    {

        /**
         * Enable theme support for a various features.
         *
         * @link https://developer.wordpress.org/reference/functions/add_theme_support
         */
        $this->addSupport('title-tag');
        $this->addSupport('custom-logo');
        $this->addSupport('automatic-feed-links');
        $this->addSupport('post-thumbnails');
        $this->addSupport('comments');
        $this->addSupport('threaded-comments');
        $this->addSupport('align-wide');
        $this->addSupport('responsive-embeds');
        $this->addSupport('html5', [
            'caption',
            'comment-form',
            'comment-list',
            'gallery',
            'search-form',
            'script',
            'style',
        ]);

        /**
         * Enable features from the Soil plugin if activated.
         *
         * @link https://roots.io/plugins/soil/
         */
        $this->addSupport('soil', [
            'clean-up',
            'nice-search',
            'relative-urls',
            'disable-rest-api',
            'disable-trackbacks',
            'disable-asset-versioning',
        ]);

        /**
         * Disable full-site editing support.
         *
         * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
         */
        $this->removeSupport('block-templates');

        /**
         * Disable the default block patterns.
         *
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
         */
        $this->removeSupport('core-block-patterns');
    }

    /**
     * Registers custom image sizes.
     *
     * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
     */
    public function addImageSizes()
    {
        $this->addImageSize('1920x1080', 1920, 1080);
        $this->addImageSize('1280x960', 1280, 960);
        $this->addImageSize('1280x720', 1280, 720);
        $this->addImageSize('640x480', 640, 480);
    }

    /**
     * Registers custom navigation menus.
     *
     * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
     */
    public function addNavMenus()
    {
        $this->addNavMenu('primary', __('Header menu', 'chipmunk'));
        $this->addNavMenu('secondary', __('Footer menu', 'chipmunk'));
    }

    /**
     * Makes theme available for translation.
     * Translations can be filed in the /languages/ directory.
     *
     * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
     */
    public function addTextDomains()
    {
        $this->addTextDomain(
            $this->getThemeProperty('text-domain'),
            $this->getThemeFilePath('resources/languages')
        );
    }

    /**
     * Register custom post types and their related taxonomies.
     *
     * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
     */
    public function addPostTypes()
    {
        $resource = new PostType(
            __('Resource', 'chipmunk'),
            __('Resources', 'chipmunk'),
            [
                'menu_icon'     => 'dashicons-screenoptions',
                'menu_position' => 20,
            ],
        );

        $resource->register();
        $resource->addTaxonomy(
            __('Collection', 'chipmunk'),
            __('Collections', 'chipmunk'),
        );
        $resource->addTaxonomy(
            __('Tag', 'chipmunk'),
            __('Tags', 'chipmunk'),
            [
                'hierarchical' => false,
            ],
        );
    }

    /**
     * Loads comment reply link in case of page and post pages
     * if threaded comments are enabled.
     *
     * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
     */
    public function setupThreadedComments()
    {
        if (! is_admin()) {
            if (is_singular() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
        }
    }
}
