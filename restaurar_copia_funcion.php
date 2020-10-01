
<?php
/* /////////// RESTAURAR COPIA /////////// */
session_start();
include ('include.php');
if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR DE SESIÓN: Tienes que ser administrador para acceder. Volviendo a la página de inicio ...');window.location.href='index.php';</script>";
}

function restaurar_copia($host, $usuario, $pass, $base_datos, $location){

    $conn = new mysqli($host, $usuario, $pass, $base_datos);
    $sql = '';
    $lines = file($location);
    $output = array('error'=>false);

    foreach ($lines as $line){

        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }

        $sql .= $line;

        if (substr(trim($line), -1, 1) == ';'){

            $query = $conn->query($sql);
            if(!$query){
            	  echo "<script>alert('Base de datos restaurada.');window.location.href='index.php';</script>";
            }
            else{
            	  echo "<script>alert('Error para restaurar la base de datos');window.location.href='index.php';</script>";
            }
            $sql = '';
        }
    }

    return $output;
}


$host="localhost";
$usuario="christianam1718";
$pass="91bjlGnb";
$base_datos="christianam1718";

$filename = $_FILES['sql']['name'];
move_uploaded_file($_FILES['sql']['tmp_name'],'upload/' . $filename);
$file_location = $filename;

$restore = restaurar_copia($host, $usuario, $pass, $base_datos, $file_location);

?>
