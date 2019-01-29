<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/desarrollo-bexandy-rodriguez/br-user-form-crud
 * @since      1.0.0
 *
 * @package    BR_User_Form_Crud
 * @subpackage BR_User_Form_Crud/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    BR_User_Form_Crud
 * @subpackage BR_User_Form_Crud/includes
 * @author     Bexandy Rodríguez <developer@bexandyrodríguez.com.ve>
 */
class BR_User_Form_Crud_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'br-user-form-crud',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
