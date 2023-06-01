<?php
function borradologico($sku)
{
    $conexion = mysqli_connect("localhost", "root", "");
    if (mysqli_connect_errno()) {
        echo 'NO SE PUEDE CONECTAR: ';
        exit();
    } else {
        mysqli_select_db($conexion, "abcc");
    }
    $instruccion = "CALL borradologico('$sku');";
    mysqli_query($conexion, $instruccion);
    mysqli_close($conexion);

}
?>