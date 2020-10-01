<!DOCTYPE html>
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
            <a href="index.html"><img src="img/titulo_pagina.png" alt="imagen_titulo_base"></a>
          </div>
        </header>

        <div id="contenido_inicio">
          <p>Michael Joseph Jackson (Gary, Indiana, 29 de agosto de 1958-Los Ángeles, California, 25 de junio de 2009)
            fue un cantante estadounidense, compositor, productor discográfico, bailarín, actor y filántropo. Llamado
            el «Rey del Pop», sus contribuciones a la música, la danza y la moda, junto con su vida personal publicitada
            lo convirtió en una figura mundial en la cultura popular durante más de cuatro décadas. Varios autores lo reconocen
            como la estrella de música pop más exitosa en el mundo. Sin embargo, su música incluyó una amplia acepción de
            subgéneros como el rhythm & blues (soul y funk), rock, disco, hip hop y electrónica.
          </p>
        </div>

        <nav id="navegador_inicio">
            <ul>
                <li class="green"><a href="index.html" class="icon-home"><img src="https://s4.eestatic.com/2016/09/22/cultura/arte/Museos-Barack_Obama-Estados_Unidos-America-Michael_Jackson-Arte_157497107_17097213_854x640.jpg" alt="imagen_titulo_base"></a><h2>Inicio</h2></li>
                <li class="red"><a href="biografia.html" class="icon-home"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRbZNZWSXNExNxPT2bji7X9oJ_WV5mBvVm9WYYasAl59fDs6QyWg" alt="imagen_titulo_base"></a><h2>Biografía</h2></li>
                <li class="blue"><a href="discografia.html" class="icon-home"><img src="http://hdwallpaperbackgrounds.net/wp-content/uploads/2015/11/Michael-Jackson-Black-and-White-HD-Wallpapers-For-Desktop.jpg" alt="imagen_titulo_base"></a><h2>Discografía</h2></li>
                <li class="purple"><a href="conciertos.html" class="icon-home"><img src="https://ep01.epimg.net/elpais/imagenes/2017/08/25/icon/1503651867_852345_1503934348_noticia_normal.jpg" alt="imagen_titulo_base"></a><h2>Conciertos</h2></li>
                <li class="yellow"><a href="tienda.html" class="icon-home"><img src="https://i2-prod.mirror.co.uk/incoming/article9033745.ece/ALTERNATES/s615/Michael-Jackson.jpg" alt="imagen_titulo_base"></a><h2>Tienda</h2></li>
            </ul>
        </nav>

        <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        <?php
        session_start();
        //Dependiendo del tipo de usuario conectado, se realizan unas acciones u otras
        if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])) { //revisamos que haya iniciado sesion
            switch ($_SESSION['tipo']) {
                case 'administrador': //Acciones a realiza si el usuario conectado está como administrador
                    echo $_SESSION['usuario'] . ' (' . $_SESSION['tipo'] . ')';
                    echo '<br/><a href="cerrar_sesion.php"> <b>Cerrar sesión</b></a><br/><br/>';
                    echo '<br/><a href="editar_datos_administrador.php"> <b>Editar datos personales</b></a><br/><br/>';
                    echo '<h3>PROFESORES</h3>';
                    echo '<a href="gestionar_profesores.php"> <b>Gestionar profesores</b></a><br/><br/>';
                    echo '<h3>SISTEMA</h3>';
                    echo '<a href="copia_seguridad.php"> <b>Copia seguridad</b></a><br/>';
                    echo '<br/><a href="restaurar_copia.php"> <b>Restaurar copia seguridad</b></a><br/><br/>';
                    break;
                case 'profesor': //Acciones a realiza si el usuario conectado está como profesor
                    echo $_SESSION['usuario'] . ' (' . $_SESSION['tipo'] . ')';
                    echo '<br/><a href="cerrar_sesion.php"> <b>Cerrar sesión</b></a><br/>';
                    echo '<br/><br/><a href="editar_datos_profesor.php"> <b>Editar datos personales</b></a><br/><br/>';
                    echo '<h3>CURSOS</h3>';
                    echo '<a href="crear_curso.php"> <b>Crear curso</b></a><br/>';
                    echo '<br/><a href="gestionar_cursos.php"> <b>Gestionar cursos</b></a><br/><br/>';
                    echo '<h3>ALUMNOS</h3>';
                    echo '<a href="gestionar_alumnos.php"> <b>Gestionar alumnos</b></a><br/><br/>';
                    break;
                case 'alumno':  //Acciones a realiza si el usuario conectado está como alumno
                    echo $_SESSION['usuario'] . ' (' . $_SESSION['tipo'] . ')';
                    echo '<br/><a href="cerrar_sesion.php"> <b>Cerrar sesión</b></a><br/>';
                    echo '<br/><br/><a href="editar_datos_alumno.php"> <b>Editar datos personales</b></a><br/><br/>';
                    echo '<h3>CURSOS</h3>';
                    echo '<a href="cursos.php"> <b>Matricula nuevo curso</b></a><br/><br/>';
                    echo '<a href="gestionar_cursos_matriculado.php"> <b>Gestionar cursos</b></a><br/><br/>';
                    echo '<h3>SISTEMA</h3>';
                    echo '<a href="baja_usuario.php"> <b>Darse de baja</b></a><br/><br/>';
            }
        } else {  //Acciones a realizar si el usuario conectado está como invitado
            echo 'Invitado';
            echo '<div class ="acceso">';
            echo '<table class="acceso"><tr>';
            echo '<td><a href="iniciar_sesion.php"> <b>Acceder</b></a></td>';
            echo '<td><a href="registrarse.php"> <b>Registrarse</b></a></td></tr></table></div>';
            echo '<ul><li><a href="funcionamiento.php"> Cómo funciona </a></li>';
            echo '<li><a href="quienes_somos.php"> Quiénes somos </a></li></ul><br/>';
        }
        ?>

        <ul id="navigation">
            <li class="home"><a href="" title="Home"></a></li>
            <li class="about"><a href="" title="About"></a></li>
            <li class="search"><a href="" title="Search"></a></li>
            <li class="photos"><a href="" title="Photos"></a></li>
            <li class="rssfeed"><a href="" title="Rss Feed"></a></li>
            <li class="podcasts"><a href="" title="Podcasts"></a></li>
            <li class="contact"><a href="" title="Contact"></a></li>
        </ul>

        <div class="info">
            <a class="back" href="http://www.codrops.com"></a>
            <a href="http://dryicons.com">Icons by DryIcons.com</a>
        </div>

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

            <div id="login">
		              <form action="comprobar_usuario.php" method="post" name="f1" onsubmit="return comprueba_iniciar_sesion(this)">
			                  <fieldset>
				                      <label for="userName" class="fontawesome-user"></label>
				                      <input name="usuario" class="caja_texto" type="text">
				                      <label for="userPwd" class="fontawesome-lock"></label>
				                      <input name="clave" class="caja_texto" type="password" value="" >
				                      <input type="submit" value="Iniciar sesión">
			                  </fieldset>
		              </form>
	          </div>

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
