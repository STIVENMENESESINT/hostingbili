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
    // Verificar si se ha recibido un ID de programa para editar
    if (isset($_GET['id_programaformacion'])) {
        $id_programaformacion = $conn->real_escape_string($_GET['id_programaformacion']);

        // Consulta para obtener los detalles del programa de formación específico
        $queryPrograma = "SELECT * FROM programaformacion WHERE id_programaformacion = '$id_programaformacion'";
        $resultadoPrograma = mysqli_query($conn, $queryPrograma);

        // Verificar si se obtuvieron resultados
        if ($resultadoPrograma && mysqli_num_rows($resultadoPrograma) > 0) {
            $programa = mysqli_fetch_assoc($resultadoPrograma);
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
    <title>editar programa de formacion</title>
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
                    <!-- Formulario para editar programa de formación -->
                    <h1>Editar Programa de Formación</h1>
                    <form id="formEditarPrograma">
                        <input type="hidden" name="id_programaformacion" value="<?php echo $programa['id_programaformacion']; ?>">
                        <div class="form-group">
                            <label for="nombre">Nombre del Programa</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?php echo $programa['nombre']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="id_competencia">ID de la Competencia</label>
                            <input type="text" class="form-control" id="id_competencia" name="id_competencia"
                                value="<?php echo $programa['id_competencia']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="id_jornada">ID de la Jornada</label>
                            <input type="text" class="form-control" id="id_jornada" name="id_jornada"
                                value="<?php echo $programa['id_jornada']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="id_mcer">ID de MCER</label>
                            <input type="text" class="form-control" id="id_mcer" name="id_mcer"
                                value="<?php echo $programa['id_mcer']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="id_modalidad">ID de la Modalidad</label>
                            <input type="text" class="form-control" id="id_modalidad" name="id_modalidad"
                                value="<?php echo $programa['id_modalidad']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="id_nivel_formacion">ID del Nivel de Formación</label>
                            <input type="text" class="form-control" id="id_nivel_formacion" name="id_nivel_formacion"
                                value="<?php echo $programa['id_nivel_formacion']; ?>" required>
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
            $('#formEditarPrograma').submit(function (event) {
                event.preventDefault();
                
                // Obtener los datos del formulario
                var formData = $(this).serialize();

                // Enviar solicitud AJAX para actualizar el programa de formación
                $.post("../../include/ctrlIndex3.php", formData, function (data) {
                    if (data.rst === "1") {
                        alert('Programa de formación actualizado con éxito');
                        window.location.href = 'listadodocumento.php'; // Redirigir a la lista de programas después de editar
                    } else {
                        alert('Error al actualizar el programa de formación: ' + data.ms);
                    }
                }, 'json');
            });
        });
    </script>
</body>

</html>
<?php
        } else {
            // Si no se encontró el programa de formación, mostrar un mensaje de error
            echo "No se encontró el programa de formación con el ID proporcionado.";
        }
    } else {
        // Si no se proporcionó un ID de programa, redirigir o manejar el caso según tu flujo de aplicación
        echo "Se requiere el ID del programa de formación para editar.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
