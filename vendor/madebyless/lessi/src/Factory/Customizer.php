<?php

namespace MadeByLess\Lessi\Factory;

use Closure;
use Exception;
use WP_Customize_Manager;
use WP_Customize_Panel;
use WP_Customize_Section;

class Customizer
{
    /**
     * Main customize manager object
     *
     * @var WP_Customize_Manager
     */
    private WP_Customize_Manager $customize;

    /**
     * Priority counter
     *
     * @var int
     */
    private int $priorityCounter;

    /**
     * Currently selected panel
     *
     * @var WP_Customize_Panel|null
     */
    private $currentPanel = null;

    /**
     * Currently selected section
     *
     * @var WP_Customize_Section|null
     */
    private $currentSection = null;

    /**
     * Queued control properties
     *
     * @var mixed
     */
    private $queuedControlName = null;
    private $queuedSettingArgumentsArray = [];
    private $queuedControlArgumentsArray = [];
    private $queuedCustomControlClass = null;

    /**
     * Define settings access.
     *
     * @var string
     */
    private string $capability = 'edit_theme_options';

    /**
     * Class constructor
     *
     * @param WP_Customize_Manager $wpCustomize
     */
    public function __construct(WP_Customize_Manager $wpCustomize, int $priorityCounter = 0)
    {
        $this->customize = $wpCustomize;
        $this->priorityCounter = $priorityCounter;
    }

    /**
     * Class destructor
     */
    public function __destruct()
    {
        $this->addQueuedControl();
    }

    /**
     * Initializes new control setting
	 *
	 * @param string $name
	 * @param string $label
	 * @param mixed $customControlClass
     */
    private function initializeNewControl($name, $customControlClass = null)
    {
        if (is_null($this->currentSection)) {
            throw new Exception('You need to add a section before adding a control');
        }

        $this->addQueuedControl();

        $this->queuedControlName = $name;

        if (! is_null($customControlClass)) {
            $this->queuedCustomControlClass = $customControlClass;
        }

        $this->setControlArgument('section', $this->currentSection);
        $this->setControlArgument('priority', $this->priorityCounter++);
    }

    /**
     * Adds queued control setting to the section
     */
    private function addQueuedControl()
    {
        if ($this->hasQueuedControl()) {
            $this->customize->add_setting($this->queuedControlName, $this->queuedSettingArgumentsArray);

            if (! is_null($this->queuedCustomControlClass)) {
                $this->customize->add_control(new $this->queuedCustomControlClass($this->customize, $this->queuedControlName, $this->queuedControlArgumentsArray));
            } else {
                $this->customize->add_control($this->queuedControlName, $this->queuedControlArgumentsArray);
            }
        }

        $this->queuedControlName = null;
        $this->queuedSettingArgumentsArray = [];
        $this->queuedControlArgumentsArray = [];
        $this->queuedCustomControlClass = null;
    }

    /**
     * Checks if there's any queued control to add
     */
    private function hasQueuedControl()
    {
        return ! is_null($this->queuedControlName);
    }

    /**
     * Sets setting argument
     */
    private function setSettingsArgument($key, $value)
    {
        if (! $this->hasQueuedControl()) {
            throw new Exception('There is no queued control');
        }

        $this->queuedSettingArgumentsArray[$key] = $value;
    }

    /**
     * Sets control argument
     */
    private function setControlArgument($key, $value)
    {
        if (! $this->hasQueuedControl()) {
            throw new Exception('There is no queued control');
        }

        $this->queuedControlArgumentsArray[$key] = $value;
    }

    /**
     * Creates a new panel and set it as the current panel
	 *
     * @param string $name Unique ID of this panel
     * @param string $title Title for this panel
     * @param Closure $closure
     */
    public function addPanel($name, $title, Closure $closure = null)
    {
        $this->addQueuedControl();

        $this->customize->add_panel($name, [
            'title' => $title,
            'priority' => $this->priorityCounter++,
			'capability' => $this->capability,
        ]);

        $this->currentPanel = $name;

        if (! is_null($closure)) {
            $closure();
        }
    }

    /**
     * Creates a new section, set it as the current section and add it to the current panel
	 *
     * @param string $name Unique ID of this section
     * @param string $title Title for this section
     * @param Closure $closure
     */
    public function addSection($name, $title, Closure $closure = null)
    {
        $this->addQueuedControl();

		$this->customize->add_section($name, [
			'title' => $title,
			'panel' => $this->currentPanel,
			'priority' => $this->priorityCounter++,
			'capability' => $this->capability,
		]);

        $this->currentSection = $name;

        if (! is_null($closure)) {
            $closure();
        }
    }

