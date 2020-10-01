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

          <div id="contenido">

            <nav id="navegador_inicio">
                <ul>
                    <li class="green"><a href="jackie_jackson.php" class="icon-home"><img src="http://www2.pictures.zimbio.com/gi/Jackie+Jackson+Ys6FCbJybpTm.jpg" alt="imagen_titulo_base"></a><h2>Jackie Jackson</h2></li>
                    <li class="red"><a href="tito_jackson.php" class="icon-home"><img src="https://mediamass.net/jdd/public/documents/celebrities/1248.jpg" alt="imagen_titulo_base"></a><h2>Tito Jackson</h2></li>
                    <li class="blue"><a href="jermaine_jackson.php" class="icon-home"><img src="https://www.biography.com/.image/ar_1:1%2Cc_fill%2Ccs_srgb%2Cg_face%2Cq_80%2Cw_300/MTE1ODA0OTcxNDkxOTUyMTQx/jermaine-jackson-467390-1-402.jpg" alt="imagen_titulo_base"></a><h2>Jermaine Jackson</h2></li>
                    <li class="purple"><a href="marlon_jackson.php" class="icon-home"><img src="https://mediamass.net/jdd/public/documents/celebrities/1247.jpg" alt="imagen_titulo_base"></a><h2>Marlon Jackson</h2></li>
                    <li class="yellow"><a href="biografia.php" class="icon-home"><img src="https://www.biografiasyvidas.com/biografia/j/fotos/jackson_michael_1.jpg" alt="imagen_titulo_base"></a><h2>Michael Jackson</h2></li>
                </ul>
            </nav>

            <article class="vida_carrera">
    					<section class="vida">
                <div id="izq">
    						<h3>Marlon Jackson</h3>
    						<p>
                  Marlon David Jackson (Gary, 12 de marzo de 1957) es un cantante estadounidense y bailarín,
                  sexto hijo de Joseph Jackson y Katherine Jackson, además de hermano de Michael Jackson y Janet Jackson y miembro de los Jackson Five.
                  A la edad de 18 años, Marlon se casó con Carol Ann Parker y tuvo tres hijos: Valencia, Brittany, y Marlon David Jackson Jr.Uno de sus grandes
                  éxitos como cantante fue en el año 1984, año en que The Jacksons saca el disco "Victory", donde el tema Body, escrito y cantado por él suena
                  en todo el mundo al mismo nivel que otros éxitos de ese disco.
               </p>
               </div>
                <div id="dcha">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6b2DyI-a0-nTI2NknbncmHMxJ5jLXXaV4o_kZHj25AEfA8q_P8A" alt="imagen_titulo_base" width='300' height='300'>
                </div>
    					</section>
    				</article>
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
                      echo '<li class="info_componentes"><a href="" ><span>Editar información de componentes</span></a></li>';
                      echo '<li class="info_biografia"><a href="" ><span>Editar biografía</span></a></li>';
                      echo '<li class="info_discografia"><a href="" ><span>Editar discografía</span></a></li>';
                      echo '<li class="info_conciertos"><a href="gestion_conciertos.php"><span>Editar conciertos</span></a></li>';
                      echo '<li class="info_usuarios"><a href="gestion_usuarios.php" ><span>Gestión de usuarios</span></a></li>';
                      echo '<li class="info_log_eventos"><a href="" ><span>Visualizar log</span></a></li>';
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
