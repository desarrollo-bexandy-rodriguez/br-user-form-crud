<?php
/*
Plugin Name: My WordPress Plugin
Plugin URI: https://wordpress.org/plugins/
Description: Just another WordPress plugin.
Version: 1.0.0
Author: Bexandy Rodríguez
Author URI: https://www.bexandyrodriguez.com.ve/
*/

include( plugin_dir_path( __FILE__ ) . 'br-widget.php');

register_activation_hook( __FILE__,"br_formCrudTable");

function br_formCrudTable() {
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

function check_pages_live(){
	if(get_page_by_path( 'br-user-form-crud' ) == NULL) {
        create_pages_fly('br-user-form-crud');
    }
}
add_action('init','check_pages_live');

function create_pages_fly($pageName) {
        $createPage = array(
          'post_title'    => $pageName,
          'post_content'  => 'Starter content',
          'post_status'   => 'publish',
          'post_author'   => 1,
          'post_type'     => 'page',
          'post_name'     => $pageName
        );

        // Insert the post into the database
        wp_insert_post( $createPage );
    }

function br_process_form_submit() {
	global $wpdb;
	$table_name = $wpdb->prefix . "br_formcrud";

	if( isset( $_POST['br_form_crud_nonce'] ) && wp_verify_nonce( $_POST['br_form_crud_nonce'], 'br_form_crud_nonce_value') ) {
		$nombre = $_POST['nombre_usuario'];
		$correo = $_POST['correo_electronico'];
		$telefono = $_POST['numero_telefonico'];
		$edad = $_POST['edad_usuario'];
		$genero = $_POST['genero_usuario'];

		$wpdb->query("INSERT INTO $table_name(nombre,telefono, correo, edad, genero) VALUES('$nombre','$telefono', '$correo', '$edad', '$genero')");

		wp_redirect( esc_url_raw( add_query_arg( array(	),home_url('contact-us') ) ) );
	} else {
		wp_die( __( 'Invalid nonce specified', 'my_text_domain' ), __( 'Error', 'my_text_domain' ), array(
						'response' 	=> 403,
						'back_link' => 'index.php',

				) );
	}
	
}
add_action( 'admin_post_nopriv_br-user-form-crud', 'br_process_form_submit' );
add_action( 'admin_post_br-user-form-crud', 'br_process_form_submit' );



add_filter( 'page_template', 'br_page_template' );
function br_page_template( $page_template )
{
    if ( is_page( 'br-user-form-crud' ) ) {
        $page_template = dirname( __FILE__ ) . '/page-br-user-form-crud.php';
    }
    return $page_template;
}

//add_action( 'body_class', 'my_custom_class');
function my_custom_class( $classes ) {
    if ( is_page( 'br-user-form-crud' ) ) {

	    unset( $classes[array_search('page-two-column', $classes)] );

	    // Add custom class
	    $classes[] = 'has-sidebar';
    }
    

    return $classes;
}