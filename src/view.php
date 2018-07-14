<p>
	<label for="subtitle"><?php _e( 'Subtitle', 'mbbasics' ); ?></label>
	<input class="large-text" type="text" name="subtitle" value="<?php esc_attr_e( $subtitle ); ?>">
	<span class="description"><?php _e( 'Enter the SubTitle for this piece of Content.', 'mbbasics' ); ?></span>
</p>

<!-- To start playing with more than one custom field, let's add a check field. -->
<p>
	<!-- checked() is a WordPress core function in /wp-includes/general-template.php in around line 4165. -->
	<!-- It's just a helper to be able to say: if it's stored in the database as $checked,
		 then we we put that in the HTML. -->
	<!--  -->
	<input type="checkbox" value="1" name="show_subtitle" <?php checked( $show_subtitle, 1 ); ?>>
	<label for="subtitle"><?php _e( 'Show SubTitle?', 'mbbasics' ); ?></label>
	<div><span class="description"><?php _e( 'Check if you want to show the SubTitle for this Article.', 'mbbasics' ); ?></span></div>
</p>