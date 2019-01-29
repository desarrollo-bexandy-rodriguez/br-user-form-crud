<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/desarrollo-bexandy-rodriguez/br-user-form-crud
 * @since      1.0.0
 *
 * @package    BR_User_Form_Crud
 * @subpackage BR_User_Form_Crud/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
global $wpdb;
$table_name = $wpdb->prefix . "br_formcrud";

if(isset($_GET["del"])) {
     $del_id = $_GET["del"];
     $wpdb->query("DELETE FROM $table_name WHERE id='$del_id'");
     wp_redirect( esc_url_raw( add_query_arg( array(  ),home_url('br-user-form-crud') ) ) );
  }

get_header(); ?>

<div class="wrap">

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <section>
        <div>
          <div id="br-page-title">
            <h1 class="js-quickedit-page-title title page-title">Mostrar usuarios guardados en la Base de Datos</h1>
          </div>
          <div id="br-content">
            <div class="content">
              <table class="responsive-enabled" data-striping="1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Edad</th>
                    <th>Genero</th>
                    <th>operación</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result = $wpdb->get_results("SELECT * FROM $table_name");
                  if ( $result){
                    foreach ($result as $print) { ?>
                      <tr class="odd">
                        <td><?php echo $print->id ?></td>
                        <td><?php echo $print->nombre ?></td>
                        <td><?php echo $print->telefono ?></td>
                        <td><?php echo $print->correo ?></td>
                        <td><?php echo $print->edad ?></td>
                        <td><?php echo $print->genero ?></td>
                        <td>
                          <a href="<?php echo esc_url_raw( add_query_arg( array( 'upt' => $print->id ),home_url('br-user-form-crud') ) ) ?>">Editar</a>
                          <a href="<?php echo esc_url_raw( add_query_arg( array( 'del' => $print->id ),home_url('br-user-form-crud') ) ) ?>">Borrar</a>
                        </td>
                      </tr>
                  <?php 
                    }
                  } else { 
                  ?>
                    <tr class="odd">
                      <td colspan="7">No se encontraron datos</td>
                        
                      </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
              <?php
               if(isset($_GET["upt"])) {
                 $upt_id = $_GET["upt"];
                 $result = $wpdb->get_results("SELECT * FROM $table_name WHERE id='$upt_id'");
                 foreach($result as $print) {
                   $user_id = $print->id;
                   $nombre = $print->nombre;
                   $telefono = $print->telefono;
                   $correo = $print->correo; 
                   $edad = $print->edad;
                   $genero = $print->genero;
                 }
                 $br_form_crud_upt_nonce = wp_create_nonce( 'br_form_crud_upt_nonce_value' ); 
              ?>
                  <div id="br-page-title">
                    <h1 class="js-quickedit-page-title title page-title">Editar Usuario seleccionado</h1>
                  </div>
                   <table class='wp-list-table widefat striped'>
                     <thead>
                       <tr>
                        <th>No</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Edad</th>
                        <th>Genero</th>
                        <th>operación</th>
                       </tr>
                     </thead>
                     <tbody>
                       <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method='post' id="br-user-form-crud-upt">
                        <input type="hidden" name="action" value="br-user-form-crud-upt">
                        <input type="hidden" name="br_form_crud_upt_nonce" value="<?php echo $br_form_crud_upt_nonce ?>">
                         <tr>
                          <td>
                            <?php echo $user_id ?>
                            <input type='hidden' id='uptid' name='uptid' value="<?php echo $user_id ?>" >
                          </td>
                          <td>
                            <input type='text' id='uptnombre' name='uptnombre' value="<?php echo $nombre ?>" >
                          </td>
                          <td>
                            <input type='text' id='upttelefono' name='upttelefono' value="<?php echo $telefono ?>" >
                          </td>
                          <td>
                            <input type='text' id='uptcorreo' name='uptcorreo' value="<?php echo $correo ?>" >
                          </td>
                          <td>
                            <input type='text' id='uptedad' name='uptedad' value="<?php echo $edad ?>" >
                          </td>
                          <td>

                            <select id="uptgenero" name="uptgenero" value="<?php echo $genero ?>">
                              <option value="femenino">Femenino</option>
                              <option value="masculino">Masculino</option>
                            </select>
                          </td>

                          <td>
                            <input type="submit" id="upt-submit" name="uptop" value="Actualizar">
                            <a href="<?php echo esc_url_raw( add_query_arg( array(),home_url('br-user-form-crud') ) ) ?>">Cancelar</a>
                          </td>
                         </tr>
                       </form>
                     </tbody>
                   </table>
              <?php
               }
              ?>
            </div>
          </div>
          <div>
            <p>Ver el <a href="https://github.com/desarrollo-bexandy-rodriguez/br-user-form-crud" target="_blank">Código Fuente</a> del módulo "Frontend Formulario con CRUD para Wordpress" en Github.</p>

          </div>
        </div>
      </section>
    </main><!-- #main -->
  </div><!-- #primary -->
  <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
