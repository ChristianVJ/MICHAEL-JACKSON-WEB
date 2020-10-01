

<?php
/* /////////// COMPROBAR CONCIERTO /////////// */
session_start();
require 'include.php';

if(trim($_POST['fecha_concierto']) == '')
        $hayerror ['fecha_concierto']='<p style="color:red;">La fecha no puede estar vacia.</p>';
if(trim($_POST['lugar_concierto']) == '')
        $hayerror ['lugar_concierto']='<p style="color:red;">El lugar no puede estar vacio</p>';
    else if (is_numeric($_POST['lugar_concierto']))
          $hayerror ['lugar_concierto']='<p style="color:red;">El lugar no puede ser numerico.</p>';
if(trim($_POST['descripcion_concierto']) == '')
        $hayerror ['descripcion_concierto']='<p style="color:red;">La descripción no puede estar vacia.</p>';
    else if (is_numeric($_POST['descripcion_concierto']))
          $hayerror ['descripcion_concierto']='<p style="color:red;">La descripción no puede ser numerica.</p>';

if(isset($hayerror)){
    $hayerror = serialize($hayerror);
    $hayerror= urlencode($hayerror);
    header("Location: gestion_conciertos.php?error=".$hayerror);

}else{

$consulta = 'SELECT lugar,descripcion FROM conciertos WHERE lugar="' . $_POST['lugar_concierto'] . '" && descripcion = "' . $_POST['descripcion_concierto'] .'"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 0) {

  $eventolog = "El concierto ". $_POST['descripcion_concierto']  ." se ha añadido";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $resultado = consultarA($insercion);
  $insercion = "INSERT INTO conciertos (fecha, lugar, descripcion)";
  $insercion.= "VALUES ('" . htmlentities($_POST['fecha_concierto']) . "','" .htmlentities( $_POST['lugar_concierto']) . "','" . htmlentities($_POST['descripcion_concierto'])  . "')";
  $resultado = consultarA($insercion);

        if ($resultado) {
            echo "<script>alert('Concierto creado correctamente.');window.location.href='gestion_conciertos.php';</script>";
        }
    }
}

?>

<script>
    alert('El concierto ya existe');
    window.location.href='gestion_conciertos.php';
</script>
