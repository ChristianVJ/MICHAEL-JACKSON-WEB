

<!DOCTYPE html>

<?php
    /* /////////// TIENDA /////////// */
    session_start();
    require "funciones_comunes.php";
    include ('include.php');
?>

<html lang="es">

<head>
    <title> Michael Jackson - Tienda </title>
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

          <div id="contenido_tienda">
            <?php
            if(isset($_GET['error'])){
                $error=unserialize($_GET['error']);

                if(array_key_exists('nombre_c', $error)){
                    echo $error['nombre_c'];
                }
                if(array_key_exists('apellidos_c', $error)){
                    echo $error['apellidos_c'];
                }
                if(array_key_exists('telefono_c', $error)){
                    echo $error['telefono_c'];
                }
                if(array_key_exists('calle_c', $error)){
                    echo $error['calle_c'];
                }
                if(array_key_exists('email_c', $error)){
                    echo $error['email_c'];
                }
                if(array_key_exists('numero_c', $error)){
                    echo $error['numero_c'];
                }
                if(array_key_exists('mes_c', $error)){
                    echo $error['mes_c'];
                }
                if(array_key_exists('año_c', $error)){
                    echo $error['año_c'];
                }
                if(array_key_exists('cvv_c', $error)){
                    echo $error['cvv_c'];
                }
            }
            ?>
            				<form name="tienda_albums" method="post" action="comprobar_pedido.php" >
            					<fieldset name="album">
            					<legend>ALBUM</legend>

                      <?php
                      if (!isset($_POST['disco_comprar'])) {
                        $consulta = 'SELECT titulo,precio FROM discografia';
                        $resultado = consultarA($consulta);
                        while ($registroActual = mysqli_fetch_array($resultado)) {
                          echo '<input type="checkbox" name="album[]" value="'.$registroActual['titulo'].'" >'.$registroActual['titulo'].' ('.$registroActual['precio'].' €) <br>';
                        }
                      }else{

                        echo '<input type="checkbox" name="album[]" value="'.$_POST['disco_comprar'].'" checked>' . $_POST['disco_comprar'] .' ('. $_POST['precio_comprar'] .' €)<br>';

                      }
                      ?>

            					</fieldset>
            					<fieldset name="personal">
            					<legend> DATOS PERSONALES</legend>
            						<label>Nombre: </label>
            						<input name="nombre_c" type="text" name="nombre" value="" required>
            						<label>Apellidos: </label>
            						<input name="apellidos_c" type="text" name="apellidos" value="" required>
            						<label>Teléfono: </label>
            						<input name="telefono_c" type="tel" name="numero" required><br><br>
            						<label>Calle: </label>
            						<input name="calle_c" type="text" name="dir" value="" required>
            						<label>Email: </label>
            						<input name="email_c" type="text" name="cp" value="" required>
            					</fieldset>
            					<fieldset name="pago">
            					<legend>DATOS DE PAGO</legend>
            						<label for="tp">Método de pago</label>
            							<select id="tp" name="opcion">
                              <option name="opcion" value="CONTRAREMBOLSO">Contrarembolso</option>
              								<option name="opcion" value="VISA">Tarjeta VISA</option>
              								<option name="opcion" value="MASTERCARD">Tarjeta MASTERCARD</option>
              								<option name="opcion" value="DINERS">Tarjeta DINNERS</option>
              								<option name="opcion" value="AMERICAN EXPRESS">Tarjeta AMERICAN EXPRESS</option>
            							</select>
                        <label>Número de tarjeta: </label>
              					<input type="number" name="numero_c" value="">
            						<label>Mes de la tarjeta: </label>
            						<input type="number" name="mes_c" min="1" max="12" step="1" name="mes_c" value=""><br><br>
                        <label>Año de la tarjeta: </label>
                        <input type="number" name="año_c" min="2018" max="9999" step="1" name="año_c" value="">
            						<label>CVV: </label>
            						<input type="number" name="cvv_c" min="1" max="999" step="1" name="cvv_c" value="">
            					</fieldset>
            					<input type="submit" value="COMPRAR">
                      <input type="reset" value="BORRAR" /> <!-- Borrar los datos escritos -->
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
