
<?php
/* /////////// COMPROBAR CANCIÓN /////////// */
session_start();
require 'include.php';

    if(trim($_POST['titulo_cancion']) == '')
      $hayerror ['titulo_cancion']='<p style="color:red;">El titulo no puede estar vacio.</p>';
    else if (is_numeric($_POST['titulo_cancion']))
      $hayerror ['titulo_cancion']='<p style="color:red;">El titulo no debe ser numerico.</p>';

    if(trim($_POST['duracion_cancion']) == '')
      $hayerror ['duracion_cancion']='<p style="color:red;">La duración no puede estar vacia.</p>';

if(isset($hayerror)){
    $hayerror = serialize($hayerror);
    $hayerror= urlencode($hayerror);
    header("Location: editar_discografia.php?errorr=".$hayerror);

}else{

$disco = str_replace(' ', '', $_POST['buscar_disco']);
$consulta = 'SELECT numero, duracion, titulo FROM '.$disco.' WHERE titulo="' . $_POST['titulo_cancion'] . '" && duracion = "' . $_POST['duracion_cancion'] .'"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 0) {

  $eventolog = "La cancion ". htmlentities($_POST['titulo_cancion'])  ." se ha añadido";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $resultado = consultarA($insercion);
  $insercion = "INSERT INTO $disco (duracion,titulo)";
  $insercion.= "VALUES ('" . htmlentities($_POST['duracion_cancion']) . "','" . htmlentities($_POST['titulo_cancion']) . "')";
  $resultado = consultarA($insercion);

        if ($resultado) {
            echo "<script>alert('Canción añadida correctamente.');window.location.href='editar_discografia.php';</script>";
        }
	  }
}

?>

<script>
    alert('La canción ya existe');
    window.location.href='editar_discografia.php';
</script>