    /**
     * Adds a single-line text box to the current section
	 *
     * @param string $name Name of this control
     * @param bool $allowHtml
     */
    public function addText($name, $allowHtml = false)
    {
        $this->initializeNewControl($name);
        $this->setControlArgument('type', 'text');

        if ($allowHtml) {
            $this->setSanitizeCallback('wp_kses_post');
        }

        return $this;
    }

    /**
     * Adds a multi-line text box to the current section
	 *
     * @param string $name Name of this control
     * @param bool $allowHtml
     */
    public function addTextarea($name, $allowHtml = false)
    {
        $this->initializeNewControl($name);
        $this->setControlArgument('type', 'textarea');

        if ($allowHtml) {
            $this->setSanitizeCallback('wp_kses_post');
        }

        return $this;
    }

    /**
     * Adds a text box to the current section that uses 'esc_url_raw' as sanitize callback
	 *
     * @param string $name Name of this control
     */
    public function addUrl($name)
    {
        $this->initializeNewControl($name);

        $this->setSanitizeCallback('esc_url_raw');

        return $this;
    }

    /**
     * Adds a checkbox input to the current section
     * @param string $name Name of this control
     */
    public function addCheckbox($name)
    {
        $this->initializeNewControl($name);

        $this->setControlArgument('type', 'checkbox');
        $this->setDefault(false);

        return $this;
    }

    /**
     * Adds a radio input to the current section
     * @param string $name Name of this control
     */
    public function addRadio($name)
    {
        $this->initializeNewControl($name);

        $this->setControlArgument('type', 'radio');
        $this->setDefault(false);

        return $this;
    }

    /**
     * Adds a select input to the current section
     * @param string $name Name of this control
     */
    public function addSelect($name)
    {
        $this->initializeNewControl($name);

        $this->setControlArgument('type', 'select');
        $this->setDefault(false);

        return $this;
    }

    /**
     * Adds a number input to the current section
     * @param string $name Name of this control
     */
    public function addNumber($name)
    {
        $this->initializeNewControl($name);

        $this->setControlArgument('type', 'number');

        return $this;
    }

    /**
     * Adds a range input to the current section
     * @param string $name Name of this control
     */
    public function addRange($name)
    {
        $this->initializeNewControl($name);

        $this->setControlArgument('type', 'range');

        return $this;
    }

    /**
     * Adds an color control to the current section that saves the color HEX
	 *
     * @param string $name Name of this control
     */
    public function addColor($name)
    {
        $this->initializeNewControl($name, 'WP_Customize_Color_Control');

        $this->setControlArgument('type', 'color');

        return $this;
    }

    /**
     * Adds an image control to the current section that saves the image url
	 *
     * @param string $name Name of this control
     */
    public function addImageUrl($name)
    {
        $this->initializeNewControl($name, 'WP_Customize_Image_Control');

        $this->setSanitizeCallback('esc_url_raw');

        return $this;
    }

    /**
     * Adds an image control to the current section that saves the image id
	 *
     * @param string $name Name of this control
     */
    public function addImageId($name)
    {
        $this->initializeNewControl($name, 'WP_Customize_Media_Control');

        $this->setControlArgument('mime_type', 'image');

        return $this;
    }

    /**
     * Sets the label of the currently queued control
	 *
     * @param string $string Label
     */
    public function setLabel($string)
    {
        $this->setControlArgument('label', $string);

        return $this;
    }

    /**
     * Sets the description of the currently queued control
	 *
     * @param string $string Description
     */
    public function setDescription($string)
    {
        $this->setControlArgument('description', $string);

        return $this;
    }

    /**
     * Sets the choices of the currently queued radio/select control
	 *
     * @param array $array Choices
     */
    public function setChoices($array)
    {
        $this->setControlArgument('choices', $array);

        return $this;
    }

    /**
     * Sets the input args of the currently queued control
	 *
     * @param array $array Input attributes
     */
    public function setInputAttrs($array)
    {
        $this->setControlArgument('input_attrs', $array);

        return $this;
    }

    /**
     * Sets the default value of the currently queued control
	 *
     * @param string $string Default value
     */
    public function setDefault($string)
    {
        $this->setSettingsArgument('default', $string);

        return $this;
    }

    /**
     * Sets the transport of the currently queued control
	 *
     * @param string $string Transport
     */
    public function setTransport($string)
    {
        $this->setSettingsArgument('transport', $string);

        return $this;
    }

    /**
     * Sets the capability of the currently queued control
	 *
     * @param string $string Capability
     */
    public function setCapability($string)
    {
        $this->setSettingsArgument('capability', $string);

        return $this;
    }

    /**
     * Sets the sanitize callback of the currently queued control
	 *
     * @param string $string Sanitize callback
     */
    public function setSanitizeCallback($string)
    {
        $this->setSettingsArgument('sanitize_callback', $string);

        return $this;
    }
}
