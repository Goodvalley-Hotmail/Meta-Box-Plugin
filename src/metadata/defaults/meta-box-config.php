<?php
/**
 * Description
 *
 * @package     ${NAMESPACE}
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
	'unique-meta-box-id'    => array(

		'add_meta_box'  => array(
			'title'         => '',
			'screen'        => null,
			'context'       => 'advanced',
			'priority'      => 'default',
			'callback_args' => null,
		),

	),
);