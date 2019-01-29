<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    BR_User_Form_Crud
 * @subpackage BR_User_Form_Crud/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    BR_User_Form_Crud
 * @subpackage BR_User_Form_Crud/includes
 * @author     Bexandy Rodríguez <developer@bexandyrodríguez.com.ve>
 */
class BR_User_Form_Crud_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::br_form_crud_table();
	}

	function br_form_crud_table() {
	global $wpdb;
 	$charset_collate = $wpdb->get_charset_collate();
 	$table_name = $wpdb->prefix . "br_formcrud";
 	$sql = "CREATE TABLE `$table_name` (
 		`id` int(11) NOT NULL AUTO_INCREMENT,
 		`nombre` varchar(40) DEFAULT NULL,
 		`telefono` varchar(40) DEFAULT NULL,
 		`correo` varchar(40) DEFAULT NULL,
 		`edad` varchar(25) DEFAULT NULL,
 		`genero` varchar(40) DEFAULT NULL,
 		PRIMARY KEY(id)
 	) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 	";
 	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
 		require_once(ABSPATH . "wp-admin/includes/upgrade.php");
 		dbDelta($sql);
 	}
}


}
