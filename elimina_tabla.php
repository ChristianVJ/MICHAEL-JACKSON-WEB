

<?php
/* /////////// ELIMINA TABLA /////////// */
session_start();
require 'include.php';

if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR: tienes que haber iniciado sesión como administrador.')window.location.href='gestion_usuarios.php';</script>";
}
$consulta = 'SELECT TABLE_NAME as name FROM information_schema.TABLES WHERE TABLE_SCHEMA = "christianam1718" AND TABLE_NAME ="' . $_POST['tabla_borrar'] . '"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 1) {

  $eventolog = "La tabla ". htmlentities($_POST['tabla_borrar']) ." se ha eliminado";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $resultado = consultarA($insercion);
  if($_POST['tabla_borrar'] == "usuarios"){
      $consulta_2 = 'DELETE FROM usuarios WHERE usuario !="' . htmlentities($_SESSION['usuario']) . '"';
  }else{
      $consulta_2 = 'DROP TABLE ' . htmlentities($_POST['tabla_borrar']) . '';
  }

  $resultado_2 = consultarA($consulta_2);

    echo "<script>alert('La tabla se ha dado de baja correctamente.');window.location.href='borrar_tablas.php';</script>";

} else {

  echo "<script>alert('La tabla no existe o no está permitido.');window.location.href='borrar_tablas.php';</script>";

}

?>
