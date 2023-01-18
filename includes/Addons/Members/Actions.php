<?php

namespace Chipmunk\Addons\Members;

use Chipmunk\Addons\Members\Helpers;

/**
 * AJAX action callbacks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Actions
{
    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        // Handlers for form posting actions
        add_action('login_form_register', [$this, 'do_register_user']);
        add_action('login_form_lostpassword', [$this, 'do_lost_password']);
        add_action('login_form_rp', [$this, 'do_reset_password']);
        add_action('login_form_resetpass', [$this, 'do_reset_password']);

        // Custom user account handles
        add_action('wp_loaded', [$this, 'do_update_user']);
    }

    /**
     * Handles the registration of a new user.
     *
     * Used through the action hook "login_form_register" activated on wp-login.php
     * when accessed through the registration action.
     */
    public function do_register_user()
    {
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $redirect_url = Helpers::get_page_permalink('register');

            if (!get_option('users_can_register')) {
                // Registration closed, display error
                $redirect_url = add_query_arg('errors', 'closed', $redirect_url);
            } elseif (!$this->verify_recaptcha()) {
                // Recaptcha check failed, display error
                $redirect_url = add_query_arg('errors', 'captcha', $redirect_url);
            } else {
                $username = $_POST['username'];
                $email = $_POST['email'];

                $password = esc_attr($_POST['password']);
                $password2 = esc_attr($_POST['password2']);

                if (empty($password) || ($password !== $password2)) {
                    // Password empty or don't match confirmation
                    $redirect_url = add_query_arg('errors', 'password_mismatch', $redirect_url);
                } else {
                    $result = $this->register_user($username, $email, $password);

                    if (is_wp_error($result)) {
                        // Parse errors into a string and append as parameter to redirect
                        $errors = join(',', $result->get_error_codes());
                        $redirect_url = add_query_arg('errors', $errors, $redirect_url);
                    } else {
                        // Success, redirect to login page.
                        $redirect_url = Helpers::get_page_permalink('login');
                        $redirect_url = add_query_arg('registered', true, $redirect_url);

                        // Rewrite rules
                        flush_rewrite_rules();
                    }
                }
            }

            wp_safe_redirect($redirect_url);
            exit;
        }
    }

    /**
     * Initiates password reset.
     */
    public function do_lost_password()
    {
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $result = retrieve_password();

            if (is_wp_error($result)) {
                // Errors found
                $errors = join(',', $result->get_error_codes());
                $redirect_url = Helpers::get_page_permalink('lost_password');
                $redirect_url = add_query_arg('errors', $errors, $redirect_url);
            } else {
                // Email sent
                $redirect_url = Helpers::get_page_permalink('login');
                $redirect_url = add_query_arg('lost_password_sent', true, $redirect_url);
            }

            wp_safe_redirect($redirect_url);
            exit;
        }
    }

    /**
     * Resets the user's password if the password reset form was submitted.
     */
    public function do_reset_password()
    {
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $rp_key = $_REQUEST['rp_key'];
            $rp_login = $_REQUEST['rp_login'];

            $user = check_password_reset_key($rp_key, $rp_login);

            if (!$user || is_wp_error($user)) {
                $redirect_url = Helpers::get_page_permalink('login');
                $redirect_url = add_query_arg('errors', $user->get_error_code(), $redirect_url);

                wp_safe_redirect($redirect_url);
                exit;
            }

            if (isset($_POST['pass1'])) {
                if ($_POST['pass1'] != $_POST['pass2']) {
                    // Passwords don't match
                    $redirect_url = Helpers::get_page_permalink('reset_password');

                    $redirect_url = add_query_arg('key', $rp_key, $redirect_url);
                    $redirect_url = add_query_arg('login', $rp_login, $redirect_url);
                    $redirect_url = add_query_arg('errors', 'reset_password_mismatch', $redirect_url);

                    wp_safe_redirect($redirect_url);
                    exit;
                }

                if (empty($_POST['pass1'])) {
                    // Password is empty
                    $redirect_url = Helpers::get_page_permalink('reset_password');

                    $redirect_url = add_query_arg('key', $rp_key, $redirect_url);
                    $redirect_url = add_query_arg('login', $rp_login, $redirect_url);
                    $redirect_url = add_query_arg('errors', 'reset_password_empty', $redirect_url);

                    wp_safe_redirect($redirect_url);
                    exit;
                }

                // Parameter checks OK, reset password
                reset_password($user, $_POST['pass1']);

                $redirect_url = Helpers::get_page_permalink('login');
                $redirect_url = add_query_arg('password_changed', true, $redirect_url);

                wp_safe_redirect($redirect_url);
                exit;
            }

            exit(__('Invalid request.', 'chipmunk'));
        }
    }

    /**
     * Updates user data & meta values
     */
    public function do_update_user()
    {
        if ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['action']) && $_POST['action'] == 'chipmunk_update_user') {
            if (isset($_POST['user_id'])) {
                $redirect_url = Helpers::get_page_permalink('profile');
                $user_socials = wp_get_user_contact_methods();

                $user_id     = sanitize_text_field($_POST['user_id']);
                $email       = sanitize_text_field(wp_unslash($_POST['email']));
                $first_name  = sanitize_text_field($_POST['first_name']);
                $last_name   = sanitize_text_field($_POST['last_name']);
                $url         = sanitize_text_field($_POST['url']);
                $description = sanitize_text_field($_POST['description']);

                $result = $this->update_user($user_id, $email, $first_name, $last_name, $url, $description);

                if (is_wp_error($result)) {
                    $errors = join(',', $result->get_error_codes());
                    $redirect_url = add_query_arg('errors', $errors, $redirect_url);
                } else {
                    foreach ($user_socials as $social_key => $social_value) {
                        if (isset($_POST[$social_key])) {
                            update_user_meta($user_id, $social_key, sanitize_text_field($_POST[$social_key]));
                        }
                    }

                    $redirect_url = add_query_arg('profile_updated', true, $redirect_url);
                }

                wp_safe_redirect($redirect_url);
                exit;
            }

            exit(__('Invalid request.', 'chipmunk'));
        }
    }

    /**
     * Validates and then completes the new user signup process if all went well.
     *
     * @param string $username      The new user's name
     * @param string $email         The new user's email address
     * @param string $password      The new user's password
     *
     * @return int|WP_Error         The id of the user that was created, or error if failed.
     */
    private function register_user($username, $email, $password)
    {
        $errors = new \WP_Error();

        // Email address is used as both username and email. It is also the only
        // parameter we need to validate
        if (!is_email($email)) {
            $errors->add('email', Helpers::get_error_message('email'));
            return $errors;
        }

        if (email_exists($email)) {
            $errors->add('existing_user_email', Helpers::get_error_message('existing_user_email'));
            return $errors;
        }

        if (username_exists($username)) {
            $errors->add('existing_user_login', Helpers::get_error_message('existing_user_login'));
            return $errors;
        }

        $user_data = [
            'user_email'    => $email,
            'user_login'    => $username,
            'user_pass'     => $password,
        ];

        $user_id = wp_insert_user($user_data);
        // wp_new_user_notification( $user_id, $password );

        return $user_id;
    }

    /**
     * Validates and then completes the user account data
     *
     * @param string $user_id       The user's ID
     * @param string $email         The user's new email address
     * @param string $first_name    The user's new first name
     * @param string $last_name     The user's new last name
     * @param string $url           The user's website URL
     * @param string $description   The user's description
     *
     * @return int|WP_Error         The id of the user that was created, or error if failed.
     */
    private function update_user($user_id, $email, $first_name, $last_name, $url, $description)
    {
        $errors = new \WP_Error();

        // Email address is used as both username and email. It is also the only
        // parameter we need to validate
        if (!is_email($email)) {
            $errors->add('email', Helpers::get_error_message('email'));
            return $errors;
        }

        if (!empty($first_name) || !empty($last_name)) {
            $display_name = join(' ', array_filter([$first_name, $last_name]));
        }

        $user_data = [
            'ID'            => $user_id,
            'user_email'    => $email,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'display_name'  => $display_name,
            'nickname'      => $first_name,
            'user_url'      => $url,
            'description'   => $description,
        ];

        return wp_update_user($user_data);
    }

    /**
     * Checks that the reCAPTCHA parameter sent with the registration
     * request is valid.
     *
     * @return bool True if the CAPTCHA is OK, otherwise false.
     */
    private function verify_recaptcha()
    {
        if (isset($_REQUEST['g-recaptcha-response'])) {
            return \Chipmunk\Helpers::verify_recaptcha($_REQUEST['g-recaptcha-response']);
        }

        return true;
    }
}
