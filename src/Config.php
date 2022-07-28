<?php

namespace Chipmunk;

use Timber\Theme;
use Piotrkulpinski\Framework\Helper\FileTrait;
use Piotrkulpinski\Framework\Helper\HelperTrait;
use Piotrkulpinski\Framework\Helper\HookTrait;

/**
 * Provides methods for the getting config options
 */
final class Config {

	use FileTrait;
	use HelperTrait;
	use HookTrait;

	/**
	 * @var Config The one true Config
	 */
	private static $instance;

	/**
	 * @var string The name of the theme
	 */
	private $name = 'Chipmunk';

	/**
	 * @var string The author of the theme
	 */
	private $author = 'Made by Less';

	/**
	 * @var string The path to the templates folder
	 */
	private $templatesPath = 'templates';

	/**
	 * @var string The path to the dist folder
	 */
	private $distPath = 'resources/output';

	/**
	 * @var string The path to the assets folder
	 */
	private $assetsPath = 'assets';

	/**
	 * @var string The path to the manifest file
	 */
	private $manifestPath = 'manifest.json';

	/**
	 * @var string The path to the manifest development file
	 */
	private $manifestDevPath = 'manifest.json';

	/**
	 * @var string The url of the demo site
	 */
	private $demoUrl = 'https://demos.chipmunktheme.com';

	/**
	 * @var string The url of the shop site
	 */
	private $shopUrl = 'https://chipmunktheme.com';

	/**
	 * @var string The ID of the shop item
	 */
	private $shopItemId = '893';

	/**
	 * @var array The array of plans available for the theme
	 */
	private $plans = [
		'1' => 'Basic',
		'2' => 'Plus',
		'3' => 'Pro',
	];

	/**
	 * @var array The array of social profiles supported
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
	 * @var string The Google API key
	 */
	private $googleApiKey = 'AIzaSyBF71G0SfVTAJVZGC5dilfzC1PunP0qAtE';

	/**
	 * @var string The name of the settings property
	 */
	private $settingsName = 'settings';

	/**
	 * @var string Mininum required PHP version
	 */
	private $minPHPVersion = '7.4';

	/**
	 * @var string Mininum required WP version
	 */
	private $minWPVersion = '5.4';

	/**
	 * Insures that only one instance of Config exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @return Config
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Config ) ) {
			self::$instance = new Config();
		}

		return self::$instance;
	}

	/**
	 * Method that returns project name.
	 *
	 * Generally used for naming assets handlers, languages, etc.
	 *
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * Method that returns project slug.
	 *
	 * Generally used for naming settings, customizer options etc.
	 *
	 * @return string
	 */
	public function getSlug(): string {
		return sanitize_title( $this->getName() );
	}

	/**
	 * Method that returns project version.
	 *
	 * Generally used for versioning asset handlers while enqueueing them.
	 *
	 * @return string
	 */
	public function getVersion(): string {
		return ( new Theme() )->version;
	}

	/**
	 * Method that returns project author.
	 *
	 * Used for displaying author on theme settings.
	 *
	 * @return string
	 */
	public function getAuthor(): string {
		return $this->author;
	}

	/**
	 * Method that returns templates path.
	 *
	 * Used for setting up template paths for Timber views.
	 *
	 * @return string
	 */
	public function getTemplatesPath(): string {
		return $this->templatesPath;
	}

	/**
	 * Method that returns dist path.
	 *
	 * Used for enqueueing static resources.
	 *
	 * @return string
	 */
	public function getDistPath(): string {
		return $this->distPath;
	}

	/**
	 * Method that returns assets path.
	 *
	 * Used for displaying static resources like images, fonts etc.
	 *
	 * @return string
	 */
	public function getAssetsPath(): string {
		return $this->getPath( $this->getDistPath(), $this->assetsPath );
	}

	/**
	 * Method that returns manifest file path.
	 *
	 * Used for reading the production manifest file.
	 *
	 * @return string
	 */
	public function getManifestPath(): string {
		return $this->getPath( $this->getDistPath(), $this->manifestPath );
	}

	/**
	 * Method that returns manifest dev file path.
	 *
	 * Used for reading the development manifest file.
	 *
	 * @return string
	 */
	public function getManifestDevPath(): string {
		return $this->getPath( $this->getDistPath(), $this->manifestDevPath );
	}

	/**
	 * Method that returns theme demo url.
	 *
	 * Used for Merlin Theme Wizarf onboarding.
	 *
	 * @return string
	 */
	public function getDemoUrl(): string {
		return $this->demoUrl;
	}

	/**
	 * Method that returns theme shop url.
	 *
	 * Used for linking to the theme shop in various places.
	 *
	 * @return string
	 */
	public function getShopUrl(): string {
		return $this->shopUrl;
	}

	/**
	 * Method that returns theme shop item id.
	 *
	 * Used for checking license status and theme updates.
	 *
	 * @return string
	 */
	public function getShopItemId(): string {
		return $this->shopItemId;
	}

	/**
	 * Method that returns project author.
	 *
	 * Used for determining theme user access to certain parts of the theme.
	 *
	 * @return array
	 */
	public function getPlans(): array {
		return $this->plans;
	}

	/**
	 * Method that returns supported social profiles.
	 *
	 * Used for creating option lists and displaying the list of socials.
	 *
	 * @return array
	 */
	public function getSocials(): array {
		return $this->applyFilter( 'socials', $this->socials );
	}

	/**
	 * Method that returns Google API key.
	 *
	 * Used for pulling the list of Google Fonts from their API.
	 *
	 * @return string
	 */
	public function getGoogleApiKey(): string {
		return $this->googleApiKey;
	}

	/**
	 * Method that returns settings name.
	 *
	 * Used for getting the name of the settings in Customizer.
	 *
	 * @return string
	 */
	public function getSettingsName(): string {
		return $this->getThemeSlug( $this->settingsName );
	}

	/**
	 * Method that returns minimum required PHP version.
	 *
	 * Used for checking if environment meets given requirements.
	 *
	 * @return string
	 */
	public function getMinPHPVersion(): string {
		return $this->minPHPVersion;
	}

	/**
	 * Method that returns minimum required WP version.
	 *
	 * Used for checking if environment meets given requirements.
	 *
	 * @return string
	 */
	public function getMinWPVersion(): string {
		return $this->minWPVersion;
	}
}

/**
 * The main function responsible for returning the one true Config
 * Instance to functions everywhere.
 *
 * @return Config
 */
function config() {
	return Config::instance();
}
