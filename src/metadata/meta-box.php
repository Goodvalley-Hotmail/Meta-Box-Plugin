<?php
/**
 * Subtitle Meta Box
 *
 * @package     KnowTheCode\MetaBox
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://KnowTheCode.io
 * @license     GNU-2.0+
 */

namespace KnowTheCode\Metadata;

use WP_Post;

add_action( 'admin_menu', __NAMESPACE__ . '\register_subtitle_meta_box' );
/**
 * Register the meta box.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_subtitle_meta_box() {

	$meta_box_key   = '';
	$config         = getConfig( $meta_box_key, 'add_meta_box' );

	add_meta_box(
		'mbbasics_subtitle',
		__( 'Subtitle', 'mbbasics' ),
		__NAMESPACE__ . '\render_subtitle_meta_box',
		array( 'post' )
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
function render_subtitle_meta_box( WP_Post $post, array $meta_box ) {

	// Security with a nonce
	wp_nonce_field( 'mbbasics_save', 'mbbasics_nonce' );

	// Get the metadata
	$subtitle       = get_post_meta( $post->ID, 'subtitle', true );
	$show_subtitle  = get_post_meta( $post->ID, 'show_subtitle', true );

	// Do any processing that needs to be done

	// Load the view file
	include METABOX_DIR . 'src/views/subtitle.php';
}

add_action( 'save_post', __NAMESPACE__ . '\save_subtitle_meta_box', 10, 2 );
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
function save_subtitle_meta_box( $post_id, $post ) {

	// If there's no data, return false.
	if ( ! array_key_exists( 'mbbasics', $_POST ) ) {
		return;
	}

	// If the nonce doesn't match, return false.
	if ( ! wp_verify_nonce( $_POST['mbbasics_nonce'], 'mbbasics_save' ) ) {
		return false;
	}

	// Merge with defaults.
	$metadata = wp_parse_args(
		$_POST['mbbasics'],
		array(
			'subtitle'      => '',
			'show_subtitle' => 0,
		)
	);

	// Loop through the custom fields and update the `wp_postmeta` database.
	foreach ( $metadata as $meta_key => $value ) {

		// If no value, delete the Post Meta record.
		if ( ! $value ) {

			delete_post_meta( $post_id, $meta_key );

			// We add continue, so it skips the rest of the function and goes back up of the loop to start again.
			continue;

		}

		// Validation and sanitizing.
		$value = 'subtitle' === $meta_key
			? sanitize_text_field( $value )
			: 1;

		update_post_meta( $post_id, $meta_key, $value );

	}

}
