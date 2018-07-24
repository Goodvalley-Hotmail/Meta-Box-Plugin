<?php
/**
 * Meta Box Default Configuration Model
 *
 * Default Runtime Configuration Parameters
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
	'unique-meta-box-id'=> array(

		/*
		 * Configuration parameters for adding the meta box.
		 * For more information on each of the parameters, see this
		 * article in Codex:
		 * @link https://developer.wordpress.org/reference/functions/add_meta_box/#parameters
		 */
		'add_meta_box'  => array(
			// 'id' is not needed, as the Meta Box ID/Key is defined above.
			'title'         => '',
			// The screen or screens on which to show the box, such as the Post type, link, comment, etc.
			'screen'        => null,
			// (Optional). The context within the screen where this will display: normal, side or advanced (default).
			'context'       => 'advanced',
			// (Optional). Sets the priority of when the Meta Box will render: high, low or default (which is the default).
			'priority'      => 'default',
			// (Optional). We can send arguments to our render callback, as an array of arguments.
			'callback_args' => null,
		),

	),
	'custom_fields'     => array(

		'meta_key'      => array(
			'is_single' => true,
			'default'   => '',
		),

	),
	/*
	 * Configure the absolute path to our Meta Box's View file.
	 */
	'view'              => '',

);