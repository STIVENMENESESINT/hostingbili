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
    // Consulta para obtener los datos de los estados
    $queryEstado = "SELECT * FROM estado";
    $resultadoEstado = mysqli_query($conn, $queryEstado);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultadoEstado) {
        // Recuperar los datos de los estados
        $estadoDatos = mysqli_fetch_all($resultadoEstado, MYSQLI_ASSOC);
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
    <title>eliminar estados de usuario</title>
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
                    <!-- Sección para mostrar y editar los datos de los estados -->
                    <h1>Listado de Estados</h1>
                    <div id="estado-lista">
                        <?php foreach ($estadoDatos as $estado) { ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Estado: <?php echo $estado['nombre']; ?></h5>
                                    <p class="card-text">ID: <?php echo $estado['id_estado']; ?></p>
                                    <!-- Botones de acción -->
                                    <button type="button" class="btn btn-danger btn-eliminar-estado"
                                        data-id="<?php echo $estado['id_estado']; ?>">Eliminar</button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>           
            </div>
        </div>
    </div></div><a href="listarestado.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Evento delegado para los botones de eliminar estado
            $('#estado-lista').on('click', '.btn-eliminar-estado', function () {
                var estadoId = $(this).data('id');
                if (confirm('¿Estás seguro de que deseas eliminar este estado?')) {
                    // Enviar solicitud AJAX para eliminar el estado
                    $.post("../../include/ctrlIndex3.php", {
                        action: 'EliminarEstado',
                        id_estado: estadoId
                    }, function (data) {
                        if (data.rst === "1") {
                            alert('Estado eliminado con éxito');
                            location.reload(); // Recargar la página para actualizar la lista
                        } else {
                            alert('Error al eliminar el estado: ' + data.ms);
                        }
                    }, 'json');
                }
            });
        });
    </script>
</body>

</html>
<?php
    } else {
        // Si hay un error en la consulta de estados, imprimir el mensaje de error
        echo "Error al ejecutar la consulta de estados: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
