
<?php
/* /////////// CERRAR SESIÓN /////////// */
session_start();
require 'include.php';
$eventolog = "El usuario ". $_SESSION['usuario'] ." ha cerrado sesión";
$insercion = "INSERT INTO log (evento)";
$insercion.= "VALUES ('$eventolog')";
$resultado = consultarA($insercion);
session_unset();
session_destroy();
header("Location: index.php");
exit;

?>
