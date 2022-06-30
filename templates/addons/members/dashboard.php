</div><?php /* End of .c-entry__content class */ ?>

<?php if ( $show_title ) : ?>
	<h2 class="c-heading c-heading--h2"><?php esc_html_e( 'Dashboard', 'chipmunk' ); ?></h2>
<?php endif; ?>

<?php if ( ! empty( $blocker ) ) : ?>
	<?php Chipmunk\Helpers::get_template_part( 'addons/members/partials/errors', [ 'errors' => [ $blocker ] ], true ); ?>
<?php else : ?>
	<?php
		$first_tab = Chipmunk\Helpers::get_theme_option( 'disable_upvotes' ) ? ( Chipmunk\Helpers::get_theme_option( 'disable_bookmarks' ) ? 'submitted' : 'bookmarked' ) : 'upvoted';
		$current_tab = isset( $_GET['tab'] ) ? esc_attr( $_GET['tab'] ) : $first_tab;
		$dashboard_link = Chipmunk\Addons\Members\Helpers::get_page_permalink( 'dashboard' );
	?>

	<div class="c-tabs" data-tabs role="tablist">
		<div class="l-component l-header">
			<div class="c-tabs__title c-heading c-heading--h6">
				<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_upvotes' ) ) : ?>
					<a href="<?php echo esc_url( add_query_arg( 'tab', 'upvoted', $dashboard_link ) ); ?>" class="c-heading__link<?php echo ( $current_tab == 'upvoted' ? ' is-active' : '' ); ?>">
						<?php esc_html_e( 'Upvoted', 'chipmunk' ); ?>
					</a>
				<?php endif; ?>

				<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_bookmarks' ) ) : ?>
					<a href="<?php echo esc_url( add_query_arg( 'tab', 'bookmarked', $dashboard_link ) ); ?>" class="c-heading__link<?php echo ( $current_tab == 'bookmarked' ? ' is-active' : '' ); ?>">
						<?php esc_html_e( 'Bookmarked', 'chipmunk' ); ?>
					</a>
				<?php endif; ?>

				<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_submissions' ) ) : ?>
					<a href="<?php echo esc_url( add_query_arg( 'tab', 'submitted', $dashboard_link ) ); ?>" class="c-heading__link<?php echo ( $current_tab == 'submitted' ? ' is-active' : '' ); ?>">
						<?php esc_html_e( 'Submitted', 'chipmunk' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_submissions' ) ) : ?>
				<div class="c-filter__group u-visible-md-flex">
					<?php Chipmunk\Helpers::get_template_part( 'partials/submit-button', [ 'class' => 'c-button c-button--primary' ] ); ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_upvotes' ) && $current_tab == 'upvoted' ) : ?>
			<?php echo Chipmunk\Helpers::get_template_part( 'addons/members/dashboard/upvoted' ); ?>
		<?php endif; ?>

		<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_bookmarks' ) && $current_tab == 'bookmarked' ) : ?>
			<?php echo Chipmunk\Helpers::get_template_part( 'addons/members/dashboard/bookmarked' ); ?>
		<?php endif; ?>

		<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_submissions' ) && $current_tab == 'submitted' ) : ?>
			<?php echo Chipmunk\Helpers::get_template_part( 'addons/members/dashboard/submitted' ); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>

<div class="c-entry__content c-content c-content--type"><?php /* Beginning of .c-entry__content class */ ?>
