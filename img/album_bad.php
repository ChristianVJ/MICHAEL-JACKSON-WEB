<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="es">

      <head>
          <title> Michael Jackson - Página de inicio </title>
          <link rel="shortcut icon" href="https://pm1.narvii.com/6620/29d4c29d07da0798f429844bdc0127865d9cec75_128.jpg" />
          <link rel="stylesheet" title="Estilo ejercicio 7" href="estilo.css" />
          <script type="text/javascript" src="jquery-1.3.2.js"></script>
          <script type="text/javascript" src="validacion.js"></script>
          <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
          <meta name="viewport" content="width=device-width">
          <meta charset='utf-8'>
      </head>

      <body>

        <header>
          <div id="panel_header">
            <a href="index.php"><img src="img/titulo_pagina.png" alt="imagen_titulo_base"></a>
          </div>
        </header>

        <nav id="enlaces_rapidos">
          <ul>
              <li><a href="index.php">Inicio</a></li>
              <li><a href="biografia.php">Biografía</a></li>
              <li><a href="discografia.php">Discografía</a></li>
              <li><a href="conciertos.php">Conciertos</a></li>
              <li><a href="tienda.php">Tienda</a></li>
          </ul>
        </nav>

          <div id="contenido1">

            <div id="izq">
              <h2>BAD (1987)</h2>
              <img src="https://2.bp.blogspot.com/-Nd3LjUo1Lqo/Us_5Lok06bI/AAAAAAAAJlk/nSC8wem8Vsc/s1600/bad.jpg" alt="album_bad" width='200' height='200'>
              <p> Bad es el séptimo álbum de estudio del artista estadounidense Michael Jackson, publicado el 31 de agosto de 1987, con más de 34 millones de copias
                 vendidas y cinco números uno en las listas de Estados Unidos (Billboard Hot 100), lo que lo hace uno de los álbumes más vendidos de todos los tiempos.
                 Fue su reaparición en el mercado, con un álbum, cinco años después de lanzar Thriller y tras múltiples aplazamientos y rumores. </p>
            </div>

            <div id="dcha">

            <table class="tabla_disco">

              <thead>
              <tr>
                <th>Nº</th>
                <th>Duración</th>
                <th>Título</th>
              </tr>
              </thead>


              <tbody>

              <tr>
                <td>1</td>
                <td>4:08</td>
                <td>Bad</td>
              </tr>

              <tr>
                <td>2</td>
                <td>4:59</td>
                <td>The Way You Make Me Feel</td>
              </tr>

              <tr>
                <td>3</td>
                <td>4:01</td>
                <td>Speed Demon</td>
              </tr>

              <tr>
                <td>4</td>
                <td>3:53</td>
                <td>Liberian Girl</td>
              </tr>

              <tr>
                <td>5</td>
                <td>4:07</td>
                <td>Just Good Friends(con Stevie Wonder)</td>
              </tr>

              <tr>
                <td>6</td>
                <td>3:54</td>
                <td>Another Part of Me</td>
              </tr>

              <tr>
                <td>7</td>
                <td>5:19</td>
                <td>Man in the Mirror</td>
              <tr>

                <td>8</td>
                <td>4:14</td>
                <td>I Just Can't Stop Loving You (con Siedah Garrett)</td>
              </tr>

              <tr>
                <td>9</td>
                <td>4:41</td>
                <td>Dirty Diana</td>
              </tr>

              <tr>
                <td>10</td>
                <td>4:17</td>
                <td>Smooth Criminal</td>
              </tr>

              <tr>
                <td>11</td>
                <td>4:40</td>
                <td>Leave Me Alone</td>
              </tr>

             </tbody>
            </table>
          </div>
          </div>

          <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <?php
          //Dependiendo del tipo de usuario conectado, se realizan unas acciones u otras
          if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])) { //revisamos que haya iniciado sesion
              switch ($_SESSION['tipo']) {
                  case 'administrador': //Acciones a realiza si el usuario conectado está como administrador
                      echo '<ul id="navigation">';
                      echo '<li class="cerrar_sesion"><a href="menu_cerrar_sesion.php"><span>Cerrar sesión</span></a></li>';
                      echo '<li class="info_componentes"><a href="editar_integrantes.php" ><span>Editar información de componentes</span></a></li>';
                      echo '<li class="info_biografia"><a href="editar_biografia.php" ><span>Editar biografía</span></a></li>';
                      echo '<li class="info_discografia"><a href="editar_discografia.php" ><span>Editar discografía</span></a></li>';
                      echo '<li class="info_conciertos"><a href="gestion_conciertos.php"><span>Editar conciertos</span></a></li>';
                      echo '<li class="info_usuarios"><a href="gestion_usuarios.php" ><span>Gestión de usuarios</span></a></li>';
                      echo '<li class="info_log_eventos"><a href="visualizar_log.php" ><span>Visualizar log</span></a></li>';
                      echo '</ul>';
                      break;
                  case 'gestor': //Acciones a realiza si el usuario conectado está como profesor
                      echo '<ul id="navigation">';
                      echo '<li class="cerrar_sesion"><a href="menu_cerrar_sesion.php"><span>Cerrar sesión</span></a></li>';
                      echo '<li class="gestion_peticiones"><a href="gestionar_peticiones.php"><span>Gestionar peticiones</span></a></li>';
                      echo '<li class="historico_compras"><a href="historico_compras.php"><span>Historial de compras</span></a></li>';
                      echo '<li class="editar_precio"><a href="editar_precio_discos.php"><span>Editar precios de discos</span></a></li>';
                      echo '</ul>';
                      break;
              }
            } else {  //Acciones a realizar si el usuario conectado está como invitado
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
          <footer>
            <p>© 2018 MJJ Music. Powered by Sony Music Entertainment. All Rights Reserved. Christian Andrades Molina</p>
            <ul>
               <li><a href="#" title=""><img src="https://image.flaticon.com/icons/svg/8/8730.svg"><span><i aria-hidden="true" class="icon-facebook">
               </i></span></a></li>
               <li><a href="#" title=""><img src="https://image.flaticon.com/icons/svg/9/9148.svg"><span><i aria-hidden="true" class="icon-google-plus">
               </i></span></a> </li>
               <li><a href="#" title=""><img src="https://image.flaticon.com/icons/svg/48/48898.svg"><span><i aria-hidden="true" class="icon-twitter">
               </i></span></a> </li>
            </ul>
          </footer>

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


</html>
