<!DOCTYPE html>
<?php
/* /////////// GESTIONAR PETICIONES /////////// */
    session_start();
    require "funciones_comunes.php";
    include ('include.php');
    if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'gestor')) {
        echo "<script>alert('ERROR DE SESIÓN: Tienes que ser gestor para acceder. Volviendo a la página de inicio ...');window.location.href='index.php';</script>";
    }
?>

<html lang="es">

      <head>
          <title> Michael Jackson - Gestionar peticiones </title>
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

            <?php

            $consulta = "SELECT * FROM pedidos";
            $resultado = consultarA($consulta);

            echo '<table class= "tabla_conciertos">';
            echo '<tr><th>ID Pedido</th><th>Estado</th><th>Precio (€)</th><th>Gestor encargado</th><th>Fecha procesado</th><th>Info extra</th><th>Disco solicitado</th><th>Nombre comprador</th><th>Metodo de pago</th><th>Numero tarjeta</th><th>Mes tarjeta</th><th>Año tarjeta</th><th>Codigo tarjeta</th></tr>';
            while ($registroActual = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                echo '<td>';
                echo $registroActual['id_pedido'];
                echo '</td><td>';
                echo $registroActual['estado_pedido'];
                echo '</td><td>';
                echo $registroActual['precio_disco'];
                echo '</td><td>';
                echo $registroActual['usuario_gestor_pedido'];
                echo '</td><td>';
                echo $registroActual['fecha_pedido_procesado'];
                echo '</td><td>';
                echo $registroActual['texto_enviar'];
                echo '</td><td>';
                echo $registroActual['disco_solicitado'];
                echo '</td><td>';
                echo $registroActual['nombre_comprador'];
                echo '</td><td>';
                echo $registroActual['metodo_pago'];
                echo '</td><td>';
                echo $registroActual['numero_tarjeta'];
                echo '</td><td>';
                echo $registroActual['mes_tarjeta'];
                echo '</td><td>';
                echo $registroActual['año_tarjeta'];
                echo '</td><td>';
                echo $registroActual['codigo_tarjeta'];
                echo '</td>';
            }

            echo '</tr></table>';
            echo '<br /><br /><br /><br />';
            ?>

            </div>
                    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                            <h2 id="titulo_gestion"> Aceptar/Denegar pedidos: </h2>
                            <form id="formulario_gestion" method="post" action="gestionar_peticiones.php">

                                <?php
                                if (isset($_POST['id_registro'])) {

                                if (trim($_POST['fecha_registro']) == '')
                                          $hayerror ['fecha_registro']='<p style="color:red;">La fecha no puede estar en blanco.</p>';

                                  if(is_numeric($_POST['info_registro']))
                                    $hayerror['info_registro'] = '<p style="color:red;">La información extra no puede ser numérica.</p>';
                                      else if (trim($_POST['info_registro']) == '')
                                            $hayerror ['info_registro']='<p style="color:red;">La información extra no puede estar en blanco.</p>';

                                }

                                if (isset($_POST['id_registro']) && !isset($hayerror)) {
                                $sql = "UPDATE pedidos SET ";
                                    $sql.= "estado_pedido='" . htmlentities($_POST["estado_registro"]) . "'";
                                    $sql.= ",usuario_gestor_pedido='" . htmlentities($_SESSION['usuario']) . "'";
                                    $sql.= ",fecha_pedido_procesado='" . htmlentities($_POST["fecha_registro"]) . "'";
                                    $sql.= ",texto_enviar='" . htmlentities($_POST["info_registro"]) . "'";
                                    $sql.= "WHERE id_pedido='" .htmlentities($_POST['id_registro']) . "'";
                                    $resultado = consultarA($sql);

                                    echo "<script>alert('Datos modificados correctamente.');window.location.href='gestionar_peticiones.php';</script>";
                                }

                                if(isset($hayerror) && array_key_exists('fecha_registro', $hayerror))
                                      echo $hayerror['fecha_registro'];
                                if(isset($hayerror) && array_key_exists('info_registro', $hayerror))
                                      echo $hayerror['info_registro'];

                                ?>
                                <fieldset id="registrarse">
                                    <table class="tabla_gestion"  cellpadding="10">
                                        <tr>
                                            <td>
                                              <label> Pedido a modificar (ID)
                                                  <?php
                                                  $consulta = "SELECT id_pedido FROM pedidos";
                                                  $resultado = consultarA($consulta);
                                                  echo '<select id="tp" name="id_registro">';
                                                  while ($registroActual = mysqli_fetch_array($resultado)) {
                                                      echo '<option name="id_pedido" value='.$registroActual['id_pedido'].'>'.$registroActual['id_pedido'].'</option>';
                                                  }
                                                  echo '</select>';
                                                  ?>
                                              </label>
                                           </td>
                                            <td>
                                                <label> Fecha del procedimiento
                                                    <input name="fecha_registro"  type="date" value="" />
                                                </label>
                                            </td>
                                            <td>
                                                <label> Información extra
                                                    <textarea name="info_registro" class="caja_texto" type="text" value=""/> </textarea>
                                                </label>
                                            </td>
                                            <td>
                                                <input type="radio" name="estado_registro" class="caja_texto" value="aceptado" checked>Aceptado
                                                <input type="radio" name="estado_registro" class="caja_texto" value="denegado">Denegado
                                            </td>
                                            </tr>
                                    </table>
                                </fieldset>
                                <fieldset id="botones">
                                    <table class="tabla_registrarse">
                                        <tr>
                                            <td>
                                                <input type="submit" value="Modificar" />
                                                <input type="reset" value="Borrar" />
                                            </td>
                                        </tr>
                                    </table>
                                </fieldset>
                            </form>

          <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

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
