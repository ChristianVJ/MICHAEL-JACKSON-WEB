

<?php
/* /////////// INCLUDE /////////// */
function consultarA($pregunta) {

  $host="localhost";
  $usuario="christianam1718";
  $pass="91bjlGnb";
  $base_datos="christianam1718";

  /*  $host="localhost";
    $usuario="root";
    $pass="pass_ejercicio_pw";
    $base_datos="75897720c";*/

    $conexion = mysqli_connect($host,$usuario,$pass,$base_datos);

    if ($conexion->connect_errno) {

        echo "Problemas en la conexion con la BBDD";
        echo "Error: Fallo al conectarse a MySQL debido a: n";
        echo "Errno: " . $conexion->connect_errno . "n";
        echo "Error: " . $conexion->connect_error . "n";
        exit;
    }

    $conexion->query("SET NAMES 'utf8'");

    mysqli_select_db($conexion, $base_datos);
    $resul = mysqli_query($conexion,$pregunta);

    if ($resul == FALSE) {
        echo '<br>Se siente, no se pudo realizar la consulta: ' . $pregunta . '<br>';
        mysqli_close($conexion);
        exit();
    }

    mysqli_close($conexion);
    return $resul;
}

?>
