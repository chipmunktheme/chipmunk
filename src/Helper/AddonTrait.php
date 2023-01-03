<?php

namespace Chipmunk\Helper;

use MadeByLess\Lessi\Helper\HookTrait;
use Chipmunk\Settings\Addons;
use Chipmunk\Settings\Licenser;

/**
 * Provides methods related to addons
 */
trait AddonTrait
{
    use HookTrait;

    /**
     * Check if theme addon is enabled
     *
     * @param string $addon
     *
     * @return bool
     */
    public function isAddonEnabled(string $addon): bool
    {
        $addons = Addons::getInstance()->getAddons();
        $options = Addons::getInstance()->getAddonsOptions();

        // Addon doesn't exists
        if (empty($addons[ $addon ])) {
            return false;
        }

        // Addon is disabled
        if (empty($options[ $addon ])) {
            return false;
        }

        // Addon is not allowed
        if (Licenser::getInstance()->getLicensePrice() < $addons[ $addon ]) {
            return false;
        }

        return true;
    }
}
