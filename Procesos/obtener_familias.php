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

// Obtener la clase seleccionada del POST
$claseId = $_POST['claseId'];

// Realizar la consulta a la tabla "familia" filtrando por la clase seleccionada
$familias = "SELECT id, nombre FROM familia WHERE fk_clase = $claseId";
$resultFamilias = $conn->query($familias);

// Crear un array para almacenar las familias
$familiasArray = array();

// Obtener las familias relacionadas con la clase seleccionada
if ($resultFamilias->num_rows > 0) {
    while ($row = $resultFamilias->fetch_assoc()) {
        $familia = array(
            'id' => $row['id'],
            'nombre' => $row['nombre']
        );
        array_push($familiasArray, $familia);
    }
}

// Devolver las familias en formato JSON
echo json_encode($familiasArray);

// Cerrar la conexión a la base de datos
$conn->close();
?>