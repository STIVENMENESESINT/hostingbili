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
    // Consulta para obtener todos los tipos de solicitud
    $query = "SELECT * FROM tiposolicitud";
    $resultado = mysqli_query($conn, $query);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultado) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tipos de solicitud</title>
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
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>
            <div>
                <?php include_once('cabeceraMenu.php'); ?>
            </div>
        </aside>

        <div class="layout__content">
            <div class="content__page">
                <div id="contenido">
                    <h1>Listado de Tipos de Solicitud</h1>
                    <div id="tiposolicitud-lista">
                        <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $fila['nombre']; ?></h5>
                                    <p class="card-text">ID: <?php echo $fila['id_tiposolicitud']; ?></p>
                                    <p class="card-text">ID Rol: <?php echo $fila['id_rol']; ?></p>
                                    <!-- Botones de acción -->
                              
                                    <button type="button" class="btn btn-info btn-detalles-ficha"
                                    data-id="<?php echo $ficha['id_ficha']; ?>">Detalles</button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <a href="agregarTipoSolicitud.php" class="btn btn-success">Agregar Nuevo Tipo de Solicitud</a>
    
                </div>
            </div>
        </div>
    </div><a href="listardesdeaprendiz.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            // Evento delegado para los botones de editar tipo de solicitud
            $('#tiposolicitud-lista').on('click', '.btn-editar-tiposolicitud', function () {
                var tipoSolicitudId = $(this).data('id');
                window.location.href = 'editarTipoSolicitud.php?id_tiposolicitud=' + tipoSolicitudId;
            });

            // Evento delegado para los botones de eliminar tipo de solicitud
            $('#tiposolicitud-lista').on('click', '.btn-eliminar-tiposolicitud', function () {
                var tipoSolicitudId = $(this).data('id');
                if (confirm('¿Está seguro de que desea eliminar este tipo de solicitud?')) {
                    $.post('../../include/ctrlIndex3.php', { action: 'EliminarTipoSolicitud', id_tiposolicitud: tipoSolicitudId }, function (data) {
                        if (data.rst == "1") {
                            alert('Tipo de Solicitud eliminado con éxito.');
                            location.reload();
                        } else {
                            alert('Error al eliminar el Tipo de Solicitud: ' + data.ms);
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
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: ../../index.php");
}
?>
