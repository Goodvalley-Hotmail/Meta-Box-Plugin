<?php
/**
 * Meta Box Reusable WordPress Plugin
 *
 * @package     MetaBox
 * @author      hellofromTonya
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Meta Box Reusable WordPress Plugin
 * Plugin URI:  https://github.com/KnowTheCode/meta-box-basics
 * Description: Custom meta box basics plugin to add a custom meta box to our sandbox.
 * Version:     1.0.0
 * Author:      hellofromTonya
 * Author URI:  https://KnowTheCode.io
 * Text Domain: mbbasics
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace KnowTheCode\MetaBox;

use function KnowTheCode\ConfigStore\_load_config_from_filesystem;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

/**
 * Setup the plugin's constants.
 *
 * @since 1.0.0
 *
 * @return void
 */
function init_constants() {
	$plugin_url = plugin_dir_url( __FILE__ );
	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}

	define( 'METABOX_URL', $plugin_url );
	define( 'METABOX_DIR', plugin_dir_path( __FILE__ ) );
}

/**
 * Launch the plugin
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	init_constants();

	require __DIR__ . '/src/config-store/module.php';

	$key = \KnowTheCode\ConfigStore\loadConfigFromFilesystem( __DIR__ . '/config/portfolio.php' );

	d( \KnowTheCode\ConfigStore\getConfig( $key ) );

	d( \KnowTheCode\ConfigStore\getConfigParameter( $key, 'view' ) );

	$key = \KnowTheCode\ConfigStore\loadConfigFromFilesystem( __DIR__ . '/config/subtitle.php' );

	d( \KnowTheCode\ConfigStore\getConfig( $key ) );

	ddd( \KnowTheCode\ConfigStore\getConfigParameter( $key, 'custom_fields' ) );

	//require __DIR__ . '/src/metadata/module.php';

}

launch();