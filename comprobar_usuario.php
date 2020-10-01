
<?php
/* /////////// COMPROBAR USUARIO /////////// */
session_start();
require 'include.php';

$consulta = 'SELECT * FROM usuarios WHERE usuario="' . $_POST['usuario'] . '" AND clave="' . $_POST['clave'] . '"';

$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 1) {

    $registroActual = mysqli_fetch_array($resultado);
    $_SESSION['usuario'] = $registroActual['usuario'];
    $_SESSION['tipo'] = $registroActual['tipo'];
    $_SESSION['clave'] = $registroActual['clave'];

    $eventolog = "El usuario ".$_SESSION['usuario']." ha iniciado sesión";
    $insercion = "INSERT INTO log (evento)";
    $insercion.= "VALUES ('$eventolog')";
    $resultado = consultarA($insercion);

    if ($_SESSION['tipo'] == 'administrador'){
        header('Location: index.php');
    } else {
        header('Location: index.php');
    }
}
else{

  $eventolog = "Se ha producido un inicio de sesión incorrecto";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $resultado = consultarA($insercion);
  echo "<script>alert('El usuario no existe.');window.location.href='index.php';</script>";

}

?>
