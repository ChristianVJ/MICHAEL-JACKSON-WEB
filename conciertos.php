

<!DOCTYPE html>
<?php
/* /////////// CONCIERTOS /////////// */
    session_start();
    require "funciones_comunes.php";
    include ('include.php');
?>

<html lang="es">

      <head>
          <title> Michael Jackson - Conciertos </title>
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
        <?php  HTMLnav(); ?>

        <div id="contenido1">

           <?php
           $consulta = "SELECT * FROM conciertos";
           $resultado = consultarA($consulta);

           echo '<table class= "tabla_conciertos">';
           echo '<thead><tr><th>ID</th><th>Fecha</th><th>Lugar</th><th>Descripcion</th></tr></thead>';
           while ($registroActual = mysqli_fetch_array($resultado)) {
               echo '<tbody><tr>';
               echo '<td>';
               echo $registroActual['id_concierto'];
               echo '</td><td>';
               echo $registroActual['fecha'];
               echo '</td><td>';
               echo $registroActual['lugar'];
               echo '</td><td>';
               echo $registroActual['descripcion'];
               echo '</td>';
           }
           echo '</tr></tbody></table>';
           echo '<br /><br /><br /><br />';

           if(isset($_POST['buscar_concierto'])) {
             $consulta = 'SELECT * FROM conciertos WHERE lugar="' . $_POST['buscar_concierto'] . '"';
             $resultado = consultarA($consulta);

               echo '<table class= "tabla_conciertos">';
               echo '<thead><tr><th>ID</th><th>Fecha</th><th>Lugar</th><th>Descripcion</th></tr></thead>';
               while ($registroActual = mysqli_fetch_array($resultado)) {
                   echo '<tbody><tr>';
                   echo '<td>';
                   echo $registroActual['id_concierto'];
                   echo '</td><td>';
                   echo $registroActual['fecha'];
                   echo '</td><td>';
                   echo $registroActual['lugar'];
                   echo '</td><td>';
                   echo $registroActual['descripcion'];
                   echo '</td>';
               }
               echo '</tr></tbody></table>';
               echo '<br /><br /><br /><br />';
           }

           if(isset($_POST['fecha_concierto1'])) {

             $consulta = 'SELECT * FROM conciertos WHERE fecha >= "' . $_POST['fecha_concierto1'] . '" AND fecha <= "' . $_POST['fecha_concierto2'] . '"' ;
             $resultado = consultarA($consulta);

               echo '<table class= "tabla_conciertos">';
               echo '<thead><tr><th>ID</th><th>Fecha</th><th>Lugar</th><th>Descripcion</th></tr></thead>';
               while ($registroActual = mysqli_fetch_array($resultado)) {
                   echo '<tbody><tr>';
                   echo '<td>';
                   echo $registroActual['id_concierto'];
                   echo '</td><td>';
                   echo $registroActual['fecha'];
                   echo '</td><td>';
                   echo $registroActual['lugar'];
                   echo '</td><td>';
                   echo $registroActual['descripcion'];
                   echo '</td>';
               }
               echo '</tr></tbody></table>';
               echo '<br /><br /><br /><br />';
           }
           ?>

        </div>

                <h2 id="titulo_gestion"> Buscar un concierto por lugar : </h2>
                <form id="formulario_gestion" name="formulario" method="POST" action="conciertos.php">
                    <fieldset class="iniciarSesion">
                        <table class="tabla_gestion">
                            <tr>
                                <td>
                                    <label> Conciertos: <br/>
                                        <?php
                                        $consulta = "SELECT DISTINCT lugar FROM conciertos";
                                        $resultado = consultarA($consulta);
                                        echo '<select id="tp" name="buscar_concierto">';
                                        while ($registroActual = mysqli_fetch_array($resultado)) {
                                            echo '<option name="buscar_concierto" value="'.$registroActual['lugar'].'">'.$registroActual['lugar'].'</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
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


            <h2 id="titulo_gestion"> Buscar un concierto por fechas : </h2>
            <form id="formulario_gestion" name="formulario" method="POST" action="conciertos.php">
                <fieldset class="iniciarSesion">
                    <table class="tabla_gestion">
                        <tr>
                          <td>
                              <label> Fecha inicio :
                                  <input name="fecha_concierto1" class="caja_texto"  type="date" value=""/>
                              </label>
                          </td>
                          <td>
                              <label> Fecha final :
                                  <input name="fecha_concierto2" class="caja_texto"  type="date" value=""/>
                              </label>
                          </td>
                        </tr>
                    </table>
                </fieldset>
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

            </body>

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
