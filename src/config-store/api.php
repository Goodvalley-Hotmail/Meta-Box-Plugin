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




}

/**
 * Load the Configuration into the Store from the absolute path to the Configuration file.
 *
 * @since   1.0.0
 *
 * @param string $path_to_file - Absolute path to the config file.
 */
function loadConfig( $path_to_file ) {

	// 1.- _load_a_file( $path_to_file )

	// 2.- $store_key

	// 3.- $config

}