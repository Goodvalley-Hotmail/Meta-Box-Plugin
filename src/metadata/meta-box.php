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

add_action( 'admin_menu', __NAMESPACE__ . '\register_meta_boxes' );
/**
 * Register the meta boxes.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_meta_boxes() {

	$meta_box_key   = '';
	$config         = getConfig( $meta_box_key, 'add_meta_box' );

	add_meta_box(
		$meta_box_key,
		$config['title'],
		__NAMESPACE__ . '\render_meta_box',
		$config['screen'],
		$config['context'],
		$config['priority'],
		$config['callback_args']
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
function render_meta_box( WP_Post $post, array $meta_box_args ) {

	$meta_box_key   = $meta_box_args['id'];
	$config         = getConfig( $meta_box_key );

	// Security with a nonce
	wp_nonce_field( $meta_box_key . '_action', $meta_box_key . '_name' );

	// Get the metadata
	$custom_fields = [];

	foreach ( $config['custom_fields'] as $meta_key => $custom_field_config ) {

		$custom_fields[ $meta_key ] = get_post_meta( $post->ID, $meta_key, $custom_field_config['is_single'] );

		if ( ! $custom_fields[ $meta_key ] ) {

			$custom_fields[ $meta_key ] = $custom_field_config['default'];

		}

	}

	// Do any processing that needs to be done

	// Load the view file
	include $config['view'];
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
