<label class="u-checkbox">
	<input type="checkbox" name="<?php echo esc_attr( $name ); ?>" <?php echo $required ? 'required' : ''; ?>>

	<span class="u-checkbox__mark">
		<?php chipmunk_get_template_part( 'partials/icon', array( 'icon' => 'check', 'size' => 'sm' ) ); ?>
	</span>

	<p class="u-checkbox__label">
		<?php echo esc_html( $label ); ?>
	</p>
</label>
