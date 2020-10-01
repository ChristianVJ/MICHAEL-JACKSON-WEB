

<?php
/* /////////// COMPROBAR PEDIDO /////////// */
session_start();
require 'include.php';

if(trim($_POST['nombre_c']) == '')
        $hayerror ['nombre_c']='<p style="color:red;">El nombre no puede estar vacio.</p>';
    else if (is_numeric($_POST['nombre_c']))
        $hayerror ['nombre_c']='<p style="color:red;">El nombre no puede ser numerico.</p>';

if(trim($_POST['apellidos_c']) == '')
        $hayerror ['apellidos_c']='<p style="color:red;">El apellido no puede estar vacio.</p>';
    else if (is_numeric($_POST['apellidos_c']))
        $hayerror ['apellidos_c']='<p style="color:red;">El apellido no puede ser numerico.</p>';

if(strlen($_POST['telefono_c'])!== 9)
        $hayerror['telefono_c'] = '<p style="color:red;">El teléfono debe tener 9 cifras.</p>';
    else if (!is_numeric($_POST['telefono_c']))
        $hayerror['telefono_c'] = '<p style="color:red;">El teléfono debe ser numerico.</p>';

if(is_numeric($_POST['calle_c']))
        $hayerror['calle_c'] = '<p style="color:red;">La dirección no puede ser numérica.</p>';

if(trim($_POST['email_c']) == '')
        $hayerror ['email_c']='<p style="color:red;">El email no puede estar vacio.</p>';
    else if (is_numeric($_POST['email_c']))
        $hayerror ['email_c']='<p style="color:red;">El email no puede ser numerico.</p>';
        else if(!filter_var($_POST['email_c'], FILTER_VALIDATE_EMAIL))
            $hayerror ['email_c']='<p style="color:red;">El email no tiene el formato correcto.</p>';

if ( $_POST['opcion'] <> "CONTRAREMBOLSO"){

            if(!is_numeric($_POST['numero_c'])){
                $hayerror['numero_c'] = '<p style="color:red;">El numero de tarjeta debe ser numérico.</p>';
              }else if (trim($_POST['numero_c']) == ''){
                $hayerror['numero_c'] = '<p style="color:red;">El numero de tarjeta no puede estar vacio.</p>';
              }else if(strlen($_POST['numero_c'])!== 16){
                      $hayerror['numero_c'] = '<p style="color:red;">La tarjeta de crédito debe estar compuesta por 16 cifras.</p>';
              }

            if(!is_numeric($_POST['mes_c'])){
              $hayerror['mes_c'] = '<p style="color:red;">El mes de tarjeta debe ser numérico.</p>';
              }else if (trim($_POST['mes_c']) == ''){
                $hayerror['mes_c'] = '<p style="color:red;">El mes de tarjeta no puede estar vacio.</p>';
              }else if(($_POST['mes_c']) <= 0 || ($_POST['mes_c']) > 12 ){
                      $hayerror['mes_c'] = '<p style="color:red;">El mes no existe.</p>';
              }

            if(!is_numeric($_POST['año_c'])){
              $hayerror['año_c'] = '<p style="color:red;">El año de tarjeta debe ser numérico.</p>';
              }else if (trim($_POST['año_c']) == ''){
                $hayerror['año_c'] = '<p style="color:red;">El año de tarjeta no puede estar vacio.</p>';
              }else if (($_POST['año_c']) < 2018){
                $hayerror['año_c'] = '<p style="color:red;">Año incorrecto.</p>';
              }

            if(strlen($_POST['cvv_c'])<3){
              $hayerror['cvv_c'] = '<p style="color:red;">El CVV debe tener 3 cifras.</p>';
              }else if (trim($_POST['cvv_c']) == ''){
                $hayerror['cvv_c'] = '<p style="color:red;">El CVV no puede estar vacio.</p>';
            }
  }else{
    $_POST['numero_c'] = 0;

    $_POST['mes_c'] = 0;

    $_POST['año_c'] = 0;

    $_POST['cvv_c'] = 0;
  }

if(isset($hayerror)){

    $hayerror = serialize($hayerror);
    $hayerror= urlencode($hayerror);
    header("Location: tienda.php?error=".$hayerror);

}else{

if(count($_POST["album"])>0){

    $eventolog = "Se ha hecho un pedido por  ". $_POST['nombre_c'] ." en la tienda";
    $insercion = "INSERT INTO log (evento)";
    $insercion.= "VALUES ('$eventolog')";
    $resultado = consultarA($insercion);

    $csv = implode(',', $_POST['album']);
    $consulta = 'SELECT precio FROM discografia';
    $resultado = consultarA($consulta);

    $vector = $_POST['album'];
    $total = count($_POST["album"]);
    $precio = 0;

    foreach ($_POST['album'] as &$valor) {
      echo $valor;
      $consulta = "SELECT precio FROM discografia WHERE titulo = '$valor'";
      $resultado = consultarA($consulta);
        while ($registroActual = mysqli_fetch_array($resultado)) {
          $precio = $precio + $registroActual['precio'];
        }
      }

       $insercion = "INSERT INTO pedidos (disco_solicitado, precio_disco, nombre_comprador, apellidos_comprador, email_comprador, telefono_comprador, direccion_comprador, metodo_pago, numero_tarjeta, mes_tarjeta, año_tarjeta, codigo_tarjeta)";
       $insercion.= "VALUES ('" . $csv . "','" . $precio . "','" . $_POST['nombre_c'] . "','" . $_POST['apellidos_c'] . "','" . $_POST['email_c'] . "','" . $_POST['telefono_c'] . "','" . $_POST['calle_c'] . "','" . $_POST['opcion'] . "','" . $_POST['numero_c'] . "','" . $_POST['mes_c'] . "','" . $_POST['año_c'] . "','" . $_POST['cvv_c'] . "')";
       $resultado = consultarA($insercion);

       echo "<script>alert('Pedido formalizado.');window.location.href='tienda.php';</script>";

}else{

   echo "<script>alert('Selecciona al menos un disco.');window.location.href='tienda.php';</script>";

 }
}

?>
