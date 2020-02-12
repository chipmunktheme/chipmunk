<?php $providers = array(
	array(
		'name' => 'Twitter',
		'href' => 'https://twitter.com/share?url=%url%&amp;text=%title%',
	),
	array(
		'name' => 'Facebook',
		'href' => 'https://facebook.com/sharer.php?u=%url%&amp;t=%title%+%url%',
	),
	array(
		'name' => 'Pinterest',
		'href' => 'https://pinterest.com/pin/create/button/?url=%url%&media=%image%&description=%title%',
	),
	array(
		'name' => 'Email',
		'href' => 'mailto:?subject=%title%&body=%url%',
	),
); ?>

<nav class="nav-socials">
	<h5 class="nav-socials__title"><?php esc_html_e( 'Share', 'chipmunk' ); ?></h5>

	<ul>
		<?php foreach ( $providers as $provider ) : ?>
			<li class="nav-socials__item">
				<?php
				$slug = strtolower( $provider['name'] );

				$link = strtr( $provider['href'], array(
					'%url%'   => esc_url( get_permalink() ),
					'%image%' => esc_url( get_the_post_thumbnail_url() ),
					'%title%' => urlencode( get_the_title() ),
				) );
				?>

				<a href="<?php echo $link; ?>" class="nav-socials__link" title="<?php echo $provider['name']; ?>" target="_blank">
					<?php chipmunk_get_template( 'partials/icon', array( 'icon' => "social-{$slug}" ) ); ?>
					<span class="sr-only"><?php echo $provider['name']; ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
<!-- /.nav-socials -->
