<?php $query = chipmunk_get_users(); ?>

<?php if ( ! empty( $query->results ) ) : ?>
	<div class="separator"></div>

	<h4 class="heading heading_md"><?php echo $attributes['title'] ? $attributes['title'] : esc_html__( 'Curators', 'chipmunk' ); ?></h4>

	<div class="row">
		<?php foreach ( $query->results as $user ) : ?>
			<?php $twitter = get_user_meta( $user->ID, 'twitter', true ); ?>
			<?php $description = get_user_meta( $user->ID, 'description', true ); ?>

			<div class="card column column_sm-3 column_md-2 column_lg-4">
				<?php if ( get_avatar( $user->ID ) ) : ?>
					<div class="card__image" style="background-image: url(<?php echo esc_url( get_avatar_url( $user->ID, array( 'size' => 300 ) ) ); ?>)"></div>
				<?php endif; ?>

				<h5 class="card__title"><?php echo esc_html( $user->display_name ); ?></h5>

				<?php if ( ! empty( $description ) ) : ?>
					<p class="card__copy"><?php echo esc_html( chipmunk_truncate_string( $description, 120 ) ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $user->user_url ) ) : ?>
					<div class="card__handle">
						<a href="<?php echo esc_url( $user->user_url ); ?>" target="_blank" rel="nofollow"><?php echo esc_html( $user->user_url ); ?></a>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $twitter ) ) : ?>
					<div class="card__handle">
						<a href="<?php echo esc_url( 'https://twitter.com/' . $twitter ); ?>" target="_blank" rel="nofollow">@<?php echo esc_html( $twitter ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
