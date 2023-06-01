<?php
session_start();
$formulario = dirname(__DIR__) . '/Interfaces/Interfaz_baja.html';
include $formulario;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["eliminar"])) {
        include(dirname(__DIR__) . '/Procesos/Proceso_borrar.php');
        borradologico($_SESSION['skuCaptura']);
        
        echo '<script>window.location.href = "../index.php";</script>';
    } elseif (isset($_POST["no_estoy_seguro"])) {
      
        echo '<script>window.location.href = "../index.php";</script>';
    }
  }
?>