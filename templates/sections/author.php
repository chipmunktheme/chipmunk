<?php global $customizer; ?>
<?php $user = get_user_by( 'slug', get_query_var( 'author_name' ) ); ?>

<?php if ( ! empty( $user ) ) : ?>
	<?php $user_meta = array_map( function( $a ) { return $a[0]; }, get_user_meta( $user->ID ) ); ?>
	<?php $user_socials = wp_get_user_contact_methods(); ?>

	<div class="section section--theme-light section--compact" id="author-profile">
		<div class="container">
			<div class="row">
				<div class="column column--lg-8">
					<h1 class="profile__title heading heading--md"><?php printf( apply_filters( 'chipmunk_author_title', esc_html__( '%s\'s Profile', 'chipmunk' ) ), $user->display_name ); ?></h1>

					<div class="profile">
						<div class="profile__avatar">
							<?php echo get_avatar( $user->ID, 128 ); ?>
						</div>

						<div class="profile__content">
							<?php if ( ! empty( $user_meta['description'] ) ) : ?>
								<div class="profile__description">
									<?php echo esc_html( $user_meta['description'] ); ?>
								</div>
							<?php endif; ?>

							<nav class="profile__socials nav-socials">
								<ul>
									<?php if ( ! empty( $user->user_url ) ) : ?>
										<li class="nav-socials__item">
											<a href="<?php echo esc_url( $user->user_url ); ?>" class="nav-socials__link" title="<?php esc_attr_e( 'Website', 'chipmunk' ); ?>" target="_blank">
												<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'link' ) ); ?>
												<span class="sr-only"><?php esc_attr_e( 'Website', 'chipmunk' ); ?></span>
											</a>
										</li>
									<?php endif; ?>

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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
