<!DOCTYPE html>

<?php
    /* /////////// GESTIÓN USUARIOS /////////// */
    session_start();
    require "funciones_comunes.php";
    include ('include.php');
    if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
        echo "<script>alert('ERROR DE SESIÓN: Tienes que ser administrador para acceder. Volviendo a la página de inicio ...');window.location.href='index.php';</script>";
    }
?>

<html lang="es">

      <head>
          <title> Michael Jackson - Gestión de usuarios </title>
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
           $consulta = "SELECT * FROM usuarios";
           $resultado = consultarA($consulta);

           echo '<table class= "tabla_conciertos">';
           echo '<tr><th>DNI</th><th>Usuario</th><th>Clave</th><th>Email</th><th>Tipo</th><th>Nombre</th><th>Apellidos</th></tr>';
           while ($registroActual = mysqli_fetch_array($resultado)) {
               echo '<tr>';
               echo '<td>';
               echo $registroActual['DNI'];
               echo '</td><td>';
               echo $registroActual['usuario'];
               echo '</td><td>';
               echo $registroActual['clave'];
               echo '</td><td>';
               echo $registroActual['email'];
               echo '</td><td>';
               echo $registroActual['tipo'];
               echo '</td><td>';
               echo $registroActual['nombre'];
               echo '</td><td>';
               echo $registroActual['apellidos'];
               echo '</td>';

           }

           echo '</tr></table>';
           echo '<br /><br /><br /><br />';
           ?>
        </div>

        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php
        if(isset($_GET['error'])){
            $error=unserialize($_GET['error']);

            if(array_key_exists('dni', $error)){
                echo $error['dni'];
            }
            if(array_key_exists('nombre_registro', $error)){
                echo $error['nombre_registro'];
            }
            if(array_key_exists('apellidos_registro', $error)){
                echo $error['apellidos_registro'];
            }
            if(array_key_exists('nombre_usuario_registro', $error)){
                echo $error['nombre_usuario_registro'];
            }
            if(array_key_exists('correo_registro', $error)){
                echo $error['correo_registro'];
            }
            if(array_key_exists('password_registro', $error)){
                echo $error['password_registro'];
            }
        }
        ?>
        <h2 id="titulo_gestion">Nuevo administrador/gestor:</h2>
        <form id="formulario_gestion" method="post" action="comprobar_registro.php" >
            <fieldset id="registrarse">
                <table class="tabla_gestion" cellpadding="10">
                    <tr>
                        <td>
                            <label> DNI
                                <input name="dni" class="caja_texto" maxlength="40" type="text" value=""/>
                            </label>
                        </td>
                        <td>
                            <label> Nombre
                                <input name="nombre_registro" class="caja_texto" maxlength="40" type="text" value="" />
                            </label>
                        </td>
                        <td>
                            <label> Apellidos
                                <input name="apellidos_registro" class="caja_texto" maxlength="40" type="text" value=""/>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                Nombre de usuario
                                <input name="nombre_usuario_registro" class="caja_texto" maxlength="40" type="text" value=""/>
                            </label>
                        </td>

                        <td>
                            <label>
                                Correo electrónico
                                <input name="correo_registro" class="caja_texto" maxlength="40" type="text" value=""/>
                            </label>
                        </td>
                        <td>
                            <label>
                                Crea una contraseña
                                <input name="password_registro" class="caja_texto" type="password" value=""/>
                            </label>
                        </td>
                    </tr>
                </table>
                    Registrarse como:
                    <input type="radio" name="registrarse_como"  checked value="administrador"/>Administrador
                    <input type="radio" name="registrarse_como" value="gestor"/>Gestor
            </fieldset>
            <!-- Tabla de registro para botones -->
            <fieldset id="botones">
                <table class="tabla_registrarse">
                    <tr>
                        <td>
                            <input type="submit" value="Registrarse" />
                            <input type="reset" value="Borrar" />
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>


        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        <h2 id="titulo_gestion"> Modificar datos del administrador/gestor: </h2>
        <form id="formulario_gestion" method="post" action="gestion_usuarios.php" >
            <?php

            if (isset($_POST['usuario_registro'])) {

              if(trim($_POST['dni_registro']) == '')
                      $hayerror ['dni_registro']='<p style="color:red;">El DNI no puede estar vacio.</p>';
                  else if (!is_numeric($_POST['dni_registro']))
                      $hayerror ['dni_registro']='<p style="color:red;">El DNI debe ser numerico.</p>';
                      else if(strlen($_POST['dni_registro'])!== 8)
                          $hayerror ['dni_registro']='<p style="color:red;">El DNI debe tener 8 cifras.</p>';

              if(trim($_POST['nombre_registro']) == '')
                      $hayerror ['nombre_registro']='<p style="color:red;">El nombre no puede estar vacio</p>';
                  else if (is_numeric($_POST['nombre_registro']))
                      $hayerror ['nombre_registro']='<p style="color:red;">El nombre no puede ser numerico.</p>';

              if(trim($_POST['apellidos_registro']) == '')
                      $hayerror ['apellidos_registro']='<p style="color:red;">El apellido no puede estar vacio</p>';
                  else if (is_numeric($_POST['apellidos_registro']))
                      $hayerror ['apellidos_registro']='<p style="color:red;">El apellido no puede ser numerico.</p>';

              if(trim($_POST['correo_registro']) == '')
                      $hayerror ['correo_registro']='<p style="color:red;">El email no puede estar vacio</p>';
                  else if (is_numeric($_POST['correo_registro']))
                      $hayerror ['correo_registro']='<p style="color:red;">El email no puede ser numerico.</p>';
                      else if(!filter_var($_POST['correo_registro'], FILTER_VALIDATE_EMAIL))
                          $hayerror ['correo_registro']='<p style="color:red;">El email no tiene el formato correcto.</p>';

              if(trim($_POST['password_registro']) == '')
                      $hayerror ['password_registro']='<p style="color:red;">La contraseña no puede estar vacia</p>';
                  else if (is_numeric($_POST['password_registro']))
                      $hayerror ['password_registro']='<p style="color:red;">La contraseña no puede ser numerica.</p>';

            }

            if (isset($_POST['usuario_registro']) && !isset($hayerror)) {

            $sql = "UPDATE usuarios SET ";
                $sql.= "nombre='" . htmlentities($_POST["nombre_registro"]) . "'";
                $sql.= ",clave='" . htmlentities($_POST["password_registro"]) . "'";
                $sql.= ",email='" . htmlentities($_POST["correo_registro"]) . "'";
                $sql.= ",apellidos='" . htmlentities($_POST["apellidos_registro"]) . "'";
                $sql.= ",DNI='" . htmlentities($_POST["dni_registro"]) . "'";
                $sql.= ",tipo='" . htmlentities($_POST["tipo_registro"]) . "'";
                $sql.= "WHERE usuario='" .htmlentities($_POST['usuario_registro']) . "'";
                $resultado = consultarA($sql);

                echo "<script>alert('Datos modificados correctamente.');window.location.href='gestion_usuarios.php';</script>";
            }

            if(isset($hayerror) && array_key_exists('dni_registro', $hayerror))
                  echo $hayerror['dni_registro'];
            if(isset($hayerror) && array_key_exists('nombre_registro', $hayerror))
                  echo $hayerror['nombre_registro'];
            if(isset($hayerror) && array_key_exists('apellidos_registro', $hayerror))
                  echo $hayerror['apellidos_registro'];
            if(isset($hayerror) && array_key_exists('correo_registro', $hayerror))
                  echo $hayerror['correo_registro'];
            if(isset($hayerror) && array_key_exists('password_registro', $hayerror))
                  echo $hayerror['password_registro'];

            ?>
            <fieldset id="registrarse">
                <table class="tabla_gestion"  cellpadding="10">
                    <tr>
                        <td>
                          <label> Usuario a modificar
                            <?php
                            $consulta = "SELECT usuario FROM usuarios";
                            $resultado = consultarA($consulta);
                            echo '<select id="tp" name="usuario_registro">';
                            while ($registroActual = mysqli_fetch_array($resultado)) {
                                echo '<option name="usuario_registro" value='.$registroActual['usuario'].'>'.$registroActual['usuario'].'</option>';
                            }
                            echo '</select>';
                            ?>
                          </label>
                       </td>
                        <td>
                            <label> DNI
                                <input name="dni_registro" class="caja_texto" maxlength="40"   type="text" value=""/>
                            </label>
                        </td>
                        <td>
                            <label> Nombre
                                <input name="nombre_registro" class="caja_texto" maxlength="40"   type="text" value=""/>
                            </label>
                        </td>
                        <td>
                            <label> Apellidos
                                <input name="apellidos_registro" class="caja_texto" maxlength="40" type="text" value=""/>
                            </label>
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <label>
                                Correo electrónico
                                <input name="correo_registro" class="caja_texto" maxlength="40" type="text" value=""/>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="tipo_registro"  checked value="administrador"/>Administrador
                                <input type="radio" name="tipo_registro" value="gestor"/>Gestor
                            </label>
                        </td>
                        <td>
                            <label>
                                Crea una contraseña
                                <input name="password_registro" class="caja_texto" type="password" value=""/>
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


        <h2 id="titulo_gestion"> Dar de baja un administrador/gestor: </h2>
        <form id="formulario_gestion" name="formulario" method="POST" action="elimina_usuario.php" enctype="multipart/form-data">
            <fieldset class="iniciarSesion">
                <table class="tabla_gestion">
                    <tr>
                        <td>
                            <label>
                                Usuario<br/>
                                <?php
                                $consulta = "SELECT usuario FROM usuarios";
                                $resultado = consultarA($consulta);
                                echo '<select id="tp" name="usuario_borrar">';
                                while ($registroActual = mysqli_fetch_array($resultado)) {
                                    echo '<option name="usuario_borrar" value="'.$registroActual['usuario'].'">'.$registroActual['usuario'].'</option>';
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
