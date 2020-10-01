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
          <title> Michael Jackson - Editar integrante </title>
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

/* /////////// EDITAR INTEGRANTE /////////// */

if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR: tienes que haber iniciado sesión como administrador.')window.location.href='gestion_usuarios.php';</script>";
}


if (isset($_POST['nombre_editar'])) {

  if(trim($_POST['nombre_editar']) == '')
          $hayerror ['nombre_editar']='<p style="color:red;">El nombre del grupo no puede estar vacio.</p>';
      else if (is_numeric($_POST['nombre_editar']))
            $hayerror ['nombre_editar']='<p style="color:red;">El nombre del grupo no puede ser numerico.</p>';

  if(trim($_POST['descripcion_editar']) == '')
          $hayerror ['descripcion_editar']='<p style="color:red;">La descripción del grupo no puede estar vacia.</p>';
      else if (is_numeric($_POST['descripcion_editar']))
            $hayerror ['descripcion_editar']='<p style="color:red;">La descripción del grupo no puede ser numerica.</p>';

  if(trim($_POST['foto_editar']) == '')
            $hayerror ['foto_editar']='<p style="color:red;">La foto del grupo no puede estar vacia.</p>';
      else if (is_numeric($_POST['foto_editar']))
            $hayerror ['foto_editar']='<p style="color:red;">La foto del grupo no puede ser numerica.</p>';

}

if (isset($_POST['nombre_editar']) && !isset($hayerror)) {

$sql = 'UPDATE grupo SET ';
    $sql.= "nombre='" . htmlentities($_POST["nombre_editar"]) . "'";
    $sql.= ",descripcion='" . htmlentities($_POST["descripcion_editar"]) . "'";
    $sql.= ",foto='" . htmlentities($_POST["foto_editar"]) . "'";
    $sql.= "WHERE nombre='" .htmlentities($_POST['integrante']) . "'";
    $resultado = consultarA($sql);

    echo "<script>alert('Datos modificados correctamente.');window.location.href='editar_integrantes.php';</script>";

}

$consulta = 'SELECT nombre FROM grupo WHERE nombre="' . $_POST['integrante'] . '"';
$resultado = consultarA($consulta);
$integrante = htmlentities($_POST['integrante']);
if (mysqli_num_rows($resultado) == 1) {

  if(isset($hayerror) && array_key_exists('nombre_editar', $hayerror))
        echo $hayerror['nombre_editar'];
  if(isset($hayerror) && array_key_exists('descripcion_editar', $hayerror))
        echo $hayerror['descripcion_editar'];
 if(isset($hayerror) && array_key_exists('foto_editar', $hayerror))
        echo $hayerror['foto_editar'];

  echo '<h2 id="titulo_gestion"> Editar a ' . $_POST['integrante'] . ' </h2>';
  echo '<form id="formulario_gestion" name="formulario" method="POST" action="editar_integrante.php" onsubmit="return comprueba_baja_usuario(this)" enctype="multipart/form-data">';

      echo '<fieldset class="iniciarSesion">';
          echo '<table class="tabla_registrarse">';
            echo '  <tr>';
                  echo '<td>';
                      echo '<label>';
                        echo 'Nombre';
                        $consulta = 'SELECT nombre FROM grupo WHERE nombre="' . $_POST['integrante'] . '"';
                        $resultado = consultarA($consulta);
                        while ($registroActual = mysqli_fetch_array($resultado)) {
                        echo '<textarea name="nombre_editar" value="">'.$registroActual['nombre'].'</textarea>';
                        }
                  echo '  </label>';
                  echo '  </td>';
                  echo '<td>';
                      echo '  <label> Descripción';
                      $consulta = 'SELECT descripcion FROM grupo WHERE nombre="' . $_POST['integrante'] . '"';
                      $resultado = consultarA($consulta);
                      while ($registroActual = mysqli_fetch_array($resultado)) {
                      echo '<textarea name="descripcion_editar" value="">'.$registroActual['descripcion'].'</textarea>';
                      }
                      echo '  </label>';
                  echo '  </td>';
                  echo '  <td>';
                      echo '  <label> Foto';
                      $consulta = 'SELECT foto FROM grupo WHERE nombre="' . $_POST['integrante'] . '"';
                      $resultado = consultarA($consulta);
                      while ($registroActual = mysqli_fetch_array($resultado)) {
                      echo '<textarea name="foto_editar" value="">'.$registroActual['foto'].'</textarea>';
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
                        echo '<input type="hidden" name="integrante" value="'.$integrante.'" />';
                        echo '  <input type="submit" value="Cambiar" />';
                        echo '  <input type="reset" value="Restablecer" />';
                    echo '  </td>';
                echo '  </tr>';
            echo '  </table>';
        echo '  </fieldset>';
echo '  </form>';

} else {

  echo "<script>alert('El integrante no existe.');window.location.href='editar_integrantes.php';</script>";

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
