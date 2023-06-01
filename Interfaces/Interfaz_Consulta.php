<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</head>
<body>
    <?php
    // Establecer la conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "abcc");

    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    // Ejecutar el procedimiento almacenado y obtener el resultado
    $sku_param = $sku = $_SESSION['skuCaptura']; // SKU del artículo a consultar
    $resultado = $conexion->query("CALL ObtenerDatosArticulo($sku_param)");

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        // Construir la tabla en formato HTML
        echo '<table class="table">';
        echo '<tr><th scope="col">Artículo</th><th scope="col">Marca</th><th scope="col">Modelo</th><th scope="col">Departamento</th><th scope="col">Clase</th><th scope="col">Familia</th><th scope="col">Stock</th><th scope="col">Cantidad</th><th scope="col">Fecha de Alta</th><th scope="col">Fecha de Baja</th><th scope="col">Descontinuado</th></tr>';

        // Recorrer los resultados y mostrarlos en la tabla
        while ($row = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['articulo'] . '</td>';
            echo '<td>' . $row['marca'] . '</td>';
            echo '<td>' . $row['modelo'] . '</td>';
            echo '<td>' . $row['departamento_nombre'] . '</td>';
            echo '<td>' . $row['clase_nombre'] . '</td>';
            echo '<td>' . $row['familia_nombre'] . '</td>';
            echo '<td>' . $row['stock'] . '</td>';
            echo '<td>' . $row['cantidad'] . '</td>';
            echo '<td>' . $row['fechaAlta'] . '</td>';
            echo '<td>' . $row['fechaBaja'] . '</td>';
            echo '<td>' . ($row['descontinuado'] == 1 ? 'SI' : 'NO') . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No se encontraron resultados.';
    }
    // Cerrar la conexión a la base de datos
    $conexion->close();
    ?>
    <?php
    // Establecer la conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "abcc");

    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    /*TABLA DEPARTAMENTOS*/
    echo '<table class="table">';
    echo '<tr><th scope="col">Numero de Departamento</th><th scope="col">Departamento</th><th scope="col">Numero de Clase</th><th scope="col">Nombre de Clase</th><th scope="col">Numero de Familia</th><th scope="col">Nombre de Familia</th></tr>';
    $resultado = $conexion->query("CALL ObtenerInfoDepartamento()");
    if ($resultado->num_rows > 0) {
        // Construir la tabla en formato HTML
       

        // Recorrer los resultados y mostrarlos en la tabla
        while ($row = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['departamento'] . '</td>';
            echo '<td>' . $row['clase'] . '</td>';
            echo '<td>' . $row['nombre_clase'] . '</td>';
            echo '<td>' . $row['familia'] . '</td>';
            echo '<td>' . $row['nombre_familia'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No se encontraron resultados.';
    }
    ?>

    <?php
    // Establecer la conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "abcc");

    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    /*TABLA DEPARTAMENTOS*/
    echo '<table class="table">';
    echo '<tr><th scope="col">Numero de Departamento</th><th scope="col">Departamento</th><th scope="col">Numero de Clase</th><th scope="col">Nombre de Clase</th><th scope="col">Numero de Familia</th><th scope="col">Nombre de Familia</th></tr>';
    $resultado = $conexion->query("SELECT * FROM `articulos`;");
    if ($resultado->num_rows > 0) {
        // Construir la tabla en formato HTML
       

        // Recorrer los resultados y mostrarlos en la tabla
        while ($row = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['sku'] . '</td>';
            echo '<td>' . $row['articulo'] . '</td>';
            echo '<td>' . $row['marca'] . '</td>';
            echo '<td>' . $row['modelo'] . '</td>';
            echo '<td>' . $row['fk_departamento'] . '</td>';
            echo '<td>' . $row['fechaAlta'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No se encontraron resultados.';
    }
    ?>
</body>
</html>