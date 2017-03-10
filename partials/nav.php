<ul class="nav-primary__list">
	<?php $menu_items = chipmunk_get_menu_items( 'nav-primary' ); ?>

	<?php if ( ! empty( $menu_items ) ) : ?>
		<?php foreach ( $menu_items as $menu_item ) : ?>
			<?php if ( $menu_item->menu_item_parent == 0 ) : ?>
				<?php
					// Current Page
					if ( is_page( $menu_item->object_id ) ) {
						$is_active = true;
					}

					// Blog template
					elseif ( get_page_template_slug( $menu_item->object_id ) == 'page-blog.php' && ( is_singular( 'post' ) || ( is_home() && $menu_item->url == get_permalink( get_option( 'page_for_posts' ) ) ) || ( get_queried_object() && get_queried_object()->taxonomy == 'category' ) ) ) {
						$is_active = true;
					}

					// Resources template
					elseif ( get_page_template_slug( $menu_item->object_id ) == 'page-resources.php' && ( is_singular( 'resource' ) ) ) {
						$is_active = true;
					}

					// Collections template
					elseif ( get_page_template_slug( $menu_item->object_id ) == 'page-collections.php' && ( is_tax( 'resource-collection' ) ) ) {
						$is_active = true;
					}

					// Inactive link
					else {
						$is_active = false;
					}
				?>

				<?php $children = array(); ?>

				<?php foreach ( $menu_items as $subitem ) : ?>
					<?php if ( $subitem->menu_item_parent == $menu_item->ID ) : ?>
						<?php $children[] = $subitem; ?>
					<?php endif; ?>
				<?php endforeach; ?>

				<li class="nav-primary__item<?php echo ( $is_active ? ' nav-primary__item_active' : '' ); ?><?php echo ( ! empty( $children ) ? ' dropdown__trigger' : '' ); ?>">
					<a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>

					<?php if ( ! empty( $children ) ) : ?>
						<ul class="dropdown">
							<?php foreach ( $children as $item ) : ?>
								<li class="dropdown__item">
									<a href="<?php echo $item->url; ?>" class="dropdown__link"><?php echo $item->title; ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if ( ! ChipmunkCustomizer::theme_option( 'disable_submissions' ) ) : ?>
		<li class="nav-primary__item hidden-lg">
			<button type="button" class="button button_secondary" data-popup-toggle>
				<?php esc_html_e( 'Submit', 'chipmunk' ); ?>
			</button>
		</li>
	<?php endif; ?>
</ul>
