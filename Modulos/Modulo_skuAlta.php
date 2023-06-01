<?php

$rutaArchivo = dirname(__DIR__) . '/Interfaces/Interfaz_skuAlta.html';
$formulario=file_get_contents($rutaArchivo);
session_start();
echo $formulario;

    if(isset($_POST['enviando'])){
        $captura_sku=($_POST['sku']);
        
        $_SESSION['skuCaptura'] = $captura_sku;
        include(dirname(__DIR__) . '/Procesos/Validar_sku.php');
        $Nr = validarsku($captura_sku);
        if($Nr != 0){
            echo "El sku ya esta siendo usado";
            exit;
        }else {
            header("Location: ../Modulos/Modulo_alta.php");
            exit;
        }
    
    }


?>