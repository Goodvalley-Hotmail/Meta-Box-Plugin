<?php
/**
 * Public API to interact with the ConfigStore.
 *
 * @package     KnowTheCode\ConfigStore
 * @since       1.0.0
 * @author      Carles Goodvalley
 * @link        https://cameraski.com
 * @license     GNU General Public License 2.0+
 */

namespace KnowTheCode\ConfigStore;

/**
 * Get a specific Configuration from the Store.
 *
 * @since   1.0.0
 *
 * @param string $store_key
 *
 * @return mixed
 */
function getConfig( $store_key ) {

	return _the_store( $store_key );

}

/**
 * Get a specific Configuration Parameter from the Store.
 *
 * @since   1.0.0
 *
 * @param string $store_key
 * @param string $parameter_key
 *
 * @return mixed
 */
function getConfigParameter( $store_key, $parameter_key ) {

	$config = getConfig( $store_key );

	// Do something if the Parameter Key doesn't exist.

	return $config[ $parameter_key ];

}

/**
 * Load the Configuration into the Store from the absolute path to the Configuration file.
 *
 * @since   1.0.0
 *
 * @param string $path_to_file - Absolute path to the config file.
 */
function loadConfigFromFilesystem( $path_to_file ) {

	list( $store_key, $config ) = _load_config_from_filesystem( $path_to_file );

	//return _the_store( $store_key, $config );

	_the_store( $store_key, $config );

	return $store_key;

}

/**
 * Load the Configuration into the Store.
 *
 * @since   1.0.0
 *
 * @param string    $store_key  -> Unique Storage Key.
 * @param mixed     $config     -> Runtime Configuration Parameter(s).
 */
function loadConfig( $store_key, $config ) {
	_the_store( $store_key, $config );
}