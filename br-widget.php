<?php
// register BR_Widget widget
function register_BR_widget() {
    register_widget( 'BR_Widget' );
}
add_action( 'widgets_init', 'register_BR_widget' );
 
/**
 * Adds BR_Widget widget.
 */
class BR_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'BR_widget', // Base ID
			esc_html__( 'Agregar Usuario a la BD', 'br_text_domain' ), // Name
			array( 'description' => esc_html__( 'Formulario para agregar un usuario a la BD', 'br_text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		$br_form_crud_nonce = wp_create_nonce( 'br_form_crud_nonce_value' ); 
		?>
		<div>
			<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" id="br-user-form-crud-form">
				<input type="hidden" name="action" value="br-user-form-crud">
				<input type="hidden" name="br_form_crud_nonce" value="<?php echo $br_form_crud_nonce ?>">
				<div>
			  		<label for="edit-nombre-usuario">Nombre del Usuario:</label>
			        <input type="text" id="edit-nombre-usuario" name="nombre_usuario" value="" size="60" maxlength="128" required="required">
				</div>
				<div>
			      	<label for="edit-numero-telefonico">Número Telefónico:</label>
			        <input type="text" id="edit-numero-telefonico" name="numero_telefonico" value="" size="60" maxlength="128">
				</div>
				<div>
			      	<label for="edit-correo-electronico">Correo Electrónico:</label>
			    	<input type="email" id="edit-correo-electronico" name="correo_electronico" value="" size="60" maxlength="254" required="required">
		        </div>
				<div>
			      	<label for="edit-edad-usuario">Edad</label>
			        <input type="text" id="edit-edad-usuario" name="edad_usuario" value="" size="60" maxlength="128" required="required">
		        </div>
				<div>
			      	<label for="edit-genero-usuario">Género</label>
			        <select id="edit-genero-usuario" name="genero_usuario">
			        	<option value="femenino">Femenino</option>
			        	<option value="masculino">Masculino</option>
			        </select>
			    </div>
			    <br>
			    <input type="hidden" name="submitted" value="1">
			    <div>
			    	<input type="submit" id="edit-submit" name="op" value="guardar">
			    </div>
			</form>
		</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Agregar Usuario a la BD', 'br_text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Titulo:', 'br_text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class BR_Widget