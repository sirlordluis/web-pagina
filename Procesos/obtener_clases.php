<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abcc";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el departamento seleccionado del POST
$departamentoId = $_POST['departamentoId'];

// Realizar la consulta a la tabla "clase" filtrando por el departamento seleccionado
$clases = "SELECT id, nombre FROM clase WHERE fk_departamento = $departamentoId";
$resultClases = $conn->query($clases);

// Crear un array para almacenar las clases
$clasesArray = array();

// Obtener las clases relacionadas con el departamento seleccionado
if ($resultClases->num_rows > 0) {
    while ($row = $resultClases->fetch_assoc()) {
        $clase = array(
            'id' => $row['id'],
            'nombre' => $row['nombre']
        );
        array_push($clasesArray, $clase);
    }
}

// Devolver las clases en formato JSON
echo json_encode($clasesArray);

// Cerrar la conexión a la base de datos
$conn->close();
?>