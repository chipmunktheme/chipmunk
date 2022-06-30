<?php $user = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) ); ?>

<?php if ( ! empty( $user ) ) : ?>
	<?php do_action( 'chipmunk_author_before', $user->ID ); ?>

	<?php $user_meta = array_map( function( $a ) { return $a[0]; }, get_user_meta( $user->ID ) ); ?>
	<?php $user_socials = wp_get_user_contact_methods(); ?>

	<div class="l-section l-section--theme-light" id="author-profile">
		<div class="l-container">
			<div class="l-wrapper">
				<div class="l-component">
					<h1 class="c-heading c-heading--h4">
						<?php printf( apply_filters( 'chipmunk_author_title', esc_html__( '%s', 'chipmunk' ) ), $user->display_name ); ?>
					</h1>
				</div>

				<div class="c-profile l-component">
					<div class="c-profile__avatar">
						<?php echo get_avatar( $user->ID, 128 ); ?>
					</div>

					<div class="c-profile__content">
						<?php if ( ! empty( $user->user_url ) ) : ?>
							<?php $user_meta['description'] = $user_meta['description'] . ' <a href="' . esc_url( $user->user_url ) . '" target="_blank">' . esc_url( $user->user_url ) . '</a>'; ?>
						<?php endif; ?>

						<?php if ( ! empty( $user_meta['description'] ) ) : ?>
							<div class="c-profile__description c-content">
								<?php echo $user_meta['description']; ?>
							</div>
						<?php endif; ?>

						<div class="c-profile__meta">
							<?php $socials_empty = true; ?>

							<?php foreach ( $user_socials as $social_key => $social_value ) : ?>
								<?php if ( ! empty( $user_meta[ $social_key ] ) ) : ?>
									<?php $socials_empty = false; ?>
								<?php endif; ?>
							<?php endforeach; ?>

							<?php if ( ! $socials_empty ) : ?>
								<nav class="c-profile__socials c-menu-socials">
									<ul class="c-menu-socials__list">
										<?php foreach ( $user_socials as $social_key => $social_value ) : ?>
											<?php if ( ! empty( $user_meta[ $social_key ] ) ) : ?>
												<li class="c-menu-socials__item">
													<a href="<?php echo esc_url( $user_meta[ $social_key ] ); ?>" class="c-menu-socials__link" title="<?php echo $social_value; ?>" target="_blank">
														<?php Chipmunk\Helpers::get_template_part( 'partials/icon', [ 'icon' => 'social-' . $social_key ] ); ?>
														<span class="u-hidden-visually"><?php echo $social_value; ?></span>
													</a>
												</li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								</nav>
							<?php endif; ?>

							<ul class="c-profile__stats c-stats">
								<?php $registered = strtotime( $user->user_registered ); ?>

								<?php do_action( 'chipmunk_user_profile_stats_before', $user->ID ); ?>

								<li class="c-stats__item">
									<?php Chipmunk\Helpers::get_template_part( 'partials/icon', [ 'icon' => 'clock' ] ); ?>

									<time datetime="<?php echo date( 'c', $registered ); ?>"><?php printf( esc_html__( 'Joined: %s', 'chipmunk' ), date( get_option( 'date_format' ), $registered ) ); ?></time>
								</li>

								<?php do_action( 'chipmunk_user_profile_stats_after', $user->ID ); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php do_action( 'chipmunk_author_after', $user->ID ); ?>
<?php endif; ?>
