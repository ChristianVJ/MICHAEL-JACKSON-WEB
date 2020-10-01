

<?php
/* /////////// ELIMINA USUARIO /////////// */
session_start();
require 'include.php';

if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR: tienes que haber iniciado sesión como administrador.')window.location.href='gestion_usuarios.php';</script>";
}

$consulta = 'SELECT usuario FROM usuarios WHERE usuario="' . $_POST['usuario_borrar'] . '"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 1 && $_POST['usuario_borrar'] != $_SESSION['usuario']) {

  $eventolog = "El usuario ". htmlentities($_POST['usuario_borrar']) ." se ha eliminado";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $resultado = consultarA($insercion);
  $consulta_2 = 'DELETE FROM usuarios WHERE usuario="' . htmlentities($_POST['usuario_borrar']) . '"';
  $resultado_2 = consultarA($consulta_2);

    echo "<script>alert('El usuario se ha dado de baja correctamente.');window.location.href='gestion_usuarios.php';</script>";

} else {

  echo "<script>alert('El usuario no existe o no está permitido.');window.location.href='gestion_usuarios.php';</script>";

}

?>
