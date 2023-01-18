<?php $intro_text = Chipmunk\Helpers::get_theme_option('intro_text'); ?>

<?php if (!empty($intro_text)) : ?>
    <div class="l-section l-section--intro">
        <div class="l-container">
            <h2 class="l-section__intro c-heading c-heading--h1">
                <?php echo apply_filters('the_content', $intro_text); ?>
            </h2>
        </div>
    </div>
<?php endif; ?>
