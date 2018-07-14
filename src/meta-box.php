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

	/*
	 * CARLES START
	 * 'mbbasics_save' is the action.
	 * 'mbbasics_nonce' is the Key name.
	 * As we can see, both are wired to the wp_verify_nonce() function if we look at it.
	 * CARLES END
	 */
	// Security with a nonce
	wp_nonce_field( 'mbbasics_save', 'mbbasics_nonce' );

	// Get the metadata
	/*
	 * CARLES START
	 * We define $subtitle here.
	 * Our $subtitle variable works in view.php because it's in a function, and view.php is called inside this function.
	 * CARLES END
	 */
	$subtitle = get_post_meta( $post->ID, 'subtitle', true );

	// Do any processing that needs to be done

	// Load the view file
	include METABOXBASICS_DIR . 'src/view.php';
}

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

	// If there's no data, return false.
	/*
	 * CARLES START
	 * This checks if the Key is there or not: isset()
	 *
	 * We will change it to array_key_exists().
	 * $_POST is a super-global variable in PHP which is an Array.
	 * So now we're checking if the 'subtitle' Key exists in that Array.
	 * CARLES END
	 */
//	if ( ! isset( $_POST['subtitle'] ) ) { // Commented because we change to array_key_exists().
//		return;
//	}
	// If the 'subtitle' Key doesn't exist, bail out. Same as, if this is not the right MetaBox, bail out.
	// We've also moved the function above the nonce because if we don't have the right key, there's nothing for us to do.
	if ( ! array_key_exists( 'subtitle', $_POST ) ) {
		return;
	}

	/*
	 * CARLES START
	 * WordPress will grab the $_POST['mbbasics_nonce'] value here and compare it to the 'mbbasics_save' action to see
	 * if all matches the information that was created in the above render_meta_box() function and stored in the
	 * <input value="">. If the two 'mbbasics_nonce' match, all is fine.
	 * Summary:
	 * 1.- Verifies that this is the right MetaBox.
	 * 2.- Security check: should we really save this info? Does it really come from the right source?
	 * CARLES END
	 */
	// If the nonce doesn't match, return false.
	if ( ! wp_verify_nonce( $_POST['mbbasics_nonce'], 'mbbasics_save' ) ) {
		return false;
	}

	// Merge the metadata.

	// Loop through the custom fields and update the `wp_postmeta` database.

}
