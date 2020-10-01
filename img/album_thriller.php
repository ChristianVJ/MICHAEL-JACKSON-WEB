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
          		            <h2>THRILLER (1982)</h2>
          		            <img src="https://images-na.ssl-images-amazon.com/images/I/81gsnp5BwWL._SX355_.jpg" alt="album_thriller" width='200' height='200'>
                          <p> Thriller es el nombre del sexto álbum de estudio del artista estadounidense Michael Jackson. Fue lanzado al mercado el 30 de noviembre de 1982 por Epic Records después del exitoso y aclamado álbum de Jackson Off the Wall de 1979. Incluye géneros similares a los de Off the Wall, incluyendo la música post-disco, el R&B, el pop y el rock. </p>
                        </div>
                        <div id="dcha">
                          <table class="tabla_disco">
                               <thead>
                               <tr>
                                  <th>Número</th>
                                  <th>Duración</th>
                                  <th>Título</th>
                               </tr>
                               </thead>
                               <tbody>
                               <tr>
                                  <td>1</td>
                                  <td>6:03</td>
                                  <td>Wanna Be Startin' Somethin'</td>
                               </tr>
                               <tr>
                                  <td>2</td>
                                  <td>4:20</td>
                                  <td>Baby Be Mine</td>
                               </tr>
                               <tr>
                                  <td>3</td>
                                  <td>3:42</td>
                                  <td>The Girl Is Mine</td>
                               </tr>
                               <tr>
                                  <td>4</td>
                                  <td>5:58</td>
                                  <td>Thriller</td>
                               </tr>
                               <tr>
                                  <td>5</td>
                                  <td>4:18</td>
                                  <td>Beat It</td>
                               </tr>
                               <tr>
                                  <td>6</td>
                                  <td>4:54</td>
                                  <td>Billie Jean</td>
                               </tr>
                               <tr>
                                  <td>7</td>
                                  <td>4:06</td>
                                  <td>Human Nature</td>
                                <tr>
                                  <td>8</td>
                                  <td>3:59</td>
                                  <td>P.Y.T</td>
                                </tr>
                                <tr>
                                  <td>9</td>
                                  <td>4:59</td>
                                  <td>The Lady in My Life</td>
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
            </html>
