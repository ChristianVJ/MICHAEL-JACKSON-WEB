
<?php
/* /////////// ELIMINA DISCO /////////// */
session_start();
require 'include.php';

if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR: tienes que haber iniciado sesión como administrador.')window.location.href='gestion_usuarios.php';</script>";
}

$consulta = 'SELECT titulo FROM discografia WHERE titulo="' . $_POST['disco_borrar'] . '"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 1) {

  $eventolog = "El disco ". htmlentities($_POST['disco_borrar']) ." se ha eliminado";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $disco = str_replace(' ', '', $_POST['disco_borrar']);
  $resultado = consultarA($insercion);
  $consulta_2 = 'DELETE FROM discografia WHERE titulo="' . htmlentities($_POST['disco_borrar']) . '"';
  $resultado_2 = consultarA($consulta_2);
  $consulta_3 = "DROP TABLE $disco";
  $resultado_3 = consultarA($consulta_3);

    echo "<script>alert('El disco se ha eliminado.');window.location.href='editar_discografia.php';</script>";

} else {

  echo "<script>alert('El disco no existe.');window.location.href='editar_discografia.php';</script>";

}

?>
