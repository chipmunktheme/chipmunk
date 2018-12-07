<?php $action = 'submit_resource'; ?>

<h4 class="heading heading_xl text_center"><?php esc_html_e( 'Submit', 'chipmunk' ); ?></h4>

<form action="#" class="form loader" novalidate data-validate data-action="<?php echo $action; ?>" data-action-event="submit">
    <p class="form__message heading heading_thin" data-action-message="<?php echo $action; ?>"></p>

    <input type="hidden" name="filter" value="">

    <?php wp_nonce_field( $action, 'nonce', false ); ?>

    <div class="form__content" data-action-element="<?php echo $action; ?>">
        <div class="form__field">
            <div class="form__child">
                <input type="text" name="name" placeholder="<?php esc_attr_e( 'Resource name', 'chipmunk' ); ?>" class="form__input" required>
            </div>

            <div class="form__child">
                <select name="collection" data-placeholder="<?php esc_attr_e( 'Collection', 'chipmunk' ); ?>" data-parsley-errors-container=".collection-errors" data-parsley-group="select" class="form__input custom-select" required>
                    <option value=""><?php esc_html_e( 'Collection', 'chipmunk' ); ?></option>
                    <?php
                        $collections = chipmunk_get_taxonomy_hierarchy( 'resource-collection', array(
                            'hide_empty' => false,
                        ) );
                    ?>

                    <?php if ( ! empty( $collections ) ) : ?>
                        <?php chipmunk_display_terms( $collections ); ?>
                    <?php endif; ?>
                </select>

                <div class="collection-errors"></div>
            </div>
        </div>

        <div class="form__field">
            <div class="form__child">
                <input type="url" name="website" placeholder="<?php esc_attr_e( 'Website URL', 'chipmunk' ); ?>" class="form__input" required>
            </div>

            <div class="form__child">
                <input type="text" name="content" placeholder="<?php esc_attr_e( 'Description', 'chipmunk' ); ?>" class="form__input">
            </div>
        </div>

        <?php if ( ! chipmunk_theme_option( 'disable_submitter_info' ) and ! is_user_logged_in() ) : ?>
            <div class="form__field form__field_separated">
                <div class="form__child">
                    <input type="text" name="submitter_name" placeholder="<?php esc_attr_e( 'Your name', 'chipmunk' ); ?>" class="form__input" required>
                </div>

                <div class="form__child">
                    <input type="email" name="submitter_email" placeholder="<?php esc_attr_e( 'Your email', 'chipmunk' ); ?>" class="form__input" required>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( chipmunk_theme_option( 'submission_consent' ) ) ) : ?>
            <div class="form__field form__field_center form__field_separated">
                <div class="form__child">
                    <?php chipmunk_get_template( 'partials/checkbox', array( 'name' => 'consent', 'label' => chipmunk_theme_option( 'submission_consent' ), 'required' => true ) ); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( chipmunk_theme_option( 'recaptcha_enabled' ) ) and ! is_user_logged_in() ) : ?>
            <div class="form__field form__field_center">
                <div class="g-recaptcha" id="submit-recaptcha"></div>
            </div>
        <?php endif; ?>

        <div class="form__field form__field_center">
            <button type="submit" class="button button_secondary"><?php esc_html_e( 'Submit', 'chipmunk' ); ?></button>
        </div>
    </div>
</form>
