

<?php
/* /////////// COMPROBAR REGISTRO /////////// */

session_start();
require 'include.php';

if(trim($_POST['dni']) == '')
        $hayerror ['dni']='<p style="color:red;">El DNI no puede estar vacio.</p>';
    else if (!is_numeric($_POST['dni']))
        $hayerror ['dni']='<p style="color:red;">El DNI debe ser numerico.</p>';
        else if(strlen($_POST['dni'])!== 8)
            $hayerror ['dni']='<p style="color:red;">El DNI debe tener 8 cifras.</p>';

if(trim($_POST['nombre_registro']) == '')
        $hayerror ['nombre_registro']='<p style="color:red;">El nombre no puede estar vacio</p>';
    else if (is_numeric($_POST['nombre_registro']))
        $hayerror ['nombre_registro']='<p style="color:red;">El nombre no puede ser numerico.</p>';

if(trim($_POST['apellidos_registro']) == '')
        $hayerror ['apellidos_registro']='<p style="color:red;">El apellido no puede estar vacio</p>';
    else if (is_numeric($_POST['apellidos_registro']))
        $hayerror ['apellidos_registro']='<p style="color:red;">El apellido no puede ser numerico.</p>';

if(trim($_POST['nombre_usuario_registro']) == '')
      $hayerror ['nombre_usuario_registro']='<p style="color:red;">El usuario no puede estar vacio</p>';
    else if (is_numeric($_POST['nombre_usuario_registro']))
        $hayerror ['nombre_usuario_registro']='<p style="color:red;">El usuario no puede ser numerico.</p>';

if(trim($_POST['correo_registro']) == '')
        $hayerror ['correo_registro']='<p style="color:red;">El email no puede estar vacio</p>';
    else if (is_numeric($_POST['correo_registro']))
        $hayerror ['correo_registro']='<p style="color:red;">El email no puede ser numerico.</p>';
        else if(!filter_var($_POST['correo_registro'], FILTER_VALIDATE_EMAIL))
            $hayerror ['correo_registro']='<p style="color:red;">El email no tiene el formato correcto.</p>';

if(trim($_POST['password_registro']) == '')
        $hayerror ['password_registro']='<p style="color:red;">La contraseña no puede estar vacia</p>';
    else if (is_numeric($_POST['password_registro']))
        $hayerror ['password_registro']='<p style="color:red;">La contraseña no puede ser numerica.</p>';

if(isset($hayerror)){
    $hayerror = serialize($hayerror);
    $hayerror= urlencode($hayerror);
    header("Location: gestion_usuarios.php?error=".$hayerror);

}else{

$consulta = 'SELECT usuario FROM usuarios WHERE usuario="' . $_POST['nombre_usuario_registro'] . '"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 0) {

    if ($_POST['registrarse_como'] == 'administrador') {

      $eventolog = "El usuario administrador ". $_POST['nombre_usuario_registro'] ." se ha añadido al sistema";
      $insercion = "INSERT INTO log (evento)";
      $insercion.= "VALUES ('$eventolog')";
      $resultado = consultarA($insercion);
      $insercion = "INSERT INTO usuarios (dni, usuario, clave, email, tipo, nombre, apellidos)";
      $insercion.= "VALUES ('" . htmlentities($_POST['dni']) . "','" . htmlentities($_POST['nombre_usuario_registro']) . "','" . htmlentities($_POST['password_registro']) . "','" . htmlentities($_POST['correo_registro']) . "','" . htmlentities($_POST['registrarse_como']) . "','" . htmlentities($_POST['nombre_registro']) . "','" . htmlentities($_POST['apellidos_registro']) . "')";
      $resultado = consultarA($insercion);

      if ($resultado) {
            echo "<script>alert('Administrador creado correctamente.\\nYa puede iniciar sesion.');window.location.href='gestion_usuarios.php';</script>";
      }

    } else if ($_POST['registrarse_como'] == 'gestor') {

      $eventolog = "El usuario gestor ". $_POST['nombre_usuario_registro'] ." se ha añadido al sistema";
      $insercion = "INSERT INTO log (evento)";
      $insercion.= "VALUES ('$eventolog')";
      $resultado = consultarA($insercion);
      $insercion = "INSERT INTO usuarios (dni, usuario, clave, email, tipo, nombre, apellidos)";
      $insercion.= "VALUES ('" . htmlentities($_POST['dni']) . "','" . htmlentities($_POST['nombre_usuario_registro']) . "','" . htmlentities($_POST['password_registro']) . "','" . htmlentities($_POST['correo_registro']) . "','" . htmlentities($_POST['registrarse_como']) . "','" . htmlentities($_POST['nombre_registro']) . "','" . htmlentities($_POST['apellidos_registro']) . "')";
      $resultado = consultarA($insercion);

        if ($resultado) {
            echo "<script>alert('Gestor creado correctamente.\\nYa puede iniciar sesion.');window.location.href='gestion_usuarios.php';</script>";
        }
    }
  }
}

?>

<script>
    alert('El nombre de usuario ya existe');
    window.location.href='gestion_usuarios.php';
</script>
