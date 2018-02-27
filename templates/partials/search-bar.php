<aside class="search-bar">
	<div class="container">
		<div class="search-bar__inner">
			<form action="<?php echo esc_url( home_url( '/', 'relative' ) ); ?>" method="get" class="search-bar__form" role="search" novalidate autocomplete="off">
				<button type="submit" class="search-bar__icon"><i class="icon icon_search"></i></button>
				<input type="search" name="s" placeholder="<?php esc_attr_e( 'Search query...', 'chipmunk' ); ?>" value="<?php echo get_search_query(); ?>" required minlength="3">
			</form>

			<button type="button" class="search-bar__close" data-toggle="search">
				<i class="icon icon_close" aria-hidden="true"></i>
				<span class="sr-only"><?php esc_html_e( 'Close', 'chipmunk' ); ?></span>
			</button>
		</div>
		<!-- /.search-bar__inner -->
	</div>
</aside>
<!-- /.search-bar -->
