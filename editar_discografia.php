<!DOCTYPE html>
<?php
    /* /////////// EDITAR DISCOGRAFÍA /////////// */
    session_start();
    require "funciones_comunes.php";
    include ('include.php');
    if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
        echo "<script>alert('ERROR DE SESIÓN: Tienes que ser administrador para acceder. Volviendo a la página de inicio ...');window.location.href='index.php';</script>";
    }
?>

<html lang="es">

      <head>
          <title> Michael Jackson - Editar discografía</title>
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

        <div id="contenido1">
           <?php
                   if(isset($_POST['buscar_disco'])) {

                     $disco = str_replace(' ', '', $_POST["buscar_disco"]);
                     $consulta = 'SELECT * FROM '.$disco.' ';
                     $resultado = consultarA($consulta);
                       echo '<table class= "tabla_conciertos">';
                       echo '<thead><tr><th>Nº</th><th>Duración</th><th>Título</th></tr></thead>';
                       while ($registroActual = mysqli_fetch_array($resultado)) {
                           echo '<tbody><tr>';
                           echo '<td>';
                           echo $registroActual['numero'];
                           echo '</td><td>';
                           echo $registroActual['duracion'];
                           echo '</td><td>';
                           echo $registroActual['titulo'];
                           echo '</td>';
                       }
                       echo '</tr></tbody></table>';
                       echo '<br /><br /><br /><br />';
                   }
                ?>
          </div>

        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php
        if(isset($_GET['error'])){
            $error=unserialize($_GET['error']);

            if(array_key_exists('titulo_disco', $error)){
                echo $error['titulo_disco'];
            }
            if(array_key_exists('portada_disco', $error)){
                echo $error['portada_disco'];
            }
            if(array_key_exists('descripcion_disco', $error)){
                echo $error['descripcion_disco'];
            }
            if(array_key_exists('año_disco', $error)){
                echo $error['año_disco'];
            }
        }
        ?>

        <h2 id="titulo_gestion">Nuevo disco: </h2>
        <form  id="formulario_gestion" method="post" action="comprobar_disco.php">
            <fieldset id="crear_concierto">
                <table class="tabla_gestion" cellpadding="10">
                    <tr>
                        <td>
                            <label> Titulo
                                <textarea name="titulo_disco" class="caja_texto" type="text" value=""/></textarea>
                            </label>
                        </td>
                        <td>
                            <label> Portada
                                <textarea name="portada_disco" class="caja_texto"  type="text" value=""/></textarea>
                            </label>
                        </td>
                        <td>
                            <label>Descripción
                                <textarea name="descripcion_disco" class="caja_texto" type="text" value=""/></textarea>
                            </label>
                        </td>
                        <td>
                            <label>Año
                                <textarea name="año_disco" class="caja_texto"  type="text" value=""/></textarea>
                            </label>
                        <td>
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
        <?php
        if(isset($_GET['errorr'])){

            $error=unserialize($_GET['errorr']);
            if(array_key_exists('titulo_cancion', $error)){
                echo $error['titulo_cancion'];
            }
            if(array_key_exists('duracion_cancion', $error)){
                echo $error['duracion_cancion'];
            }
        }
        ?>

        <h2 id="titulo_gestion">Nueva canción: </h2>
        <form  id="formulario_gestion" method="post" action="comprobar_cancion.php" >
            <fieldset id="crear_concierto">
                <table class="tabla_gestion" cellpadding="10">
                    <tr>
                      <td>
                          <label> Discos: <br/>
                              <?php
                              $consulta = "SELECT DISTINCT titulo FROM discografia";
                              $resultado = consultarA($consulta);
                              echo '<select id="tp" name="buscar_disco">';
                              while ($registroActual = mysqli_fetch_array($resultado)) {
                                  echo '<option name="buscar_disco" value="'.$registroActual['titulo'].'">'.$registroActual['titulo'].'</option>';
                              }
                              echo '</select>';
                              ?>
                          </label>
                      </td>
                        <td>
                            <label> Titulo
                                <input name="titulo_cancion" class="caja_texto" maxlength="40" type="text" value=""/>
                            </label>
                        </td>
                        <td>
                            <label> Duración
                                <input name="duracion_cancion" class="caja_texto" maxlength="40" type="text" value=""/>
                            </label>
                        </td>
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

        <h2 id="titulo_gestion"> Editar canciones de un disco : </h2>
        <form id="formulario_gestion" name="formulario" method="POST" action="editar_cancion.php">
            <fieldset class="iniciarSesion">
                <table class="tabla_gestion">
                    <tr>
                        <td>
                            <label> Disco: <br/>
                                <?php
                                $consulta = "SELECT titulo FROM discografia";
                                $resultado = consultarA($consulta);
                                echo '<select id="tp" name="disco">';
                                while ($registroActual = mysqli_fetch_array($resultado)) {
                                    echo '<option name="disco" value="'.$registroActual['titulo'].'">'.$registroActual['titulo'].'</option>';
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

        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        <h2 id="titulo_gestion"> Editar disco: </h2>
        <form id="formulario_gestion" method="post" action="editar_discografia.php" >
            <?php

            if (isset($_POST['disco_editar']))  {

              if(trim($_POST['titulo_disco']) == '')
                      $hayerror ['titulo_disco']='<p style="color:red;">El titulo no puede estar vacio.</p>';
                  else if (is_numeric($_POST['titulo_disco']))
                      $hayerror ['titulo_disco']='<p style="color:red;">El titulo no debe ser numerico.</p>';

              if(trim($_POST['portada_disco']) == '')
                      $hayerror ['portada_disco']='<p style="color:red;">La portada no puede estar vacia.</p>';
                  else if (is_numeric($_POST['portada_disco']))
                      $hayerror ['portada_disco']='<p style="color:red;">La portada no puede ser numerica.</p>';

              if(trim($_POST['descripcion_disco']) == '')
                      $hayerror ['descripcion_disco']='<p style="color:red;">La descripción no puede estar vacia.</p>';
                  else if (is_numeric($_POST['descripcion_disco']))
                      $hayerror ['descripcion_disco']='<p style="color:red;">La descripción no puede ser numerica.</p>';

              if(trim($_POST['año_disco']) == '')
                    $hayerror ['año_disco']='<p style="color:red;">El año no puede estar vacio.</p>';
                  else if (!is_numeric($_POST['año_disco']))
                      $hayerror ['año_disco']='<p style="color:red;">El año debe ser numerica.</p>';
                      else if(strlen($_POST['año_disco'])!== 4)
                          $hayerror ['año_disco']='<p style="color:red;">El año debe tener 4 cifras.</p>';

            }

            if (isset($_POST['disco_editar']) && !isset($hayerror)) {

            $sql = "UPDATE discografia SET ";
                $sql.= "titulo='" . htmlentities($_POST["titulo_disco"]) . "'";
                $sql.= ",portada='" . htmlentities($_POST["portada_disco"]) . "'";
                $sql.= ",descripcion='" . htmlentities($_POST["descripcion_disco"]) . "'";
                $sql.= ",año='" . htmlentities($_POST["año_disco"]) . "'";
                $sql.= "WHERE titulo='" .htmlentities($_POST['disco_editar']) . "'";
                $resultado = consultarA($sql);
                $disco = str_replace(' ', '', htmlentities($_POST['disco_editar']));
                $disconuevo = str_replace(' ', '', htmlentities($_POST["titulo_disco"]));
                $sql = "ALTER TABLE $disco RENAME $disconuevo" ;
                    $resultado = consultarA($sql);
                echo "<script>alert('Datos modificados correctamente.');window.location.href='editar_discografia.php';</script>";

            }

            if(isset($hayerror) && array_key_exists('titulo_disco', $hayerror))
                  echo $hayerror['titulo_disco'];
            if(isset($hayerror) && array_key_exists('portada_disco', $hayerror))
                  echo $hayerror['portada_disco'];
            if(isset($hayerror) && array_key_exists('descripcion_disco', $hayerror))
                  echo $hayerror['descripcion_disco'];
            if(isset($hayerror) && array_key_exists('año_disco', $hayerror))
                  echo $hayerror['año_disco'];

            ?>
            <fieldset id="registrarse">
                <table class="tabla_gestion"  cellpadding="10">
                    <tr>
                        <td>
                          <label>Disco a modificar
                              <?php
                              $consulta = "SELECT titulo FROM discografia";
                              $resultado = consultarA($consulta);
                              echo '<select id="tp" name="disco_editar">';
                              while ($registroActual = mysqli_fetch_array($resultado)) {
                                  echo '<option name="disco_editar" value="'.$registroActual['titulo'].'">'.$registroActual['titulo'].'</option>';
                              }
                              echo '</select>';
                              ?>
                          </label>
                       </td>
                       <td>
                           <label> Titulo
                               <input name="titulo_disco" class="caja_texto" maxlength="40" type="text" value=""/>
                           </label>
                       </td>
                       <td>
                           <label> Portada
                               <textarea name="portada_disco" class="caja_texto" maxlength="40" type="text" value=""/> </textarea>
                           </label>
                       </td>
                       <td>
                           <label>Descripción
                                <textarea name="descripcion_disco" class="caja_texto" maxlength="40" type="text" value=""/> </textarea>
                           </label>
                       </td>
                       <td>
                           <label>Año
                               <input name="año_disco" class="caja_texto" maxlength="40" type="text" value=""/>
                           </label>
                       <td>
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

        <h2 id="titulo_gestion"> Eliminar un disco: </h2>
        <form id="formulario_gestion" name="formulario" method="POST" action="elimina_disco.php" enctype="multipart/form-data">
            <fieldset class="iniciarSesion">
                <table class="tabla_registrarse">
                    <tr>
                        <td>
                            <label>
                                Titulo
                                <?php
                                $consulta = "SELECT titulo FROM discografia";
                                $resultado = consultarA($consulta);
                                echo '<select id="tp" name="disco_borrar">';
                                while ($registroActual = mysqli_fetch_array($resultado)) {
                                    echo '<option name="disco_borrar" value="'.$registroActual['titulo'].'">'.$registroActual['titulo'].'</option>';
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

            <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

    <h2 id="titulo_gestion"> Eliminar una canción: </h2>
    <form id="formulario_gestion" name="formulario" method="POST" action="elimina_cancion.php" enctype="multipart/form-data">
        <fieldset class="iniciarSesion">
            <table class="tabla_registrarse">
                <tr>
                    <td>
                        <label>
                            Titulo del disco
                            <?php
                            $consulta = "SELECT titulo FROM discografia";
                            $resultado = consultarA($consulta);
                            echo '<select id="tp" name="disco_borrar">';
                            while ($registroActual = mysqli_fetch_array($resultado)) {
                                echo '<option name="disco_borrar" value="'.$registroActual['titulo'].'">'.$registroActual['titulo'].'</option>';
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
