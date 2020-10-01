

<?php
/* /////////// ELIMINA CANCION 2 /////////// */
session_start();
require 'include.php';

if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR: tienes que haber iniciado sesión como administrador.')window.location.href='gestion_usuarios.php';</script>";
}

$consulta = 'SELECT titulo FROM '.$_POST['discoborrar'].' WHERE titulo="' . $_POST['cancion_borrar'] . '"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 1) {

  $eventolog = "La cancion ". htmlentities($_POST['cancion_borrar']) ." se ha eliminado";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $disco = str_replace(' ', '', $_POST['cancion_borrar']);
  $resultado = consultarA($insercion);
  $consulta_2 = 'DELETE FROM '.$_POST['discoborrar'].' WHERE titulo="' . htmlentities($_POST['cancion_borrar']) . '"';
  $resultado_2 = consultarA($consulta_2);

    echo "<script>alert('La canción eliminado.');window.location.href='editar_discografia.php';</script>";

} else {

  echo "<script>alert('La canción no existe.');window.location.href='editar_discografia.php';</script>";

}

?>
