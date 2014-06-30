<?php

/*
Plugin Name: Últimos post por autor
Plugin URI: http://www.rutarelativa.com/plugins/wordpress-como-crear-widget/
Description: Muestra los editores del blog con sus últimas X entradas publicadas
Version: 1.0
Author: Jose Maria Sampedro (KelDroX)
Author URI: http://twitter.com/keldrox
*/

// Cuando se inicializa el widget llamaremos al metodo register de la clase Widget_ultimosPostPorAutor
add_action( 'widgets_init', array( 'Widget_ultimosPostPorAutor', 'register' ) );

// Cuando se active el plugin se llamara al metodo activate de la clase Widget_ultimosPostPorAutor
// donde añadiremos los argumentos por defecto para que funcione el plugin
register_activation_hook( __FILE__, array( 'Widget_ultimosPostPorAutor', 'activate' ) );

// Cuando se desactive el plugin se llamara al metodo desactivate de la clase Widget_ultimosPostPorAutor
// donde se eliminaran los argumentos anteriormente guardados, para tener una DB limpia
register_deactivation_hook( __FILE__, array( 'Widget_ultimosPostPorAutor', 'deactivate' ) );


// Clase Widget_ultimosPostPorAutor
class Widget_ultimosPostPorAutor
{
    function activate()
    {
        // Argumentos y sus valores por defecto
        $aData = array( 'SIZE_AVATAR' => 50,
                        'NUMERO_POST' => 5 );

        // Comprobamos si existe opciones para este Widget, si no existe las creamos por el contrario actualizamos
        if( ! get_option( 'ultimosPostPorAutor' ) )
            add_option( 'ultimosPostPorAutor' , $aData );
        else
            update_option( 'ultimosPostPorAutor' , $data);
    }

    function deactivate()
    {
        // Cuando se desactive el plugin se eliminaran todas las filas de la DB que le sirven a este plugin
        delete_option( 'ultimosPostPorAutor' );
    }

    // Panel de control que se mostrara abajo de nuestro Widget en el panel de configuración de Widgets
    function control()
    {
        $aData = get_option( 'ultimosPostPorAutor' );

        // Mostraremos un formulario en HTML para modificar los valores del Widget
        ?>
            <p>
                <label>Tamaño del avatar:</label>
                <input name="ultimosPostPorAutor_SIZE_AVATAR" type="text" value="<?php echo $aData['SIZE_AVATAR']; ?>" />
            </p>
            <p>
                <label>Numero máximo de post:</label>
                <input name="ultimosPostPorAutor_NUMERO_POST" type="text" value="<?php echo $aData['NUMERO_POST']; ?>" />
            </p>
        <?php

        // Si se ha enviado uno de los valores del formulario por POST actualizaremos los datos
        if( isset( $_POST['ultimosPostPorAutor_SIZE_AVATAR'] ) )
        {
            $aData['SIZE_AVATAR'] = attribute_escape( $_POST['ultimosPostPorAutor_SIZE_AVATAR'] );
            $aData['NUMERO_POST'] = attribute_escape( $_POST['ultimosPostPorAutor_NUMERO_POST'] );

            update_option( 'ultimosPostPorAutor', $aData );
        }
    }

