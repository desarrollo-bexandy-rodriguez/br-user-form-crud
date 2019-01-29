<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
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
                        <td><a href="<?php echo esc_url_raw( add_query_arg( array( 'del' => $print->id ),home_url('br-user-form-crud') ) ) ?>">Borrar</a></td>
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
