<?php
function validarsku($sku)
{
    $conexion = mysqli_connect("localhost", "root", "");

    if (mysqli_connect_errno()) {
        echo 'NO SE PUEDE CONECTAR: ';
        exit();
    } else {
        mysqli_select_db($conexion, "abcc");
    }


    $instruccion = "SELECT * FROM articulos where sku = '$sku';";
    
    $ejecucion = mysqli_query($conexion, $instruccion);
    mysqli_close($conexion);

    return $Nr = mysqli_num_rows($ejecucion);
    
    
}
?>