<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    BR_User_Form_Crud
 * @subpackage BR_User_Form_Crud/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BR_User_Form_Crud
 * @subpackage BR_User_Form_Crud/admin
 * @author     Bexandy Rodríguez <developer@bexandyrodríguez.com.ve>
 */
class BR_User_Form_Crud_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/br-user-form-crud-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/br-user-form-crud-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function check_page(){
		if(get_page_by_path( 'br-user-form-crud' ) == NULL) {
	        self::create_page('br-user-form-crud');
	    }
	}

	public function create_page($pageName) {
        $createPage = array(
          'post_title'    => $pageName,
          'post_content'  => 'BR Form User Crud',
          'post_status'   => 'publish',
          'post_author'   => 1,
          'post_type'     => 'page',
          'post_name'     => $pageName
        );

        // Insert the post into the database
        wp_insert_post( $createPage );
    }

    public function br_process_form_submit() {
		global $wpdb;
		$table_name = $wpdb->prefix . "br_formcrud";

		if( isset( $_POST['br_form_crud_nonce'] ) && wp_verify_nonce( $_POST['br_form_crud_nonce'], 'br_form_crud_nonce_value') ) {
			$nombre = $_POST['nombre_usuario'];
			$correo = $_POST['correo_electronico'];
			$telefono = $_POST['numero_telefonico'];
			$edad = $_POST['edad_usuario'];
			$genero = $_POST['genero_usuario'];

			$wpdb->query("INSERT INTO $table_name(nombre,telefono, correo, edad, genero) VALUES('$nombre','$telefono', '$correo', '$edad', '$genero')");

			wp_redirect( esc_url_raw( add_query_arg( array(	),home_url('br-user-form-crud') ) ) );
		} else {
			wp_die( __( 'Invalid nonce specified', 'br-user-form-crud' ), __( 'Error', 'br-user-form-crud' ), array(
							'response' 	=> 403,
							'back_link' => 'index.php',

					) );
		}
	
	}

	// register BR_Widget widget
	public function br_register_widget() {
	    register_widget( 'BR_User_Form_Crud_Widget' );
	}
}
