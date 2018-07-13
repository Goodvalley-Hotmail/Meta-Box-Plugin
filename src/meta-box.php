<?php
/**
 * Meta Box Basics
 *
 * @package     KnowTheCode\MetaBoxBasics
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://KnowTheCode.io
 * @license     GNU-2.0+
 */

namespace KnowTheCode\MetaBoxBasics;

use WP_Post;

/*
 * CARLES START
 * As soon as the admin_menu Event is fired, we call a register callback function register_meta_box(),
 * which will register a MetaBox using a WordPress core function called add_meta_box(), located at
 * /wp-admin/includes/template.php, around line 917.
 *
 * In the Comments section of that WordPress function, it says that the function needs an id, a title, a callback
 * for rendering the desired Content and the screen we want to put it on. The screen and the rest of the parameters
 * is optional.
 *
 *
 * CARLES END
 */
add_action( 'admin_menu', __NAMESPACE__ . '\register_meta_box' );
/**
 * Register the meta box.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_meta_box() {
	add_meta_box(
		'mbbasics_subtitle', // CARLES -> This is our id.
		__( 'Subtitle', 'mbbasics' ), // CARLES -> This is our title. It is wrapped in a function that allows it to be translated.
		__NAMESPACE__ . '\render_meta_box', // CARLES -> When it's time to render, WordPress will call this function. Now it is in line 56.
		'post' // CARLES -> We want to render in the 'post' screen. If we want it also in a Page or CPT, we could build an Array.
	);
}

/**
 * Render the meta box
 *
 * @since 1.0.0
 *
 * @param WP_Post $post Instance of the post for this meta box
 * @param array $meta_box Array of meta box arguments
 *
 * @return void
 */
function render_meta_box( WP_Post $post, array $meta_box ) {
	// Security with a nonce
	wp_nonce_field( 'mbbasics_save', 'mbbasics_nonce' );

	// Get the metadata

	// Do any processing that needs to be done

	// Load the view file
	include METABOXBASICS_DIR . 'src/view.php';
}git push -u origin master

add_action( 'save_post', __NAMESPACE__ . '\save_meta_box', 10, 2 );
/**
 * Description.
 *
 * @since 1.0.0
 *
 * @param integer $post_id Post ID.
 * @param stdClass $post Post object.
 *
 * @return void
 */
function save_meta_box( $post_id, $post ) {
	// If the nonce doesn't match, return false.
	if ( ! wp_verify_nonce( $_POST['mbbasics_nonce'], 'mbbasics_save' ) ) {
		return false;
	}

	// If there's no data, return false.
	if ( ! isset( $_POST['mbbasics'] ) ) {
		return;
	}

	// Merge the metadata.

	// Loop through the custom fields and update the `wp_postmeta` database.

}