    // Metodo que se llamara cuando se visualize el Widget en pantalla
    function widget($args)
    {
        // Variables
        $aData     = get_option( 'ultimosPostPorAutor' );
        $aUsuarios = null;
        $aUsuario  = null;
        $aPosts    = null;
        $aPost     = null;
        global $wpdb;


        echo $args['before_widget'];
        echo $args['before_title'] . 'Editores de ' . get_option( 'blogname' ) . $args['after_title'];
        ?>

        <style type="text/css">
          #sdbr-ultimos-post-por-autor a.avtr
          {
              float: left;
              padding: 5px;
              border: 1px solid #E9DED7;
              margin-right: 4px;
              width: <?php echo $aData['SIZE_AVATAR'] ?>px;
              height: <?php echo $aData['SIZE_AVATAR'] ?>px;
          }

          #sdbr-ultimos-post-por-autor ul
          {
              height: 100%;
              overflow: hidden;
              list-style-image:none;
              list-style-position:outside;
              list-style-type:none;
          }

          #sdbr-ultimos-post-por-autor ul li
          {
              margin-bottom: 10px;
              height: 100%;
              overflow: hidden;
              margin-top: 0px;
          }

          #sdbr-ultimos-post-por-autor a
          {
              display: block;
          }

          #sdbr-ultimos-post-por-autor a.mas
          {
              color: #554236;
              text-decoration: none;
              font-size: 11px;
              margin-bottom: 10px;
          }

          #sdbr-ultimos-post-por-autor a.mas span
          {
              color: #F77825;
          }

          #sdbr-ultimos-post-por-autor .post
          {
              display: none;
          }

          #sdbr-ultimos-post-por-autor ul li ul li
          {
            border-bottom:1px solid #CEC7C1;
            margin-bottom:5px;
            padding-bottom:5px;
          }

          #sdbr-ultimos-post-por-autor .post ul li span
          {
              font-size: 11px;
              color: #554236;
          }

          #sdbr-ultimos-post-por-autor .post ul li span a
          {
              display: inline;
          }
        </style>

        <div class="sdbr-cndr">
            <ul>
                <?php
                    // Cargamos en un array todos los editores del blog
                    $aUsuarios = $wpdb->get_results( 'SELECT ID, user_login, user_nicename, user_email FROM ' . $wpdb->users . ' WHERE user_login != "admin"' );

                    // Recorremos todos los editores
                    foreach( $aUsuarios as $aUsuario )
                    {
                        echo '<li>
                                  <a class="avtr" rel="nofollow" title="Avatar del autor ' . $aUsuario->user_login . '" href="/author/' . $aUsuario->user_nicename . '/">
                                     ' . get_avatar( $aUsuario->user_email, $aData['SIZE_AVATAR'] ) . '
                                  </a>
                                  <div>
                                      <a rel="nofollow"  title="Perfil del autor ' . $aUsuario->user_login . '" href="/author/' . $aUsuario->user_nicename . '/">' . $aUsuario->user_login . '</a>
                                      <a onclick="document.getElementById(\'slde-edit' . $aUsuario->user_nicename . '\').style.display = (document.getElementById(\'slde-edit' . $aUsuario->user_nicename . '\').style.display == \'block\' ? \'none\' : \'block\');" class="mas" href="javascript:void(0);"><span>[+]</span> Ver las últimas entradas publicadas</a>
                                      <div class="post" id="slde-edit' . $aUsuario->user_nicename . '">
                                          <ul>';

                        // Cargamos en un array todos los post de un editor
                        $aPosts = $wpdb->get_results( 'SELECT ID, post_title, post_date, comment_count
                                                       FROM ' . $wpdb->posts . '
                                                       WHERE post_status = "publish" and post_type = "post" AND post_author = ' . $aUsuario->ID . '
                                                       ORDER BY post_date DESC
                                                       LIMIT ' . $aData['NUMERO_POST'] );

                        // Recorreoms todos los post del editor
                        foreach( $aPosts as $aPost )
                        {
                            // Obtenemos el permalink del post
                            $sSlug = get_permalink( $aPost->ID );

                            echo '<li>
                                      <a title="' . $aPost->post_title . '" href="' . $sSlug . '">' . $aPost->post_title . '</a>
                                      <span>' . date( 'd/m/Y', strtotime( (string)$aPost->post_date ) ) . ' - <a title="Comentarios para ' . $aPost->post_title . '" href="' . $sSlug . '#comments">' . $aPost->comment_count . ' comentario' . ($aPost->comment_count > 0 ? 's' : '') . '</a></span>
                                  </li>';
                        }

                        echo '</ul></div></div></li>';
                    }
                ?>
            </ul>
        </div>

        <?php
        echo $args['after_widget'];
    }

    // Meotodo que se llamara cuando se inicialice el Widget
    function register()
    {
        // Incluimos el widget en el panel control de Widgets
         wp_register_sidebar_widget( 'Últimos post por autor', array( 'Widget_ultimosPostPorAutor', 'widget' ) );

        // Formulario para editar las propiedades de nuestro Widget
        register_widget_control( 'Últimos post por autor', array( 'Widget_ultimosPostPorAutor', 'control' ) );
    }
}

?>