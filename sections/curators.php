<?php $query = chipmunk_get_users(); ?>

<?php if ( ! empty( $query->results ) ) : ?>
	<h2 class="heading heading_md"><?php esc_html_e( 'Curators', 'chipmunk' ); ?></h2>

	<div class="row">
		<?php foreach ( $query->results as $user ) : ?>
			<?php $twitter = get_user_meta( $user->ID, 'twitter', true ); ?>
			<?php $description = get_user_meta( $user->ID, 'description', true ); ?>

			<div class="card column column_md-3 column_lg-4">
				<?php if ( get_avatar( $user->ID ) ) : ?>
					<div class="card__image" style="background-image: url(<?php echo esc_url( get_avatar_url( $user->ID, array( 'size' => 300 ) ) ); ?>)"></div>
				<?php endif; ?>

				<h3 class="card__title"><?php echo esc_html( $user->display_name ); ?></h3>

				<?php if ( ! empty( $description ) ) : ?>
					<p class="card__copy"><?php echo esc_html( chipmunk_truncate_string( $description, 120 ) ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $twitter ) ) : ?>
					<a href="<?php echo esc_url( 'https://twitter.com/' . $twitter ); ?>" target="_blank" rel="nofollow" class="card__handle">@<?php echo esc_html( $twitter ); ?></a>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
