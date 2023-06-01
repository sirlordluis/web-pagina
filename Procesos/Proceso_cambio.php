<?php
function cambiararticulo($sku, $articulo, $marca, $modelo, $departamento, $clase, $familia, $stock, $cantidad, $descontinuado)
{
    $conexion = mysqli_connect("localhost", "root", "");
    if (mysqli_connect_errno()) {
        echo 'NO SE PUEDE CONECTAR: ';
        exit();
    } else {
        mysqli_select_db($conexion, "abcc");
    }
    $instruccion = "CALL cambiararticulo('$sku', '$articulo', '$marca', '$modelo', '$departamento',  '$stock', '$cantidad', '$descontinuado', '$clase', '$familia');";
    mysqli_query($conexion, $instruccion);
    mysqli_close($conexion);

}
?>