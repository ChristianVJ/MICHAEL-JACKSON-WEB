

<?php
/* /////////// COMPROBAR INTEGRANTE /////////// */
session_start();
require 'include.php';

if(trim($_POST['nombre_grupo']) == '')
        $hayerror ['nombre_grupo']='<p style="color:red;">El nombre del grupo no puede estar vacio.</p>';
    else if (is_numeric($_POST['nombre_grupo']))
          $hayerror ['nombre_grupo']='<p style="color:red;">El nombre del grupo no puede ser numerico.</p>';
if(trim($_POST['descripcion_grupo']) == '')
        $hayerror ['descripcion_grupo']='<p style="color:red;">La descripción del grupo no puede estar vacia</p>';
    else if (is_numeric($_POST['descripcion_grupo']))
          $hayerror ['descripcion_grupo']='<p style="color:red;">La descripción del grupo no puede ser numerica.</p>';
if(trim($_POST['foto_grupo']) == '')
          $hayerror ['foto_grupo']='<p style="color:red;">La foto del grupo no puede estar vacia</p>';
    else if (is_numeric($_POST['foto_grupo']))
          $hayerror ['foto_grupo']='<p style="color:red;">La foto del grupo no puede ser numerica.</p>';

if(isset($hayerror)){

    $hayerror = serialize($hayerror);
    $hayerror= urlencode($hayerror);
    header("Location: editar_integrantes.php?error=".$hayerror);

}else{

$consulta = 'SELECT nombre FROM grupo WHERE nombre="' . $_POST['nombre_grupo'] . '"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 0) {

  $eventolog = "El integrante ". $_POST['nombre_grupo'] ." se ha añadido";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $resultado = consultarA($insercion);
  $insercion = "INSERT INTO grupo (nombre,descripcion,foto)";
  $insercion.= "VALUES ('" . htmlentities($_POST['nombre_grupo']) . "','" . $_POST['descripcion_grupo'] . "','" . htmlentities($_POST['foto_grupo']) . "')";
  $resultado = consultarA($insercion);

        if ($resultado) {
            echo "<script>alert('Integrante creado correctamente.\\nYa puedes visitarlo.');window.location.href='biografia.php';</script>";
        }
    }
}

?>

<script>
    alert('No es posible insertar al nuevo miembro');
    window.location.href='registrarse.php';
</script>
