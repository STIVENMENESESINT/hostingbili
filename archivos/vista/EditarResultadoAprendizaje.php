<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
header('Content-Type: text/html; charset='.$charset);
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn = Conectarse();

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
    // Verificar si se ha recibido un ID de resultado de aprendizaje para editar
    if (isset($_GET['id_resultado_aprendizaje'])) {
        $id_resultado_aprendizaje = $conn->real_escape_string($_GET['id_resultado_aprendizaje']);

        // Consulta para obtener los detalles del resultado de aprendizaje específico
        $queryResultado = "SELECT * FROM resultadosaprendizaje WHERE id_resultado_aprendizaje = '$id_resultado_aprendizaje'";
        $resultadoResultado = mysqli_query($conn, $queryResultado);

        // Verificar si se obtuvieron resultados
        if ($resultadoResultado && mysqli_num_rows($resultadoResultado) > 0) {
            $resultado_aprendizaje = mysqli_fetch_assoc($resultadoResultado);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar resultados de aprendizaje</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->


<!-- Incluye Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- Incluye jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Incluye Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy0sF/xTkqlj6Qrg/x2O9f7E3UJFpxoY+J" crossorigin="anonymous"></script>

</head>

<body>
    <div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>
            <div>
                <?php include_once('cabeceraMenu.php'); ?>
            </div>
        </aside>
        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page">
                <div id="contenido">
                    <!-- Formulario para editar resultado de aprendizaje -->
                    <h1>Editar Resultado de Aprendizaje</h1>
                    <form id="formEditarResultado">
                        <input type="hidden" name="id_resultado_aprendizaje"
                            value="<?php echo $resultado_aprendizaje['id_resultado_aprendizaje']; ?>">
                        <div class="form-group">
                            <label for="nombre">Nombre del Resultado de Aprendizaje</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?php echo $resultado_aprendizaje['nombre']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="id_competencia">ID de la Competencia</label>
                            <input type="text" class="form-control" id="id_competencia" name="id_competencia"
                                value="<?php echo $resultado_aprendizaje['id_competencia']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Manejar el envío del formulario de edición
            $('#formEditarResultado').submit(function (event) {
                event.preventDefault();
                
                // Obtener los datos del formulario
                var formData = $(this).serialize();

                // Enviar solicitud AJAX para actualizar el resultado de aprendizaje
                $.post("../../include/ctrlIndex3.php", formData, function (data) {
                    if (data.rst === "1") {
                        alert('Resultado de aprendizaje actualizado con éxito');
                        window.location.href = 'listadodocumento.php'; // Redirigir a la lista después de editar
                    } else {
                        alert('Error al actualizar el resultado de aprendizaje: ' + data.ms);
                    }
                }, 'json');
            });
        });
    </script>
</body>

</html>
<?php
        } else {
            // Si no se encontró el resultado de aprendizaje, mostrar un mensaje de error
            echo "No se encontró el resultado de aprendizaje con el ID proporcionado.";
        }
    } else {
        // Si no se proporcionó un ID de resultado de aprendizaje, redirigir o manejar el caso según tu flujo de aplicación
        echo "Se requiere el ID del resultado de aprendizaje para editar.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
