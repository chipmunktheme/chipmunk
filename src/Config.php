<?php

namespace Chipmunk;

use MadeByLess\Lessi\Config\ConfigInterface;
use MadeByLess\Lessi\Factory\Singleton;
use MadeByLess\Lessi\Helper\FileTrait;
use MadeByLess\Lessi\Helper\HelperTrait;
use MadeByLess\Lessi\Helper\HookTrait;

/**
 * Provides methods for the getting config options
 */
final class Config extends Singleton implements ConfigInterface
{
    use FileTrait;
    use HelperTrait;
    use HookTrait;

    /**
     * The path to the templates folder
     *
     * @var string
     */
    private $templatesPath = 'templates';

    /**
     * The path to the public folder
     *
     * @var string
     */
    private $publicPath = 'public';

    /**
     * The path to the manifest file
     *
     * @var string
     */
    private $manifestPath = 'manifest.json';

    /**
     * The url of the demo site
     *
     * @var string
     */
    private $demoUrl = 'https://demos.chipmunktheme.com';

    /**
     * The url of the theme changelog
     *
     * @var string
     */
    private $changelogUrl = 'https://chipmunktheme.com/changelog';

    /**
     * The url of the shop site
     *
     * @var string
     */
    private $shopUrl = 'https://chipmunktheme.com';

    /**
     * The ID of the shop item
     *
     * @var string
     */
    private $shopItemId = '893';

    /**
     * The array of plans available for the theme
     *
     * @var array
     */
    private $plans = [
        '1' => 'Basic',
        '2' => 'Plus',
        '3' => 'Pro',
    ];

    /**
     * The array of addons available for the theme
     *
     * @var array
     */
    private $addons = [
        'members' => '3',
        'ratings' => '2',
    ];

    /**
     * The array of social profiles supported
     *
     * @var array
     */
    private $socials = [
        'Facebook',
        'Twitter',
        'Instagram',
        'LinkedIn',
        'Pinterest',
        'YouTube',
        'Vimeo',
        'TikTok',
        'ProductHunt',
        'Twitch',
        'Discord',
        'Email',
    ];

    /**
     * The name of the settings property
     *
     * @var string
     */
    private $settingsName = 'settings';

    /**
     * Mininum required PHP version
     *
     * @var string
     */
    private $minPHPVersion = '7.4';

    /**
     * Mininum required WP version
     *
     * @var string
     */
    private $minWPVersion = '5.4';

    /**
     * The Google API key
     *
     * @var string
     */
    private $googleApiKey = 'AIzaSyBF71G0SfVTAJVZGC5dilfzC1PunP0qAtE';

    /**
     * Method that returns templates path.
     *
     * Used for setting up template paths for Timber views.
     *
     * @return string
     */
    public function getTemplatesPath(): string
    {
        return $this->templatesPath;
    }

    /**
     * Method that returns dist path.
     *
     * Used for enqueueing static resources.
     *
     * @return string
     */
    public function getPublicPath(): string
    {
        return $this->publicPath;
    }

    /**
     * Method that returns manifest file path.
     *
     * Used for reading the production manifest file.
     *
     * @return string
     */
    public function getManifestPath(): string
    {
        return $this->manifestPath;
    }

    /**
     * Method that returns theme demo url.
     *
     * Used for Merlin Theme Wizarf onboarding.
     *
     * @return string
     */
    public function getDemoUrl(): string
    {
        return $this->demoUrl;
    }

    /**
     * Method that returns theme changelog url.
     *
     * Used for linking update nag to the changelog page
     *
     * @return string
     */
    public function getChangelogUrl(): string
    {
        return $this->changelogUrl;
    }

    /**
     * Method that returns theme shop url.
     *
     * Used for linking to the theme shop in various places.
     *
     * @return string
     */
    public function getShopUrl(): string
    {
        return $this->shopUrl;
    }

    /**
     * Method that returns theme shop item id.
     *
     * Used for checking license status and theme updates.
     *
     * @return string
     */
    public function getShopItemId(): string
    {
        return $this->shopItemId;
    }

    /**
     * Method that returns a list of available plans.
     *
     * Used for determining if theme user has access to certain parts of the theme.
     *
     * @return array
     */
    public function getPlans(): array
    {
        return $this->plans;
    }

    /**
     * Method that returns a list of available addons.
     *
     * Used for determining if theme user has access to certain parts of the theme.
     *
     * @return array
     */
    public function getAddons(): array
    {
        return $this->addons;
    }

    /**
     * Method that returns supported social profiles.
     *
     * Used for creating option lists and displaying the list of socials.
     *
     * @return array
     */
    public function getSocials(): array
    {
        return $this->applyFilter('socials', $this->socials);
    }

    /**
     * Method that returns settings name.
     *
     * Used for getting the name of the settings in Customizer.
     *
     * @return string
     */
    public function getSettingsName(): string
    {
        return $this->buildThemeSlug($this->settingsName);
    }

    /**
     * Method that returns minimum required PHP version.
     *
     * Used for checking if environment meets given requirements.
     *
     * @return string
     */
    public function getMinPHPVersion(): string
    {
        return $this->minPHPVersion;
    }

    /**
     * Method that returns minimum required WP version.
     *
     * Used for checking if environment meets given requirements.
     *
     * @return string
     */
    public function getMinWPVersion(): string
    {
        return $this->minWPVersion;
    }

    /**
     * Method that returns Google API key.
     *
     * Used for pulling the list of Google Fonts from their API.
     *
     * @return string
     */
    public function getGoogleApiKey(): string
    {
        return $this->googleApiKey;
    }
}
