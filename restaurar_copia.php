<!DOCTYPE html>

<?php
    /* /////////// RESTAURAR_COPIA /////////// */
    session_start();
    require "funciones_comunes.php";
    include ('include.php');
    if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
        echo "<script>alert('ERROR DE SESIÓN: Tienes que ser administrador para acceder. Volviendo a la página de inicio ...');window.location.href='index.php';</script>";
    }
?>

<html lang="es">

      <head>
          <title> Michael Jackson - Restaurar copia de seguridad </title>
          <link rel="shortcut icon" href="https://pm1.narvii.com/6620/29d4c29d07da0798f429844bdc0127865d9cec75_128.jpg" />
          <link rel="stylesheet" title="Estilo ejercicio 7" href="css/estilo.css" />
          <script type="text/javascript" src="jq/jquery-1.3.2.js"></script>
          <script type="text/javascript" src="js/validacion.js"></script>
          <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
          <meta name="viewport" content="width=device-width">
          <meta charset='utf-8'>
      </head>

      <body>

        <?php  HTMLheader(); ?>
          <div id="contenido_inicio">
         <form id="formulario_gestion" name="formulario" method="POST" action="restaurar_copia_funcion.php" enctype="multipart/form-data">
                <input type="file" class="botonFile" id="sql" name="sql" required>
                 <fieldset id="botones">
                     <table class="tabla_registrarse">
                         <tr>
                             <td>
                                 <input type="submit" value="Enviar" />
                                 <input type="reset" value="Restablecer" />
                             </td>
                         </tr>
                     </table>
                 </fieldset>
         </form>
         </div>

         <?php
         if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])) {
             switch ($_SESSION['tipo']) {
                 case 'administrador':
                     echo '<ul id="navigation">';
                     echo '<li class="cerrar_sesion"><a href="menu_cerrar_sesion.php"><span>Cerrar sesión</span></a></li>';
                     echo '<li class="info_componentes"><a href="editar_integrantes.php" ><span>Editar información de componentes</span></a></li>';
                     echo '<li class="info_biografia"><a href="editar_biografia.php" ><span>Editar biografía</span></a></li>';
                     echo '<li class="info_discografia"><a href="editar_discografia.php" ><span>Editar discografía</span></a></li>';
                     echo '<li class="info_conciertos"><a href="gestion_conciertos.php"><span>Editar conciertos</span></a></li>';
                     echo '<li class="info_usuarios"><a href="gestion_usuarios.php" ><span>Gestión de usuarios</span></a></li>';
                     echo '<li class="info_log_eventos"><a href="visualizar_log.php" ><span>Visualizar log</span></a></li>';
                     echo '<li class="info_copia"><a href="copia_seguridad.php"><span>Backup BD</span></a></li>';
                     echo '<li class="info_copia"><a href="restaurar_copia.php"><span>Restore BD</span></a></li>';
                     echo '<li class="info_copia"><a href="borrar_tablas.php"><span>Borrar contenido</span></a></li>';
                     echo '</ul>';
                     break;
                 case 'gestor':
                     echo '<ul id="navigation">';
                     echo '<li class="cerrar_sesion"><a href="menu_cerrar_sesion.php"><span>Cerrar sesión</span></a></li>';
                     echo '<li class="gestion_peticiones"><a href="gestionar_peticiones.php"><span>Gestionar peticiones</span></a></li>';
                     echo '<li class="historico_compras"><a href="historico_compras.php"><span>Historial de compras</span></a></li>';
                     echo '<li class="editar_precio"><a href="editar_precio_discos.php"><span>Editar precios de discos</span></a></li>';
                     echo '</ul>';
                     break;
             }
           } else {
                     echo '<div id="login">';
                         echo '<form action="comprobar_usuario.php" method="post" name="f1" onsubmit="return comprueba_iniciar_sesion(this)">';
                                 echo '<fieldset>';
                                     echo '<label for="userName" class="fontawesome-user"></label>';
                                     echo '<input name="usuario" class="caja_texto" type="text">';
                                     echo '<label for="userPwd" class="fontawesome-lock"></label>';
                                     echo '<input name="clave" class="caja_texto" type="password" value="" >';
                                     echo '<input type="submit" value="Iniciar sesión">';
                               echo '</fieldset>';
                         echo '</form>';
                   echo '</div>';
           }
         ?>

         <?php  HTMLnavegador(); ?>

         <script type="text/javascript">
             $(function() {
                 $('#navigation a').stop().animate({'marginLeft':'-85px'},1000);

                 $('#navigation > li').hover(
                     function () {
                         $('a',$(this)).stop().animate({'marginLeft':'-2px'},200);
                     },
                     function () {
                         $('a',$(this)).stop().animate({'marginLeft':'-85px'},200);
                     }
                 );
             });
         </script>

       		<?php  HTMLfooter(); ?>

 </body>
 </html>
