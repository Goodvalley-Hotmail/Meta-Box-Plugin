<!-- We make the names become sub-Keys of the 'mbbasics' Key by wrapping them in square brackets. -->
<p>
	<label for="subtitle"><?php _e( 'Subtitle', 'mbbasics' ); ?></label>
	<input class="large-text" type="text" name="mbbasics[subtitle]" value="<?php esc_attr_e( $subtitle ); ?>">
	<span class="description"><?php _e( 'Enter the SubTitle for this piece of Content.', 'mbbasics' ); ?></span>
</p>

<p>
	<input type="checkbox" value="1" name="mbbasics[show_subtitle]" <?php checked( $show_subtitle, 1 ); ?>>
	<label for="subtitle"><?php _e( 'Show SubTitle?', 'mbbasics' ); ?></label>
	<div><span class="description"><?php _e( 'Check if you want to show the SubTitle for this Article.', 'mbbasics' ); ?></span></div>
</p>