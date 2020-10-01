

<?php
/* /////////// ELIMINA INTEGRANTE /////////// */
session_start();
require 'include.php';

if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR: tienes que haber iniciado sesión como administrador.')window.location.href='gestion_usuarios.php';</script>";
}

$consulta = 'SELECT nombre FROM grupo WHERE nombre="' . $_POST['integrante_borrar'] . '"';
$resultado = consultarA($consulta);

echo $_POST['integrante_borrar'];
echo mysqli_num_rows($resultado);

if (mysqli_num_rows($resultado) == 1) {

  $eventolog = "El integrante ". htmlentities($_POST['integrante_borrar']) ." se ha eliminado";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $resultado = consultarA($insercion);
  $consulta_2 = 'DELETE FROM grupo WHERE nombre="' . htmlentities($_POST['integrante_borrar']) . '"';
  $resultado_2 = consultarA($consulta_2);

    echo "<script>alert('El miembro se ha eliminado.');window.location.href='biografia.php';</script>";

} else {

  echo "<script>alert('El miembro no existe.');window.location.href='editar_biografia.php';</script>";

}

?>
