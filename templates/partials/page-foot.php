<footer class="c-page-foot l-section l-section--compact">
    <div class="l-container">
        <div class="c-page-foot__inner">
            <p class="c-page-foot__copy">
                <?php echo do_shortcode(wp_kses_post(Chipmunk\Helpers::get_theme_option('copyright_text'))); ?>
            </p>

            <?php if (!Chipmunk\Helpers::get_theme_option('disable_credits')) : ?>
                <a href="<?php echo esc_url(Chipmunk\Helpers::render_external_link('https://chipmunktheme.com', true)); ?>" class="c-page-foot__credits" target="_blank" title="<?php esc_attr_e('Chipmunk WordPress Theme', 'chipmunk'); ?>">
                    <?php esc_html_e('Made with Chipmunk', 'chipmunk'); ?>
                    <?php echo Chipmunk\Helpers::get_svg_content(Chipmunk\Assets::asset_path('images/logo.svg')); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</footer>