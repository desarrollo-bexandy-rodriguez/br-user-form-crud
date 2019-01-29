<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/desarrollo-bexandy-rodriguez/br-user-form-crud
 * @since             1.0.0
 * @package           BR_User_Form_Crud
 *
 * @wordpress-plugin
 * Plugin Name:       BR Formulario con CRUD Frontend (Bexandy Rodriguez)
 * Plugin URI:        https://github.com/desarrollo-bexandy-rodriguez/br-user-form-crud
 * Description:       Formulario con CRUD en el Frontend para Wordpress.
 * Version:           1.0.0
 * Author:            Bexandy Rodríguez
 * Author URI:        http://bexandyrodriguez.com.ve/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       br-user-form-crud
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BR_USER_FORM_CRUD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-br-user-form-crud-activator.php
 */
function activate_br_user_form_crud() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-br-user-form-crud-activator.php';
	BR_User_Form_Crud_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-br-user-form-crud-deactivator.php
 */
function deactivate_br_user_form_crud() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-br-user-form-crud-deactivator.php';
	BR_User_Form_Crud_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_br_user_form_crud' );
register_deactivation_hook( __FILE__, 'deactivate_br_user_form_crud' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-br-user-form-crud.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_br_user_form_crud() {

	$plugin = new BR_User_Form_Crud();
	$plugin->run();

}
run_br_user_form_crud();
