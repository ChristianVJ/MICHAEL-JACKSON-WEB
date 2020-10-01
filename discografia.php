<!DOCTYPE html>

<?php
    /* /////////// DISCOGRAFÍA /////////// */
    session_start();
    require "funciones_comunes.php";
    include ('include.php');
    if(isset($_POST['disco_comprar'])){
      setcookie('disco', $_POST['disco_comprar'], time()+3600);
    }
?>

<html lang="es">

      <head>
          <title> Michael Jackson - Discografía </title>
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

        <?php


        if(isset($_POST['buscar_palabra'])) {

          $consulta = 'SELECT * FROM discografia WHERE titulo LIKE "%'.$_POST['buscar_palabra'].'%" OR titulo LIKE "%'.$_POST['buscar_palabra'].'%"';
          $resultado = consultarA($consulta);

          while ($registroActual = mysqli_fetch_array($resultado)) {
            echo '<div id="contenido1">';
            echo '<div id="izq">';
            echo '<h2>';
            echo $registroActual['titulo'];
            echo ' </h2>';
            echo '<form  type="post" name="tienda_ropa" method="post" action="tienda.php">';
                echo '<input type="hidden" name="disco_comprar" value="'.$registroActual['titulo'].'"/>';
                echo '<input type="hidden" name="precio_comprar" value="'.$registroActual['precio'].'"/>';
                echo '<input name="submit" type="submit" value="COMPRAR">';
            echo '</form>';
            echo '<img src='.$registroActual['portada'].' alt="imagen_titulo_base" width="200" height="200">';
            echo '<p>';
            echo $registroActual['descripcion'];
            echo '</p>';
            echo '</div>';
            echo '<div id="dcha">';
            echo '<table class="tabla_disco">';
            echo '  <thead>';
              echo '<tr>';
                echo '<th>Nº</th>';
                echo '<th>Duración</th>';
                echo '<th>Título</th>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody>';
            $disco = str_replace(' ', '', $registroActual['titulo']);
            $consulta_2 = 'SELECT * FROM '.$disco.'';
            $resultado_2 = consultarA($consulta_2);
              while ($registroActual_2 = mysqli_fetch_array($resultado_2)) {
                    echo '<tr>';
                      echo '<td>';
                      echo $registroActual_2['numero'];
                      echo '</td>';
                      echo '<td>';
                      echo $registroActual_2['duracion'];
                      echo '</td>';
                      echo '<td>';
                      echo $registroActual_2['titulo'];
                      echo '</td>';
                    echo '</tr>';
            }
                 echo '</tbody>';
                echo '</table>';
              echo '</div>';
            echo '</div>';
          }
        }

        if(isset($_POST['fecha_disco1'])) {
          $consulta = 'SELECT * FROM discografia WHERE año >= "' . $_POST['fecha_disco1'] . '" AND año <= "' . $_POST['fecha_disco2'] . '"' ;
          //Envio la consulta a MySQL.
          $resultado = consultarA($consulta);

          while ($registroActual = mysqli_fetch_array($resultado)) {
            echo '<div id="contenido1">';
            echo '<div id="izq">';
            echo '<h2>';
            echo $registroActual['titulo'];
            echo ' </h2>';
            echo '<form  type="post" name="tienda_ropa" method="post" action="tienda.php">';
                echo '<input type="hidden" name="disco_comprar" value="'.$registroActual['titulo'].'" />';
                echo '<input type="hidden" name="precio_comprar" value="'.$registroActual['precio'].'"/>';
                echo '<input name="submit" type="submit" value="COMPRAR">';
            echo '</form>';
            echo '<img src='.$registroActual['portada'].' alt="imagen_titulo_base" width="200" height="200">';
            echo '<p>';
            echo $registroActual['descripcion'];
            echo '</p>';
            echo '</div>';
            echo '<div id="dcha">';
            echo '<table class="tabla_disco">';
            echo '  <thead>';
              echo '<tr>';
                echo '<th>Nº</th>';
                echo '<th>Duración</th>';
                echo '<th>Título</th>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody>';
            $disco = str_replace(' ', '', $registroActual['titulo']);
            $consulta_2 = 'SELECT * FROM '.$disco.'';
            $resultado_2 = consultarA($consulta_2);
              while ($registroActual_2 = mysqli_fetch_array($resultado_2)) {
                    echo '<tr>';
                      echo '<td>';
                      echo $registroActual_2['numero'];
                      echo '</td>';
                      echo '<td>';
                      echo $registroActual_2['duracion'];
                      echo '</td>';
                      echo '<td>';
                      echo $registroActual_2['titulo'];
                      echo '</td>';
                    echo '</tr>';
            }
                 echo '</tbody>';
                echo '</table>';
              echo '</div>';
            echo '</div>';
          }
        }

        ?>

        <div id="contenido">


          <h2 id="titulo_gestion"> Buscar un disco: </h2>
          <form id="formulario_gestion" name="formulario" method="POST" action="discografia.php">
              <fieldset class="iniciarSesion">
                  <table class="tabla_gestion">
                      <tr>
                          <td>
                              <label> Buscar por: <br/>
                                  <input name="buscar_palabra" class="caja_texto"  type="text" value=""/>
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


      <h2 id="titulo_gestion"> Buscar un disco por fechas : </h2>
      <form id="formulario_gestion" name="formulario" method="POST" action="discografia.php">
          <fieldset class="iniciarSesion">
              <table class="tabla_gestion">
                  <tr>
                    <td>
                        <label> Fecha inicio :
                            <input name="fecha_disco1" class="caja_texto"  type="date" value=""/>
                        </label>
                    </td>
                    <td>
                        <label> Fecha final :
                            <input name="fecha_disco2" class="caja_texto"  type="date" value=""/>
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

        <section id="lossetenta" >
        <h3>1970 - 1980</h3>

        <?php
        $consulta = 'SELECT * FROM discografia WHERE año >= "1970" AND año <= "1980"';
        $resultado = consultarA($consulta);

        while ($registroActual = mysqli_fetch_array($resultado)) {
          echo '<div id="contenido1">';
          echo '<div id="izq">';
          echo '<h2>';
          echo $registroActual['titulo'];
          echo ' </h2>';
          echo '<form  type="post" name="tienda_ropa" method="post" action="tienda.php">';
              echo '<input type="hidden" name="disco_comprar" value="'.$registroActual['titulo'].'" />';
              echo '<input type="hidden" name="precio_comprar" value="'.$registroActual['precio'].'"/>';
              echo '<input name="submit" type="submit" value="COMPRAR">';
          echo '</form>';
          echo '<img src='.$registroActual['portada'].' alt="imagen_titulo_base" width="200" height="200">';
          echo '<p>';
          echo $registroActual['descripcion'];
          echo '</p>';
          echo '</div>';
          echo '<div id="dcha">';
          echo '<table class="tabla_disco">';
          echo '  <thead>';
            echo '<tr>';
              echo '<th>Nº</th>';
              echo '<th>Duración</th>';
              echo '<th>Título</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
          $disco = str_replace(' ', '', $registroActual['titulo']);
          $consulta_2 = 'SELECT * FROM '.$disco.'';
          $resultado_2 = consultarA($consulta_2);
            while ($registroActual_2 = mysqli_fetch_array($resultado_2)) {
                  echo '<tr>';
                    echo '<td>';
                    echo $registroActual_2['numero'];
                    echo '</td>';
                    echo '<td>';
                    echo $registroActual_2['duracion'];
                    echo '</td>';
                    echo '<td>';
                    echo $registroActual_2['titulo'];
                    echo '</td>';
                  echo '</tr>';
          }
               echo '</tbody>';
              echo '</table>';
            echo '</div>';
          echo '</div>';

            }
          ?>
    </section>

            <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

            <section id="losochenta" >
            <h3>1980 - 1990</h3>

                  <?php
                  $consulta = 'SELECT * FROM discografia WHERE año >= "1980" AND año <= "1990"';
                  $resultado = consultarA($consulta);

                  while ($registroActual = mysqli_fetch_array($resultado)) {
                    echo '<div id="contenido1">';
                    echo '<div id="izq">';
                    echo '<h2>';
                    echo $registroActual['titulo'];
                    echo ' </h2>';
                    echo '<form  type="post" name="tienda_ropa" method="post" action="tienda.php">';
                        echo '<input type="hidden" name="disco_comprar" value="'.$registroActual['titulo'].'" />';
                        echo '<input type="hidden" name="precio_comprar" value="'.$registroActual['precio'].'"/>';
                        echo '<input name="submit" type="submit" value="COMPRAR">';
                    echo '</form>';
                    echo '<img src='.$registroActual['portada'].' alt="imagen_titulo_base" width="200" height="200">';
                    echo '<p>';
                    echo $registroActual['descripcion'];
                    echo '</p>';
                    echo '</div>';
                    echo '<div id="dcha">';
                    echo '<table class="tabla_disco">';
                    echo '  <thead>';
                      echo '<tr>';
                        echo '<th>Nº</th>';
                        echo '<th>Duración</th>';
                        echo '<th>Título</th>';
                      echo '</tr>';
                      echo '</thead>';
                      echo '<tbody>';
                    $disco = str_replace(' ', '', $registroActual['titulo']);
                    $consulta_2 = 'SELECT * FROM '.$disco.'';
                    $resultado_2 = consultarA($consulta_2);
                      while ($registroActual_2 = mysqli_fetch_array($resultado_2)) {
                            echo '<tr>';
                              echo '<td>';
                              echo $registroActual_2['numero'];
                              echo '</td>';
                              echo '<td>';
                              echo $registroActual_2['duracion'];
                              echo '</td>';
                              echo '<td>';
                              echo $registroActual_2['titulo'];
                              echo '</td>';
                            echo '</tr>';
                    }
                         echo '</tbody>';
                        echo '</table>';
                      echo '</div>';
                    echo '</div>';
                }

                    ?>
                  </section>

                  <section id="losnoventa" >
                  <h3>1980 - 1990</h3>

                        <?php
                        $consulta = 'SELECT * FROM discografia WHERE año >= "1990" AND año <= "2000"';
                        $resultado = consultarA($consulta);

                        while ($registroActual = mysqli_fetch_array($resultado)) {
                          echo '<div id="contenido1">';
                          echo '<div id="izq">';
                          echo '<h2>';
                          echo $registroActual['titulo'];
                          echo ' </h2>';
                          echo '<form  type="post" name="tienda_ropa" method="post" action="tienda.php">';
                              echo '<input type="hidden" name="disco_comprar" value="'.$registroActual['titulo'].'" />';
                              echo '<input type="hidden" name="precio_comprar" value="'.$registroActual['precio'].'"/>';
                              echo '<input name="submit" type="submit" value="COMPRAR">';
                          echo '</form>';
                          echo '<img src='.$registroActual['portada'].' alt="imagen_titulo_base" width="200" height="200">';
                          echo '<p>';
                          echo $registroActual['descripcion'];
                          echo '</p>';
                          echo '</div>';
                          echo '<div id="dcha">';
                          echo '<table class="tabla_disco">';
                          echo '  <thead>';
                            echo '<tr>';
                              echo '<th>Nº</th>';
                              echo '<th>Duración</th>';
                              echo '<th>Título</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                          $disco = str_replace(' ', '', $registroActual['titulo']);
                          $consulta_2 = 'SELECT * FROM '.$disco.'';
                          $resultado_2 = consultarA($consulta_2);
                            while ($registroActual_2 = mysqli_fetch_array($resultado_2)) {
                                  echo '<tr>';
                                    echo '<td>';
                                    echo $registroActual_2['numero'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $registroActual_2['duracion'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $registroActual_2['titulo'];
                                    echo '</td>';
                                  echo '</tr>';
                          }
                               echo '</tbody>';
                              echo '</table>';
                            echo '</div>';
                          echo '</div>';
                            }
                          ?>
                    </section>
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
