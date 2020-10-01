
<?php
/* /////////// ELIMINA CONCIERTO /////////// */
session_start();
require 'include.php';

if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR: tienes que haber iniciado sesión como administrador.')window.location.href='gestion_usuarios.php';</script>";
}

$consulta = 'SELECT id_concierto FROM conciertos WHERE id_concierto="' . $_POST['concierto_borrar'] . '"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 1) {

    $eventolog = "El concierto ". htmlentities($_POST['concierto_borrar']) ." se ha eliminado";
    $insercion = "INSERT INTO log (evento)";
    $insercion.= "VALUES ('$eventolog')";
    $resultado = consultarA($insercion);
    $consulta_2 = 'DELETE FROM conciertos WHERE id_concierto="' . htmlentities($_POST['concierto_borrar']) . '"';
    $resultado_2 = consultarA($consulta_2);
    echo "<script>alert('El concierto se ha eliminado.');window.location.href='gestion_conciertos.php';</script>";

} else {

  echo "<script>alert('El concierto no existe.');window.location.href='gestion_conciertos.php';</script>";

}

?>
