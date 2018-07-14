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
		'mbbasics_subtitle',
		__( 'Subtitle', 'mbbasics' ),
		__NAMESPACE__ . '\render_meta_box',
		'post'
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
	$subtitle       = get_post_meta( $post->ID, 'subtitle', true );
	$show_subtitle  = get_post_meta( $post->ID, 'show_subtitle', true );

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

	ddd( $_POST['mbbasics'] );

	// If there's no data, return false.
	if ( ! array_key_exists( 'mbbasics', $_POST ) ) {
		return;
	}

	// If the nonce doesn't match, return false.
	if ( ! wp_verify_nonce( $_POST['mbbasics_nonce'], 'mbbasics_save' ) ) {
		return false;
	}

	// Merge the metadata.

	// Multiple custom fields.

	// Loop through the custom fields and update the `wp_postmeta` database.
	if ( $_POST['subtitle'] === '' ) {

		delete_post_meta( $post_id, 'subtitle' );

	} else {

		update_post_meta( $post_id, 'subtitle', sanitize_text_field( $_POST['subtitle'] ) );

	}

	if ( ! array_key_exists( 'show_subtitle', $_POST ) ) {

		delete_post_meta( $post_id, 'show_subtitle' );

	} else {

		update_post_meta( $post_id, 'show_subtitle', 1 );

	}

}
