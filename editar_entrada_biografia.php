
<!DOCTYPE html>
<?php
    /* /////////// EDITAR BIOGRAFIA /////////// */
    session_start();
    require "funciones_comunes.php";
    include ('include.php');
    if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
        echo "<script>alert('ERROR DE SESIÓN: Tienes que ser administrador para acceder. Volviendo a la página de inicio ...');window.location.href='index.php';</script>";
    }
?>

<html lang="es">

      <head>
          <title> Michael Jackson - Editar entrade biografía </title>
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

<?php
/* /////////// EDITAR ENTRADA BIOGRAFIA /////////// */

if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR: tienes que haber iniciado sesión como administrador.')window.location.href='gestion_usuarios.php';</script>";
}

if (isset($_POST['titulo_editar'])) {

  if(is_numeric($_POST['titulo_editar']))
    $hayerror['titulo_editar'] = '<p style="color:red;">El titulo no puede ser numérico.</p>';
    else if (trim($_POST['titulo_editar']) == '')
          $hayerror ['titulo_editar']='<p style="color:red;">El titulo no puede estar en blanco.</p>';

  if(is_numeric($_POST['parrafo_editar']))
    $hayerror['parrafo_editar'] = '<p style="color:red;">El parrafo no puede ser numérico.</p>';
      else if (trim($_POST['parrafo_editar']) == '')
            $hayerror ['parrafo_editar']='<p style="color:red;">El parrafo no puede estar en blanco.</p>';

}

if (isset($_POST['titulo_editar']) && !isset($hayerror)) {

$sql = 'UPDATE biografia SET ';
    $sql.= "titulo='" . htmlentities($_POST["titulo_editar"]) . "'";
    $sql.= ",parrafo='" . htmlentities($_POST["parrafo_editar"]) . "'";
    $sql.= "WHERE titulo='" .htmlentities($_POST['entrada_editar']) . "'";
    $resultado = consultarA($sql);

    echo "<script>alert('Datos modificados correctamente.');window.location.href='editar_biografia.php';</script>";

}

$consulta = 'SELECT titulo FROM biografia WHERE titulo="' . $_POST['entrada_editar'] . '"';
$resultado = consultarA($consulta);
$entrada_editar = htmlentities($_POST['entrada_editar']);
if (mysqli_num_rows($resultado) == 1) {

  if(isset($hayerror) && array_key_exists('titulo_editar', $hayerror))
        echo $hayerror['titulo_editar'];
  if(isset($hayerror) && array_key_exists('parrafo_editar', $hayerror))
        echo $hayerror['parrafo_editar'];

  echo '<h2 id="titulo_gestion"> Editar a ' . $_POST['entrada_editar'] . ' </h2>';
  echo '<form id="formulario_gestion" name="formulario" method="POST" action="editar_entrada_biografia.php" onsubmit="return comprueba_baja_usuario(this)" enctype="multipart/form-data">';

      echo '<fieldset class="iniciarSesion">';
          echo '<table class="tabla_registrarse">';
            echo '  <tr>';
                  echo '<td>';
                      echo '<label>';
                        echo 'Título';
                        $consulta = 'SELECT titulo FROM biografia WHERE titulo="' . $_POST['entrada_editar'] . '"';
                        $resultado = consultarA($consulta);
                        while ($registroActual = mysqli_fetch_array($resultado)) {
                        echo '<textarea name="titulo_editar" value="">'.$registroActual['titulo'].'</textarea>';
                        }
                  echo '  </label>';
                  echo '  </td>';
                  echo '<td>';
                      echo '  <label> Parrafo';
                      $consulta = 'SELECT parrafo FROM biografia WHERE titulo="' . $_POST['entrada_editar'] . '"';
                      $resultado = consultarA($consulta);
                      while ($registroActual = mysqli_fetch_array($resultado)) {
                      echo '<textarea name="parrafo_editar" value="">'.$registroActual['parrafo'].'</textarea>';
                      }
                      echo '  </label>';
                  echo '  </td>';
            echo '  </tr>';
        echo '  </table>';
    echo '  </fieldset>';
        echo '  <fieldset id="botones">';
            echo '  <table class="tabla_registrarse">';
                echo '  <tr>';
                    echo '  <td>';
                        echo '<input type="hidden" name="entrada_editar" value="'.$entrada_editar.'" />';
                        echo '  <input type="submit" value="Cambiar" />';
                        echo '  <input type="reset" value="Restablecer" />';
                    echo '  </td>';
                echo '  </tr>';
            echo '  </table>';
        echo '  </fieldset>';
echo '  </form>';

} else {

  echo "<script>alert('La entrada no existe.');window.location.href='editar_biografia.php';</script>";

}

?>

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
