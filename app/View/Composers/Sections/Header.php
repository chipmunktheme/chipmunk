<?php

namespace App\View\Composers\Sections;

use Roots\Acorn\View\Composer;

class Header extends Composer
{
    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'logo' => wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0],
        ];
    }
}
