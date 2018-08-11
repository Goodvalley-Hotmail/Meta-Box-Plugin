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

use Mockery\Exception;

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
 * @throws Exception
 */
function _the_store( $store_key, $config_to_store = array() ) {

	static $config_store = array();

	// Store
	if ( $config_to_store ) {

		// Store here.
		$config_store[ $store_key ] = $config_to_store;

		return true;

	}

	// Get
	if ( ! array_key_exists( $store_key, $config_store ) ) {
		throw new \Exception(
			sprintf(
				__( 'The Configuration for [%s] does not exist in the Configuration Store.', 'config-store' ),
				esc_html( $store_key )
			)
		);
	}
	return $config_store[ $store_key ];

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