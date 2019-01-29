<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/desarrollo-bexandy-rodriguez/br-user-form-crud
 * @since      1.0.0
 *
 * @package    BR_User_Form_Crud
 * @subpackage BR_User_Form_Crud/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    BR_User_Form_Crud
 * @subpackage BR_User_Form_Crud/public
 * @author     Bexandy Rodríguez <developer@bexandyrodríguez.com.ve>
 */
class BR_User_Form_Crud_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BR_User_Form_Crud_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BR_User_Form_Crud_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/br-user-form-crud-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BR_User_Form_Crud_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BR_User_Form_Crud_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/br-user-form-crud-public.js', array( 'jquery' ), $this->version, false );

	}

	public function br_page_template( $page_template ) {
	    if ( is_page( 'br-user-form-crud' ) ) {
	        $page_template = dirname( __FILE__  ) . '/partials/page-br-user-form-crud.php';
	    }
	    return $page_template;
	}

}
