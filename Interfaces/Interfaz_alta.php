<!DOCTYPE html>
<html>
<head>
    <title>Alta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Alta</h1>
        
        <form action="../Modulos/Modulo_alta.php" method="POST" onsubmit="return validarCantidad()">
            <div class="mb-3">
                <label for="articulo" class="form-label">Articulo:</label>
                <input type="text" class="form-control" id="articulo" name="articulo" required>
            </div>
            <div class="mb-3">
                <label for="marca1" class="form-label">Marca:</label>
                <input type="text" class="form-control" id="marca1" name="marca" required>
            </div>
            <div class="mb-3">
                <label for="modelo1" class="form-label">Modelo:</label>
                <input type="text" class="form-control" id="modelo1" name="modelo" required>
            </div>
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
            // Realizar la consulta a la tabla departamentos
            $departamentos = "SELECT id, nombre FROM departamento";
            $resultDepartamentos = $conn->query($departamentos);
            // Verificar si se encontraron resultados en la tabla departamentos
            if ($resultDepartamentos->num_rows > 0) {
                
                echo '<div class="mb-3">';
                echo '<label for="departamento" class="form-label">Departamento:</label>';
                echo '<select class="form-select" name="departamento" id="departamento" required>';
                echo '<option value="">Seleccionar departamento</option>';
           while ($row = $resultDepartamentos->fetch_assoc()) {
                    echo '<option value="' . $row["id"] . '">' . $row["nombre"] . '</option>';
                }
                echo '</select>';
                echo '</div>';
                
                echo '<div class="mb-3">';
                echo '<label for="clase" class="form-label">Clase:</label>';
                echo '<select class="form-select" name="clase" id="clase" disabled required>';
                echo '<option value="">Seleccionar clase</option>';
                echo '</select>';
                echo '</div>';
                
                echo '<div class="mb-3">';
                echo '<label for="familia" class="form-label">Familia:</label>';
                echo '<select class="form-select" name="familia" id="familia" disabled required>';
                echo '<option value="">Seleccionar familia</option>';
                echo '</select>';
                echo '</div>';
            } else {
                echo 'No se encontraron departamentos.';
            }
            $conn->close();
            ?>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="text" class="form-control" id="stock" name="stock"  required >
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad:</label>
                <input type="text" class="form-control" id="cantidad" name="cantidad"  required>
            </div>
            <div class="mb-3">
                <label for="fecha1" class="form-label">Fecha de Alta:</label>
                <input type="date" class="form-control" id="fecha1" name="fechaAlta" value="" required>
            </div>
            <div class="mb-3">
                <label for="fecha2" class="form-label">Fecha de Baja:</label>
                <input type="date" class="form-control" id="fecha2" name="fechaBaja" value="" required>
            </div>
            <input class="btn btn-primary" type="submit" name="enviando" value="Enviar">
        </form>
    </div>
    <script>
    var hoy = new Date();
    // Colocar el formato yyyy-mm-dd
    var ano = hoy.getFullYear();
    var mes = (hoy.getMonth() + 1).toString().padStart(2,
        '0'); //Esto asegura que el mes esté representado con dos dígitos
    var dia = hoy.getDate().toString().padStart(2, '0');
    var formaTiempo = ano + '-' + mes + '-' + dia;
    document.getElementById('fecha1').value = formaTiempo;
    document.getElementById('fecha2').value = formaTiempo;
    </script>
    <script>
    // Habilitar el segundo select cuando se elija un departamento
    $(document).ready(function() {
        $('#departamento').change(function() {
            var departamentoId = $(this).val();

            if (departamentoId !== '') {
                $('#clase').prop('disabled', false);

                // Obtener las clases relacionadas con el departamento seleccionado
                $.ajax({
                    url: '../Procesos/obtener_clases.php',
                    type: 'POST',
                    data: {
                        departamentoId: departamentoId
                    },
                    dataType: 'json',
                    success: function(response) {
                        var len = response.length;
                        $('#clase').empty();
                        $('#clase').append('<option value="">Seleccionar clase</option>');

                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id'];
                            var nombre = response[i]['nombre'];
                            $('#clase').append('<option value="' + id + '">' + nombre +
                                '</option>');
                        }
                    }
                });
            } else {
                $('#clase').prop('disabled', true);
                $('#familia').prop('disabled', true);
            }
        });
        // Habilitar el tercer select cuando se elija una clase
        $('#clase').change(function() {
            var claseId = $(this).val();

            if (claseId !== '') {
                $('#familia').prop('disabled', false);

                // Obtener las familias relacionadas con la clase seleccionada
                $.ajax({
                    url: '../Procesos/obtener_familias.php',
                    type: 'POST',
                    data: {
                        claseId: claseId
                    },
                    dataType: 'json',
                    success: function(response) {
                        var len = response.length;
                        $('#familia').empty();
                        $('#familia').append(
                            '<option value="">Seleccionar familia</option>');

                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id'];
                            var nombre = response[i]['nombre'];
                            $('#familia').append('<option value="' + id + '">' + nombre +
                                '</option>');
                        }
                    }
                });
            } else {
                $('#familia').prop('disabled', true);
            }
        });
    });
    </script>
    <script>
    //Valida que la cantidad no debe ser mayor al stock.
    function validarCantidad() {
        var stock = parseInt(document.getElementById("stock").value);
        var cantidad = parseInt(document.getElementById("cantidad").value);
        if (cantidad > stock) {
            alert("La cantidad no puede ser mayor al stock disponible");
            return false; // Evita que se envíe el formulario
        }
        return true; // Permite el envío del formulario si la validación pasa
    }
    </script>
</body>

</html>