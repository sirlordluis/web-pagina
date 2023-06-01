<?php
function almacenararticulo($sku, $articulo, $marca, $modelo, $departamento, $clase, $familia, $stock, $cantidad, $fechaalta, $fechabaja)
{
$conexion = mysqli_connect("localhost", "root", "");
if (mysqli_connect_errno()) {
echo 'NO SE PUEDE CONECTAR: ';
exit();
} else {
mysqli_select_db($conexion, "abcc");
}
$instruccion = "CALL altaArticulo('$sku', '$articulo', '$marca', '$modelo','$departamento','$clase','$familia','$cantidad','$stock');";
mysqli_query($conexion, $instruccion);
mysqli_close($conexion);

}
?>