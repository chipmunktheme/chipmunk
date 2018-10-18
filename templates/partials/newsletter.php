<?php if ( ! chipmunk_theme_option( 'disable_newsletter' ) and $action = esc_url( chipmunk_theme_option( 'newsletter_action' ) ) ) : ?>
    <div class="section section_theme-primary text_center">
        <div class="container">
            <div class="column column_lg-8 column_lg-offset-2">
                <h4 class="heading heading_xl"><?php esc_html_e( 'Newsletter', 'chipmunk' ); ?></h4>
                <p class="heading heading_thin"><?php echo esc_html( chipmunk_theme_option( 'newsletter_tagline' ) ); ?></p>
            </div>

            <div class="row">
                <form action="<?php echo stripslashes( trim( $action, '" ' ) ); ?>" method="post" class="form form_compact column column_sm-4 column_sm-offset-1 column_md-4 column_md-offset-1 column_lg-6 column_lg-offset-3" target="_blank" novalidate data-validate>
                    <div class="form__field">
                        <input type="email" name="<?php echo strpos( $action, 'list-manage.com' ) !== false ? 'MERGE0' : 'email'; ?>" placeholder="<?php esc_html_e( 'Email address', 'chipmunk' ); ?>" required>
                    </div>

                    <?php if ( ! empty( chipmunk_theme_option( 'newsletter_consent' ) ) ) : ?>
                        <div class="form__field" data-consent>
                            <?php chipmunk_get_template( 'partials/checkbox', array( 'name' => 'consent', 'label' => chipmunk_theme_option( 'newsletter_consent' ), 'required' => true ) ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form__field form__field_center">
                        <button type="submit" class="button button_secondary"><?php esc_html_e( 'Join now', 'chipmunk' ); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.section -->
<?php endif; ?>
