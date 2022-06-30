<?php $providers = [
	[
		'name' => 'Facebook',
		'href' => 'https://facebook.com/sharer.php?u=%url%&amp;t=%title%+%url%',
	],
	[
		'name' => 'Twitter',
		'href' => 'https://twitter.com/share?url=%url%&amp;text=%title%',
	],
	[
		'name' => 'Pinterest',
		'href' => 'https://pinterest.com/pin/create/button/?url=%url%&media=%image%&description=%title%',
	],
	[
		'name' => 'Email',
		'href' => 'mailto:?subject=%title%&body=%url%',
	],
]; ?>

<nav class="c-menu-socials">
	<h5 class="c-menu-socials__title"><?php esc_html_e( 'Share', 'chipmunk' ); ?></h5>

	<ul class="c-menu-socials__list">
		<?php foreach ( $providers as $provider ) : ?>
			<li class="c-menu-socials__item">
				<?php
				$slug = strtolower( $provider['name'] );

				$link = strtr( $provider['href'], [
					'%url%'   => esc_url( get_permalink() ),
					'%image%' => esc_url( get_the_post_thumbnail_url() ),
					'%title%' => urlencode( get_the_title() ),
				] );
				?>

				<a href="<?php echo $link; ?>" class="c-menu-socials__link" title="<?php echo $provider['name']; ?>" target="_blank">
					<?php Chipmunk\Helpers::get_template_part( 'partials/icon', [ 'icon' => "social-{$slug}" ] ); ?>
					<span class="u-hidden-visually"><?php echo $provider['name']; ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
