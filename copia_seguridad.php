<?php

/* /////////// COPIA DE SEGURIDAD /////////// */
session_start();
include ('include.php');
if (!(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador')) {
    echo "<script>alert('ERROR DE SESIÓN: Tienes que ser administrador para acceder. Volviendo a la página de inicio ...');window.location.href='index.php';</script>";
}

function crear_copia($host, $usuario, $pass, $base_datos, $tables = '*'){

  $conn = new mysqli($host, $usuario, $pass, $base_datos);
  if ($conn->connect_error) {
      die("La conexión falló: " . $conn->connect_error);
  }

  if($tables == '*'){
    $tables = array();
    $sql = "SHOW TABLES";
    $query = $conn->query($sql);
    while($row = $query->fetch_row()){
      $tables[] = $row[0];
    }
  }
  else{
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }

  $outsql = '';
  foreach ($tables as $table) {

      $sql = "SHOW CREATE TABLE $table";
      $query = $conn->query($sql);
      $row = $query->fetch_row();
      $outsql .= "\n\n" . $row[1] . ";\n\n";
      $sql = "SELECT * FROM $table";
      $query = $conn->query($sql);
      $columnCount = $query->field_count;

      for ($i = 0; $i < $columnCount; $i ++) {
          while ($row = $query->fetch_row()) {
              $outsql .= "INSERT INTO $table VALUES(";
              for ($j = 0; $j < $columnCount; $j ++) {
                  $row[$j] = $row[$j];

                  if (isset($row[$j])) {
                      $outsql .= '"' . $row[$j] . '"';
                  } else {
                      $outsql .= '""';
                  }
                  if ($j < ($columnCount - 1)) {
                      $outsql .= ',';
                  }
              }
              $outsql .= ");\n";
          }
      }

      $outsql .= "\n";
  }

    $backup_file_name = $base_datos . '_backup.sql';
    $fileHandler = fopen($backup_file_name, "w+");
    fwrite($fileHandler, $outsql);
    fclose($fileHandler);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));

}

  $host="localhost";
  $usuario="christianam1718";
  $pass="91bjlGnb";
  $base_datos="christianam1718";

  crear_copia($host, $usuario, $pass, $base_datos);

  exit();

  ?>
