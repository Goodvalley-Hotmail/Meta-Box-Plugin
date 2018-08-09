<?php
/**
 * ConfigStore's Internal Functionality (Private)
 *
 * @package     KnowTheCode\ConfigStore
 * @since       1.0.0
 * @author      Carles Goodvalley
 * @link        https://cameraski.com
 * @license     GNU General Public License 2.0+
 */

namespace KnowTheCode\ConfigStore;

/************************************************
 * API's Black Box -> Config Store's internals
 ***********************************************/

/**
 * Description
 *
 * @since   1.0.0
 *
 * @param string    $store_key
 * @param array     $config_to_store
 *
 * @return void
 */
function _the_store( $store_key, $config_to_store = array() ) {

	static $config_store = array();

	// Store
	if ( $config_to_store ) {

		// Store here.
		$config_store[ $store_key ] = $config_to_store;

	}

	return $config_store;

	// Get

}

/**
 * Load a Configuration from the filesystem, returning its Storage Key and Configuration Parameters.
 *
 * @since   1.0.0
 *
 * @param string $path_to_the_file - Absolute path to the config file.
 *
 * @return array
 */
function _load_config_from_filesystem( $path_to_the_file ) {

	$config = ( array ) require $path_to_the_file;

	return array(
		key( $config ),
		current( $config )
	);

}