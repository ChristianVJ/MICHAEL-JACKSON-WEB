
<?php
/* /////////// BUSCAR CONCIERTO /////////// */
session_start();
require 'include.php';
$consulta = 'SELECT * FROM conciertos WHERE lugar="' . $_POST['buscar_concierto'] . '"';
$resultado = consultarA($consulta);

if (mysqli_num_rows($resultado) == 1) {
  $consulta = "SELECT * FROM conciertos";
  $resultado = consultarA($consulta);

  echo '<table class= "tabla_conciertos">';
  echo '<thead><tr><th>ID</th><th>Fecha</th><th>Lugar</th><th>Descripcion</th></tr></thead>';

  while ($registroActual = mysqli_fetch_array($resultado)) {
      echo '<tbody><tr>';
      echo '<td>';
      echo $registroActual['id_concierto'];
      echo '</td><td>';
      echo $registroActual['fecha'];
      echo '</td><td>';
      echo $registroActual['lugar'];
      echo '</td><td>';
      echo $registroActual['descripcion'];
      echo '</td>';
  }

  echo '</tr></tbody></table>';
  echo '<br /><br /><br /><br />';

}

?>
