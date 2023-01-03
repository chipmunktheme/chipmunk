<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use MadeByLess\Lessi\Helper\SelectorTrait;

class App extends Composer
{
    use SelectorTrait;

    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => $this->siteName(),
            'siteUrl' => $this->siteUrl(),
            'theme' => $this->theme(),
        ];
    }

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * Returns the site url.
     *
     * @return string
     */
    public function siteUrl()
    {
        return home_url('/');
    }

    /**
     * Returns the theme object.
     *
     * @return object
     */
    public function theme()
    {
        return wp_get_theme();
    }
}
