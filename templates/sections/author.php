<?php $user = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) ); ?>

<?php if ( ! empty( $user ) ) : ?>
	<?php do_action( 'chipmunk_author_before', $user->ID ); ?>

	<?php $user_meta = array_map( function( $a ) { return $a[0]; }, get_user_meta( $user->ID ) ); ?>
	<?php $user_socials = wp_get_user_contact_methods(); ?>
	<?php $verified_users = get_field( 'chipmunk_up_verified_users', 'option' ); ?>
	<?php $is_verified = ! empty( $verified_users ) ? ( array_search( $user->ID, array_column( $verified_users, 'ID' ) ) !== false ) : false; ?>

	<div class="section section--theme-light section--compact" id="author-profile">
		<div class="container">
			<div class="row">
				<div class="column column--lg-8">
					<h1 class="profile__title heading heading--md u-verifiable">
						<?php printf( apply_filters( 'chipmunk_author_title', esc_html__( '%s', 'chipmunk' ) ), $user->display_name ); ?>

						<?php if ( $is_verified ) : ?>
							<span title="<?php esc_attr_e( 'Verified', 'chipmunk' ); ?>">
								<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'verified' ) ); ?>
							</span>
						<?php endif; ?>
					</h1>

					<div class="profile">
						<div class="profile__avatar">
							<?php echo get_avatar( $user->ID, 128 ); ?>
						</div>

						<div class="profile__content">
							<?php if ( ! empty( $user->user_url ) ) : ?>
								<?php $user_meta['description'] = $user_meta['description'] . ' <a href="' . esc_url( $user->user_url ) . '" target="_blank">' . esc_url( $user->user_url ) . '</a>'; ?>
							<?php endif; ?>

							<?php if ( ! empty( $user_meta['description'] ) ) : ?>
								<div class="profile__description">
									<?php echo $user_meta['description']; ?>
								</div>
							<?php endif; ?>

							<div class="profile__meta">
								<?php $socials_empty = true; ?>

								<?php foreach ( $user_socials as $social_key => $social_value ) : ?>
									<?php if ( ! empty( $user_meta[ $social_key ] ) ) : ?>
										<?php $socials_empty = false; ?>
									<?php endif; ?>
								<?php endforeach; ?>

								<?php if ( ! $socials_empty ) : ?>
									<nav class="profile__socials nav-socials">
										<ul>
											<?php foreach ( $user_socials as $social_key => $social_value ) : ?>
												<?php if ( ! empty( $user_meta[ $social_key ] ) ) : ?>
													<li class="nav-socials__item">
														<a href="<?php echo esc_url( $user_meta[ $social_key ] ); ?>" class="nav-socials__link" title="<?php echo $social_value; ?>" target="_blank">
															<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'social-' . $social_key ) ); ?>
															<span class="sr-only"><?php echo $social_value; ?></span>
														</a>
													</li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									</nav>
								<?php endif; ?>

								<ul class="profile__stats stats">
									<?php $registered = strtotime( $user->user_registered ); ?>

									<?php do_action( 'chipmunk_user_profile_stats_before', $user->ID ); ?>

									<li class="stats__item" title="<?php esc_attr_e( 'Registered', 'chipmunk' ); ?>: <?php echo date( 'j F Y', $registered ); ?>">
										<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'clock' ) ); ?>

										<time datetime="<?php echo date( 'c', $registered ); ?>"><?php echo date( 'M j, Y', $registered ); ?></time>
									</li>

									<?php do_action( 'chipmunk_user_profile_stats_after', $user->ID ); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php do_action( 'chipmunk_author_after', $user->ID ); ?>
<?php endif; ?>
