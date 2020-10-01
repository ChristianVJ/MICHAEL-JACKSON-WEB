
<?php
/* ////////// ELIMINA ENTRADA /////////// */
session_start();
require 'include.php';

if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR: tienes que haber iniciado sesión como administrador.')window.location.href='gestion_usuarios.php';</script>";
}

$consulta = 'SELECT titulo FROM biografia WHERE titulo="' . $_POST['entrada_borrar'] . '"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 1) {

  $eventolog = "La entrada ". htmlentities($_POST['entrada_borrar']) ." se ha eliminado";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $resultado = consultarA($insercion);
  $consulta_2 = 'DELETE FROM biografia WHERE titulo="' . $_POST['entrada_borrar'] . '"';
  $resultado_2 = consultarA($consulta_2);

    echo "<script>alert('La entrada se ha eliminado.');window.location.href='biografia.php';</script>";

} else {

  echo "<script>alert('La entrada no existe.');window.location.href='editar_biografia.php';</script>";

}

?>
