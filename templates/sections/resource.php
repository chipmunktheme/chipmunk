<?php $resource_website = get_post_meta( get_the_ID(), '_' . THEME_SLUG . '_resource_website', true ); ?>
<?php $content = is_search() ? chipmunk_truncate_string( get_the_excerpt(), 120 ) : get_the_content(); ?>
<?php $tags = wp_get_post_terms( get_the_ID(), 'resource-tag' ); ?>

<div class="section<?php echo ( ! $wp_query->current_post or $wp_query->current_post % 2 == 0 ) ? ' section_theme-light' : ''; ?>">
	<div class="container">
		<article class="resource row">
			<div class="resource__content column column_lg-6">
				<ul class="resource__stats stats">
					<?php
						$collections_args = array(
							'display'  => true,
							'type'     => 'link',
							'quantity' => 1,
						);

						include locate_template( 'templates/partials/post-stats.php' );
					?>
				</ul>

				<div class="resource__info">
					<?php echo chipmunk_conditional_markup( is_single(), 'h1', 'h2', 'resource__title heading heading_lg', is_single() ? get_the_title() : '<a href="' . esc_url( get_the_permalink() ) . '">' . get_the_title() . '</a>' ); ?>

					<?php if ( ! empty( $content ) && ( is_search() || ! chipmunk_theme_option( 'display_resource_content_separated' ) ) ) : ?>
						<div class="resource__description"><?php echo wp_kses_post( wpautop( do_shortcode( $content ) ) ); ?></div>
					<?php endif; ?>

					<?php if ( ! empty( $tags ) && ! chipmunk_theme_option( 'disable_resource_tags' ) ) : ?>
						<div class="resource__tags" title="<?php esc_attr_e( 'Tags', 'chipmunk' ); ?>">
							<i class="icon icon_tag"></i>

							<?php echo chipmunk_display_collections( $tags ); ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="resource__actions">
					<?php if ( ! empty( $resource_website ) ) : ?>
						<a href="<?php echo esc_url( chipmunk_external_link( $resource_website ) ); ?>" class="button button_secondary" target="_blank" rel="nofollow"><?php esc_html_e( 'Visit website', 'chipmunk' ); ?></a>
					<?php endif; ?>

					<?php get_template_part( 'templates/partials/share-box' ); ?>
				</div>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<aside class="resource__image column column_lg-6">
					<?php if ( is_single() ) : ?>
						<?php if ( ! empty( $resource_website ) ) : ?>
							<a href="<?php echo esc_url( chipmunk_external_link( $resource_website ) ); ?>" target="_blank" rel="nofollow"><?php the_post_thumbnail( 'chipmunk-xl' ); ?></a>
						<?php else : ?>
							<?php the_post_thumbnail( 'chipmunk-xl' ); ?>
						<?php endif; ?>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'chipmunk-xl' ); ?></a>
					<?php endif; ?>
				</aside>
			<?php endif; ?>
		</article>
		<!-- /.resource -->
	</div>
</div>
<!-- /.section -->

<?php if ( ! is_search() && chipmunk_theme_option( 'display_resource_content_separated' ) ) : ?>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="column column_lg-8 column_lg-offset-2">
					<div class="entry__content content">
						<?php the_content(); ?>

						<div id="contact-form-121">
<form action="http://lyrwp.com/contact/#contact-form-121" method="post" class="contact-form commentsblock">

<div>
		<label for="g121-name" class="grunion-field-label name">Name<span>(required)</span></label>
		<input type="text" name="g121-name" id="g121-name" value="" class="name" required="" aria-required="true">
	</div>

<div>
		<label for="g121-email" class="grunion-field-label email">Email<span>(required)</span></label>
		<input type="email" name="g121-email" id="g121-email" value="" class="email" required="" aria-required="true">
	</div>

<div>
		<label for="g121-website" class="grunion-field-label url">Website</label>
		<input type="url" name="g121-website" id="g121-website" value="" class="url">
	</div>

<div>
		<label for="g121-whygetintouch" class="grunion-field-label select">Why get in touch?<span>(required)</span></label>
	<select name="g121-whygetintouch" id="g121-whygetintouch" class="select" required="" aria-required="true">
		<option value="Submit theme">Submit theme</option>
		<option value="Submit plugin">Submit plugin</option>
		<option value="Submit service">Submit service</option>
		<option value="Actually it was something else">Actually it was something else</option>
	</select>
	</div>

<div>
		<label for="contact-form-comment-g121-givemesomedetails" class="grunion-field-label textarea">Give me some details</label>
		<grammarly-ghost spellcheck="false"><div data-id="aae86d9c-4819-54da-3035-14721c86ce5a" data-gramm_id="aae86d9c-4819-54da-3035-14721c86ce5a" data-gramm="gramm" data-gramm_editor="true" class="gr_ver_2" gramm="true" contenteditable="true" style="position: absolute; color: transparent; overflow: hidden; white-space: pre-wrap; border-radius: 0px; box-sizing: border-box; height: 200px; width: 496px; margin: 756px 0px 13px 442px; padding: 0px; z-index: 0; border-width: 0px; border-style: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0); top: 0px; left: 0px;"><span style="display: inline-block; line-height: 38.85px; color: transparent; overflow: hidden; text-align: left; float: initial; clear: none; box-sizing: border-box; vertical-align: baseline; white-space: pre-wrap; width: 100%; margin: 0px; padding: 0px; border: 0px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 21px; font-family: Poppins; letter-spacing: normal; text-shadow: none; height: 200px;"></span><br></div></grammarly-ghost><textarea name="g121-givemesomedetails" id="contact-form-comment-g121-givemesomedetails" rows="20" class="textarea" data-gramm="true" data-txt_gramm_id="aae86d9c-4819-54da-3035-14721c86ce5a" data-gramm_id="aae86d9c-4819-54da-3035-14721c86ce5a" spellcheck="false" data-gramm_editor="true" style="z-index: auto; position: relative; line-height: 38.85px; font-size: 21px; transition: none; background: transparent !important;"></textarea><grammarly-btn><div class="_1BN1N Kzi1t MoE_1 _2DJZN" style="z-index: 2; transform: translate(908px, 926px);"><div class="_1HjH7"><div title="Protected by Grammarly" class="_3qe6h">&nbsp;</div></div></div></grammarly-btn>
	</div>
	<p class="contact-submit">
		<input type="submit" value="Submit »" class="pushbutton-wide">
		<input type="hidden" name="contact-form-id" value="121">
		<input type="hidden" name="action" value="grunion-contact-form">
		<input type="hidden" name="contact-form-hash" value="71f7c49a6ce5f19eaecb65ee379cfffb0a8f541f">
	</p>
</form>
</div>
					</div>
					<!-- /.entry -->
				</div>
			</div>
		</div>
	</div>
	<!-- /.section -->
<?php endif; ?>
