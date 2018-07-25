<?php
/**
 * Subtitle Meta Box Default Configuration Model
 *
 * Runtime Configuration Parameters
 *
 * @package     KnowTheCode\Metadata
 * @since       1.0.0
 * @author      Carles Goodvalley
 * @link        https://cameraski.com
 * @license     GNU General Public License 2.0+
 */

namespace KnowTheCode\Metadata;

return array(
	/*
	 * Configure a unique ID for our MetaBox.
	 *
	 * This ID is used when running add_meta_box, for storting in the Config Store,
	 * for the view file and for save $_POST.
	 */
	'mbbasics'=> array(

		/*
		 * Configuration parameters for adding the meta box.
		 * For more information on each of the parameters, see this
		 * article in Codex:
		 * @link https://developer.wordpress.org/reference/functions/add_meta_box/#parameters
		 */
		'add_meta_box'  => array(
			// 'id' is not needed, as the Meta Box ID/Key is defined above.
			'title'         => __( 'Subtitle', 'mbbasics' ),
			// The screen or screens on which to show the box, such as the Post type, link, comment, etc.
			'screen'        => array( 'post' ),
		),

	/*
	 * Configure each Custom Field, specifying its meta_key, default value, delete_state and sanitizing function.
	 */
	'custom_fields'     => array(

		// Specify this Field's Meta Key. It's used in the DataBase.
		'subtitle'      => array(
			'is_single'     => true, // True means it's a single. False means it's an Array.
			'default'       => '', // Specify the Custom Field's default value.
			'delete_state'  => '', // What is the state that signals to delete this Meta Key from the DataBase.
			'sanitize'      => 'sanitize_text_field', // Callable sanitizer function such as sanitize_text_field, sanitize_email, strip_tags, intval, etc.
		),
		// Specify this Field's Meta Key. It's used in the DataBase.
		'show_subtitle'      => array(
			'is_single'     => true, // True means it's a single. False means it's an Array.
			'default'       => 0, // Specify the Custom Field's default value.
			'delete_state'  => 0, // What is the state that signals to delete this Meta Key from the DataBase.
			'sanitize'      => 'intval', // Callable sanitizer function such as sanitize_text_field, sanitize_email, strip_tags, intval, etc.
		),
	),
	/*
	 * Configure the absolute path to our Meta Box's View file.
	 */
	'view'              => METABOX_DIR . 'src/views/subtitle.php',
	),
);