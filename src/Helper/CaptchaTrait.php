<?php

namespace Chipmunk\Helper;

use MadeByLess\Lessi\Helper\HelperTrait;

/**
 * Provides methods related to addons
 */
trait CaptchaTrait
{
    use HelperTrait;

    /**
     * Checks that the reCAPTCHA parameter sent with the registration
     * request is valid.
     *
     * @param string $response Recaptcha response
     *
     * @return bool True if the CAPTCHA is OK, otherwise false.
     */
    public function verifyRecaptcha(string $response): bool
    {
        $enabled   = $this->getOption('recaptcha_enabled');
        $siteKey   = $this->getOption('recaptcha_site_key');
        $secretKey = $this->getOption('recaptcha_secret_key');

        // Verify if user is logged in
        if (is_user_logged_in()) {
            return true;
        }

        // Verify if recaptcha is disabled
        if (empty($enabled) or empty($siteKey)) {
            return true;
        }

        if (empty($response)) {
            return false;
        }

        if (! empty($secretKey)) {
            // Verify the captcha response from Google
            $remoteResponse = wp_remote_post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'body' => [
                        'secret'   => $secretKey,
                        'response' => $response,
                    ],
                ]
            );

            if ($this->isValidResponse($remoteResponse)) {
                $remoteResponse = json_decode(wp_remote_retrieve_body($remoteResponse));
                return $remoteResponse->success;
            }

            return false;
        }

        return true;
    }
}
