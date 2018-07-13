<!-- It's just HTML. Our View for the MetaBox is just a Form built with HTML. -->
<!-- We need an <input> with type "text". -->
<!-- Then, the name of the input will be our Meta Key, in this case "subtitle". -->
<!-- The other thing that goes with an input is a label. -->
<!-- We'll also put a usage instruction. WordPress comes with a built-in class for that called "description". -->

<!-- So how we build our Form is up to us. We can make a Table or whatever we may choose. -->
<p>
	<label for="subtitle"><?php _e( 'Subtitle', 'mbbasics' ); ?></label><!-- *001 -->
	<!-- To build a box that covers the screen's length, WordPress has a built-in class part of the interface styling called "large-text". -->
	<input class="large-text" type="text" name="subtitle" value="<?php esc_attr_e( $subtitle ); ?>"><!-- 002 -->
	<span class="description"><?php _e( 'Enter the SubTitle for this piece of Content.', 'mbbasics' ); ?></span><!-- 001 -->
</p>

<!-- 001 -> If we want to allow for internationalization, we need to wrap our 'Subtitle' label and our Instructions in the function that allows that to occur.
            We will use the _e() PHP function and our namespace. -->
<!-- 002 -> We know that our value is a dynamic one. We pull our Post Meta out of the DataBase and we insert it there. Since this is a Subtitle, let's make a
            $subtitle variable and define it in meta-box.php (line 61). Here in view.php, we need to sanitize everything that we send to the Browser,
            so we escape it.  -->