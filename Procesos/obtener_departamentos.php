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

        // Realizar la consulta a la tabla "departamentos"
        $departamentos = "SELECT id, nombre FROM departamento";
        $resultDepartamentos = $conn->query($departamentos);

        // Verificar si se encontraron resultados en la tabla "departamentos"
        if ($resultDepartamentos->num_rows > 0) {
            // Crear el primer select para elegir el departamento
            echo '<div class="mb-3">';
            echo '<label for="marca" class="form-label">Departamento:';
            echo '<select class="form-select" name="departamento" id="departamento">';
            echo '<option value="">Seleccionar departamento</option>';

            while ($row = $resultDepartamentos->fetch_assoc()) {
                echo '<option value="' . $row["id"] . '">' . $row["nombre"] . '</option>';
            }
            echo '</label>';
            echo '</select>';
            echo '</div>';

            // Crear el segundo select para elegir la clase (inicialmente deshabilitado)
            echo '<div class="mb-3">';
            echo '<label for="marca" class="form-label">Clase:';
            echo '<select class="form-select" name="clase" id="clase" disabled>';
            echo '<option value="">Seleccionar clase</option>';
            echo '</label>';
            echo '</select>';
            echo '</div>';

            // Crear el tercer select para elegir la familia (inicialmente deshabilitado)
            echo '<div class="mb-3">';
            echo '<label for="marca" class="form-label">Familia:';
            echo '<select class="form-select" name="familia" id="familia" disabled>';
            echo '<option value="">Seleccionar familia</option>';
            echo '</label>';
            echo '</select>';
            echo '</div>';

        } else {
            echo 'No se encontraron departamentos.';
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
        ?>