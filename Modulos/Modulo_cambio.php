<?php
session_start();
$formulario = dirname(__DIR__) . '/Interfaces/Interfaz_cambio.php';
include $formulario;
if(isset($_POST['enviando'])){
    $captura_articulo=($_POST['articulo']);
    $captura_marca=($_POST['marca']);
    $captura_modelo=($_POST['modelo']);
    $captura_departamento=($_POST['departamento']);
    $captura_descontinuado=intval($_POST['descontinuado']);
    $captura_clase=($_POST['clase']);
    $captura_familia=($_POST['familia']);
    $captura_stock=($_POST['stock']);
    $captura_cantidad=($_POST['cantidad']);
  
    
    include(dirname(__DIR__) . '/Procesos/Proceso_cambio.php');
    cambiararticulo($_SESSION['skuCaptura'], $captura_articulo, $captura_marca, $captura_modelo, $captura_departamento, $captura_clase, $captura_familia, $captura_stock, $captura_cantidad, $captura_descontinuado);

    echo '<script>window.location.href = "../index.php";</script>';
}       
?>