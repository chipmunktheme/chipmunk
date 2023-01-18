<div class="c-popup">
    <div class="c-popup__content" data-popup-content>
        <div class="c-popup__inner">
            <?php Chipmunk\Helpers::get_template_part('sections/submit', ['title' => esc_html__('Submit', 'chipmunk'), 'popup' => true]); ?>
        </div>

        <button class="c-popup__close c-heading--h4" data-popup>
            <?php Chipmunk\Helpers::get_template_part('partials/icon', ['icon' => 'close']); ?>
            <span class="u-hidden-visually"><?php esc_html_e('Close', 'chipmunk'); ?></span>
        </button>
    </div>
</div>
