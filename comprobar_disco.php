

<?php
/* /////////// COMPROBAR DISCO /////////// */
session_start();
require 'include.php';

  if(trim($_POST['titulo_disco']) == '')
        $hayerror ['titulo_disco']='<p style="color:red;">El titulo no puede estar vacio.</p>';
    else if (is_numeric($_POST['titulo_disco']))
        $hayerror ['titulo_disco']='<p style="color:red;">El titulo no debe ser numerico.</p>';

  if(trim($_POST['portada_disco']) == '')
        $hayerror ['portada_disco']='<p style="color:red;">La portada no puede estar vacia.</p>';
    else if (is_numeric($_POST['portada_disco']))
        $hayerror ['portada_disco']='<p style="color:red;">La portada no puede ser numerica.</p>';

  if(trim($_POST['descripcion_disco']) == '')
          $hayerror ['descripcion_disco']='<p style="color:red;">La descripción no puede estar vacia.</p>';
    else if (is_numeric($_POST['descripcion_disco']))
                $hayerror ['descripcion_disco']='<p style="color:red;">La descripción no puede ser numerica.</p>';

  if(trim($_POST['año_disco']) == '')
          $hayerror ['año_disco']='<p style="color:red;">El año no puede estar vacio.</p>';
    else if (!is_numeric($_POST['año_disco']))
           $hayerror ['año_disco']='<p style="color:red;">El año debe ser numerico.</p>';
        else if(strlen($_POST['año_disco'])!== 4)
                $hayerror ['año_disco']='<p style="color:red;">El año debe tener 4 cifras.</p>';

if(isset($hayerror)){

    $hayerror = serialize($hayerror);
    $hayerror= urlencode($hayerror);
    header("Location: editar_discografia.php?error=".$hayerror);

}else{

$consulta = 'SELECT titulo, portada, descripcion, año FROM discografia WHERE titulo="' . $_POST['titulo_disco'] . '" && portada = "' . $_POST['portada_disco'] .'" && descripcion = "' . $_POST['descripcion_disco'] .'" && año = "' . $_POST['año_disco'] .'"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 0) {

  $eventolog = "El disco ". $_POST['titulo_disco']  ." se ha añadido";
  $disco = str_replace(' ', '', $_POST['titulo_disco']);
  $insercion = "INSERT INTO log (evento)";
  $insercion.= "VALUES ('$eventolog')";
  $resultado = consultarA($insercion);
  $insercion = "INSERT INTO discografia (titulo,portada,descripcion,año)";
  $insercion.= "VALUES ('" . htmlentities($_POST['titulo_disco']) . "','" . htmlentities($_POST['portada_disco']) . "','" . htmlentities($_POST['descripcion_disco'])  . "','" . htmlentities($_POST['año_disco'])  . "')";
  $resultado = consultarA($insercion);
  $insercion = "CREATE TABLE $disco ( titulo VARCHAR(60) NOT NULL , duracion VARCHAR(6) NOT NULL , numero INT(2) NOT NULL AUTO_INCREMENT , PRIMARY KEY (numero)) ENGINE = InnoDB";
  $resultado2 = consultarA($insercion);

        if ($resultado) {
            echo "<script>alert('Disco creado correctamente.');window.location.href='editar_discografia.php';</script>";
          }
     }
}

?>

<script>
    alert('El disco ya existe');
    window.location.href='editar_discografia.php';
</script>
