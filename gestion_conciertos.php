<!DOCTYPE html>

<?php
    /* /////////// GESTIÓN CONCIERTOS /////////// */
    session_start();
    require "funciones_comunes.php";
    include ('include.php');
    if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
        echo "<script>alert('ERROR DE SESIÓN: Tienes que ser administrador para acceder. Volviendo a la página de inicio ...');window.location.href='index.php';</script>";
    }
?>

<html lang="es">

      <head>
          <title> Michael Jackson - Gestión de conciertos </title>
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
          ?>
        </div>

        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php
        if(isset($_GET['error'])){
            $error=unserialize($_GET['error']);
            if(array_key_exists('fecha_concierto', $error)){
                echo $error['fecha_concierto'];
            }
            if(array_key_exists('lugar_concierto', $error)){
                echo $error['lugar_concierto'];
            }
            if(array_key_exists('descripcion_concierto', $error)){
                echo $error['descripcion_concierto'];
            }
        }
        ?>

        <h2 id="titulo_gestion">Nuevo concierto: </h2>
        <form  id="formulario_gestion" method="post" action="comprobar_concierto.php" >
            <fieldset id="crear_concierto">
                <table class="tabla_gestion" cellpadding="10">
                    <tr>
                        <td>
                            <label> Fecha
                                <input name="fecha_concierto" class="caja_texto"  type="date" value=""/>
                            </label>
                        </td>
                        <td>
                            <label> Lugar
                                <input name="lugar_concierto" class="caja_texto" maxlength="40" type="text" value=""/>
                            </label>
                        </td>
                        <td>
                            <label>
                                Descripción
                                <textarea name="descripcion_concierto" class="caja_texto" maxlength="40" type="text" value=""/></textarea>
                            </label>
                        </tr>
                      </table>
                    </fieldset>
            <fieldset id="botones">
                <table class="tabla_registrar_concierto">
                    <tr>
                        <td>
                            <input type="submit" value="Ingresar" />
                            <input type="reset" value="Borrar" />
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>

        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



        <h2 id="titulo_gestion"> Modificar concierto: </h2>
        <form id="formulario_gestion" method="post" action="gestion_conciertos.php" >
            <?php


            if (isset($_POST['concierto_editar'])) {

              if(trim($_POST['fecha_registro']) == '')
                      $hayerror ['fecha_registro']='<p style="color:red;">La fecha no puede estar vacia.</p>';

              if(trim($_POST['lugar_registro']) == '')
                      $hayerror ['lugar_registro']='<p style="color:red;">El lugar no puede estar vacio</p>';
                  else if (is_numeric($_POST['lugar_registro']))
                        $hayerror ['lugar_registro']='<p style="color:red;">El lugar no puede ser numerico.</p>';

              if(trim($_POST['descripcion_registro']) == '')
                      $hayerror ['descripcion_registro']='<p style="color:red;">La descripción no puede estar vacia.</p>';
                  else if (is_numeric($_POST['descripcion_registro']))
                        $hayerror ['descripcion_registro']='<p style="color:red;">La descripción no puede ser numerica.</p>';

            }

            if (isset($_POST['concierto_editar']) && !isset($hayerror)) {
              $sql = "UPDATE conciertos SET ";
                  $sql.= "fecha='" . htmlentities($_POST["fecha_registro"]) . "'";
                  $sql.= ",lugar='" . htmlentities($_POST["lugar_registro"]) . "'";
                  $sql.= ",descripcion='" . htmlentities($_POST["descripcion_registro"]) . "'";
                  $sql.= "WHERE id_concierto='" .htmlentities($_POST['concierto_editar']) . "'";
                  $resultado = consultarA($sql);

                  echo "<script>alert('Datos modificados correctamente.');window.location.href='gestion_conciertos.php';</script>";

            }

            if(isset($hayerror) && array_key_exists('fecha_registro', $hayerror))
                  echo $hayerror['fecha_registro'];
            if(isset($hayerror) && array_key_exists('lugar_registro', $hayerror))
                  echo $hayerror['lugar_registro'];
            if(isset($hayerror) && array_key_exists('descripcion_registro', $hayerror))
                  echo $hayerror['descripcion_registro'];

            ?>
            <fieldset id="registrarse">
                <table class="tabla_gestion"  cellpadding="10">
                    <tr>
                        <td>
                          <label> ID del concierto a modificar
                            <?php
                            $consulta = "SELECT id_concierto FROM conciertos";
                            $resultado = consultarA($consulta);
                            echo '<select id="tp" name="concierto_editar">';
                            while ($registroActual = mysqli_fetch_array($resultado)) {
                                echo '<option name="concierto_editar" value="'.$registroActual['id_concierto'].'">'.$registroActual['id_concierto'].'</option>';
                            }
                            echo '</select>';
                            ?>
                          </label>
                       </td>
                        <td>
                            <label> Fecha
                                <input name="fecha_registro" class="caja_texto"  type="date" value=""/>
                            </label>
                        </td>
                        <td>
                            <label> Lugar
                                <input name="lugar_registro" class="caja_texto" maxlength="40"  type="text" value="" />
                            </label>
                        </td>
                        <td>
                            <label> Descripcion
                               <textarea name="descripcion_registro" class="caja_texto" maxlength="40" type="text" value=""/>  </textarea>
                            </label>
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

        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        <h2 id="titulo_gestion"> Dar de baja un concierto: </h2>
        <form id="formulario_gestion" name="formulario" method="POST" action="elimina_concierto.php" enctype="multipart/form-data">
            <fieldset class="iniciarSesion">
                <table class="tabla_registrarse">
                    <tr>
                        <td>
                            <label>
                                ID del concierto
                                <?php
                                $consulta = "SELECT id_concierto FROM conciertos";
                                $resultado = consultarA($consulta);
                                echo '<select id="tp" name="concierto_borrar">';
                                while ($registroActual = mysqli_fetch_array($resultado)) {
                                    echo '<option name="concierto_borrar" value="'.$registroActual['id_concierto'].'">'.$registroActual['id_concierto'].'</option>';
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
                                <input type="submit" value="Borrar" />
                                <input type="reset" value="Restablecer" />
                            </td>
                        </tr>
                    </table>
                </fieldset>
        </form>
    </div>


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
                    echo '<li class="info_copia"><a href="borrar_tablas.php"><span>Borrar contenido</span></a></li>';echo '<li class="info_copia"><a href="borrar_tablas.php"><span>Borrar contenido</span></a></li>';
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
