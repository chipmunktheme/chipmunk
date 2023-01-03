<?php

namespace Chipmunk\ThirdParty;

use MadeByLess\Lessi\Helper\FileTrait;
use Chipmunk\Theme;

/**
 * Configure ACF plugin
 */
class ACF extends Theme
{
    use FileTrait;

    /**
     * ACF directory path
     *
     * @var string
     */
    private string $path = 'vendor/advanced-custom-fields/advanced-custom-fields-pro';

    /**
     * Class constructor.
     */
    public function __construct()
    {
    }

    /**
     * Hooks methods of this object into the WordPress ecosystem.
     */
    public function initialize()
    {
        // Include the ACF plugin.
        include_once $this->getTemplatePath($this->path, 'acf.php');

        add_filter('acf/init', [ $this, 'registerFields' ]);
        add_filter('acf/settings/url', [ $this, 'setSettingsUrl' ]);
        add_filter('acf/settings/show_admin', [ $this, 'setSettingsShowAdmin' ]);
        add_filter('acf/settings/google_api_key', [ $this, 'setSettingsGoogleApiKey' ]);
    }

    /**
     * Registers the proper custom fields via ACF
     *
     * @see https://advancedcustomfields.com/resources/acf-init/
     */
    public function registerFields()
    {
        $groups = [

            // Resource
            [
                'key'      => 'resource',
                'title'    => __('Resource', 'chipmunk'),

                'location' => [
                    [
                        [
                            'param'    => 'post_type',
                            'operator' => '==',
                            'value'    => 'resource',
                        ],
                    ],
                ],

                'fields'   => [
                    [
                        'key'   => 'is_featured',
                        'label' => __('Featured on homepage', 'chipmunk'),
                        'type'  => 'true_false',
                        'ui'    => 1,
                        'width' => '50',
                    ],
                    [
                        'key'          => 'links',
                        'label'        => __('Links', 'chipmunk'),
                        'type'         => 'repeater',
                        'width'        => '50',
                        'layout'       => 'table',
                        'button_label' => __('Add link', 'chipmunk'),
                        'sub_fields'   => [
                            [
                                'key'      => 'link',
                                'label'    => __('Link', 'chipmunk'),
                                'type'     => 'link',
                                'required' => 1,
                            ],
                        ],
                    ],
                    [
                        'key'          => 'website',
                        'label'        => __('Website', 'chipmunk'),
                        'type'         => 'text',
                        'width'        => '50',
                        'instructions' => __('Deprecated. Please use "Links" functionality above.', 'chipmunk'),
                    ],
                    [
                        'key'          => 'submitter',
                        'label'        => __('Submitter', 'chipmunk'),
                        'type'         => 'text',
                        'width'        => '50',
                        'instructions' => __('Read only, will contain the email of resource submitter.', 'chipmunk'),
                        'readonly'     => 1,
                    ],
                ],
            ],

            // Collection
            [
                'key'      => 'collection',
                'title'    => __('Collection', 'chipmunk'),

                'location' => [
                    [
                        [
                            'param'    => 'taxonomy',
                            'operator' => '==',
                            'value'    => 'resource-collection',
                        ],
                    ],
                ],

                'fields'   => [
                    [
                        'key'           => 'image',
                        'label'         => __('Image', 'chipmunk'),
                        'type'          => 'image',
                        'return_format' => 'id',
                    ],
                ],
            ],

            // Page/Post
            [
                'key'      => 'page',
                'title'    => __('Page', 'chipmunk'),
                'position' => 'side',

                'location' => [
                    [
                        [
                            'param'    => 'post_type',
                            'operator' => '==',
                            'value'    => 'page',
                        ],
                    ],
                    [
                        [
                            'param'    => 'post_type',
                            'operator' => '==',
                            'value'    => 'post',
                        ],
                    ],
                ],

                'fields'   => [
                    [
                        'key'           => 'content_width',
                        'label'         => __('Content width', 'chipmunk'),
                        'type'          => 'select',
                        'choices'       => [
                            '6'  => sprintf(__('Narrow (%d%%)', 'chipmunk'), ( 6 / 12 * 100 )),
                            '8'  => sprintf(__('Normal (%d%%)', 'chipmunk'), ( 8 / 12 * 100 )),
                            '10' => sprintf(__('Wide (%d%%)', 'chipmunk'), ( 10 / 12 * 100 )),
                            '12' => sprintf(__('Full (%d%%)', 'chipmunk'), ( 12 / 12 * 100 )),
                        ],
                        'default_value' => $this->getOption('content_width'),
                        'required'      => true,
                        'ui'            => true,
                    ],
                ],
            ],
        ];

        foreach ($groups as $group) {
            // Normalize group fields
            array_walk(
                $group['fields'],
                [ $this, 'normalizeFields' ],
                [
                    'group'      => $group,
                    'prefix_key' => true,
                ]
            );

            // Register ACF Group
            acf_add_local_field_group($group);
        }
    }

    /**
     * Normalizes the field object to be used for registering.
     *
     * @param array $field
     * @param mixed $key
     * @param array $params
     */
    private function normalizeFields(array &$field, $key, array $params)
    {
        // Generate proper field key
        $key = isset($params['prefix_key']) && isset($params['group'])
        ? $this->buildPrefixedThemeSlug([ $params['group']['key'], $field['key'] ])
        : $this->buildPrefixedThemeSlug($field['key']);

        // Normalized field
        $normField = [
            'key'   => $key,
            'name'  => $key,
            'label' => $field['label'],
            'type'  => $field['type'],
        ];

        $values = [
            'choices',
            'required',
            'readonly',
            'instructions',
            'ui',
            'layout',
            'button_label',
            'return_format',
            'preview_size',
            'default_value',
        ];

        foreach ($values as $value) {
            if (isset($field[ $value ])) {
                $normField[ $value ] = $field[ $value ];
            }
        }

        if (isset($field['width'])) {
            $normField['wrapper'] = [ 'width' => $field['width'] ];
        }

        if (isset($field['sub_fields'])) {
            // Normalize sub-fields
            array_walk($field['sub_fields'], [ $this, 'normalizeFields' ], [ 'group' => $params['group'] ]);

            $normField['sub_fields'] = $field['sub_fields'];
        }

        // Alter the original field
        $field = $normField;
    }

    /**
     * Set the url setting to fix incorrect asset URLs.
     *
     * @see https://www.advancedcustomfields.com/resources/acf-settings/
     *
     * @return string
     */
    public function setSettingsUrl(string $url): string
    {
        return $this->getTemplateUrl($this->path);
    }

    /**
     * Hide the ACF admin menu item.
     *
     * @see https://www.advancedcustomfields.com/resources/acf-settings/
     *
     * @return bool
     */
    public function setSettingsShowAdmin(bool $showAdmin): bool
    {
        return false;
    }

    /**
     * Set the Google API Key for ACF
     *
     * @see https://www.advancedcustomfields.com/resources/acf-settings/
     *
     * @param string $apiKey
     *
     * @return string
     */
    public function setSettingsGoogleApiKey(string $apiKey): string
    {
        return config()->getGoogleApiKey();
    }
}
