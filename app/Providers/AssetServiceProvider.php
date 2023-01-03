<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MadeByLess\Lessi\Helper\HookTrait;

use function Roots\bundle;

class AssetServiceProvider extends ServiceProvider
{
    use HookTrait;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addAction('wp_enqueue_scripts', [ $this, 'enqueueThemeAssets' ], 100);
        $this->addAction('enqueue_block_editor_assets', [ $this, 'enqueueEditorAssets' ], 100);
        $this->addAction('admin_enqueue_scripts', [ $this, 'enqueueAdminAssets' ], 100);
    }

    /**
     * Registers the theme assets.
     *
     * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts
     */
    public function enqueueThemeAssets()
    {
        bundle('theme')->enqueue();
    }

    /**
     * Registers the theme assets with the block editor.
     *
     * @see https://developer.wordpress.org/reference/hooks/enqueue_block_editor_assets
     */
    public function enqueueEditorAssets()
    {
        bundle('editor')->enqueue();
    }

    /**
     * Registers the theme assets with the admin panel.
     *
     * @see https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts
     */
    public function enqueueAdminAssets()
    {
        bundle('admin')->enqueue();
    }
}
