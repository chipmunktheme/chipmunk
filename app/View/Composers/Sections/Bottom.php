<?php

namespace App\View\Composers\Sections;

use Roots\Acorn\View\Composer;

class Bottom extends Composer
{
    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'aboutCopy' => $this->getAboutCopy(),
            'socialLinks' => $this->getSocialLinks(),
        ];
    }

    /**
     * Returns about copy option.
     *
     * @return string
     */
    public function getAboutCopy()
    {
        return get_option('about_copy');
    }

    /**
     * Returns a list of available social links.
     *
     * @return array
     */
    public function getSocialLinks()
    {
        return [];
    }
}
