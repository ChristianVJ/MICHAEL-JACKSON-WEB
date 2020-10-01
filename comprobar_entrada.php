

<?php
/* /////////// COMPROBAR ENTRADA /////////// */
session_start();
require 'include.php';

if(trim($_POST['parrafo_entrada']) == '')
        $hayerror ['parrafo_entrada']='<p style="color:red;">El parrafo no puede estar vacio.</p>';
    else if (is_numeric($_POST['parrafo_entrada']))
          $hayerror ['parrafo_entrada']='<p style="color:red;">El parrafo no puede ser numerico.</p>';

if(trim($_POST['titulo_entrada']) == '')
        $hayerror ['titulo_entrada']='<p style="color:red;">El titulo no puede estar vacio</p>';
    else if (is_numeric($_POST['titulo_entrada']))
          $hayerror ['titulo_entrada']='<p style="color:red;">El titulo no puede ser numerico.</p>';

if(isset($hayerror)){

    $hayerror = serialize($hayerror);
    $hayerror= urlencode($hayerror);
    header("Location: editar_biografia.php?error=".$hayerror);

}else{

  $consulta = 'SELECT titulo FROM biografia WHERE titulo="' . $_POST['titulo_entrada'] . '"';
  $resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 0){

  $eventolog = "La entrada en la biografia ". $_POST['titulo_entrada'] ." se ha añadido";
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $resultado = consultarA($insercion);
  $insercion = "INSERT INTO biografia (titulo, parrafo)";
  $insercion.= "VALUES ('" . htmlentities($_POST['titulo_entrada']) . "','" . htmlentities($_POST['parrafo_entrada']) . "')";
  $resultado = consultarA($insercion);

        if ($resultado) {
            echo "<script>alert('Entrada creada correctamente.\\nYa puedes visitarla.');window.location.href='biografia.php';</script>";
        }
    }
}

?>

<script>
    alert('La entrada no es posible insertarla');
    window.location.href='editar_biografia.php';
</script>
