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
    // Consulta para obtener los estados
    $queryEstados = "SELECT * FROM estado";
    $resultadoEstados = mysqli_query($conn, $queryEstados);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultadoEstados) {
        // Recuperar los estados
        $estados = mysqli_fetch_all($resultadoEstados, MYSQLI_ASSOC);
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
    <title>Detalle de Estados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->
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
                    <!-- Sección para mostrar los detalles de los estados -->
                    <h1>Detalle de Estados</h1>
                    <div class="row">
                        <?php foreach ($estados as $estado) { ?>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $estado['nombre']; ?></h5>
                                        <p class="card-text">ID: <?php echo $estado['id_estado']; ?></p>
                                        <p class="card-text">Fecha Suspensión: <?php echo $estado['fecha_suspe']; ?></p>
                                        <!-- Botones de acción -->
                                        
                                        <button type="button" class="btn btn-primary btn-agregar-estado"
        data-id="<?php echo $estado['id_estado']; ?>"
        onclick="window.location.href='AgregarEstado.php?id=<?php echo $estado['id_estado']; ?>';">
    Agregar
</button>
                                        
<button type="button" class="<button type="button" class="btn btn-primary btn-agregar-estado"
"
        data-id="<?php echo $estado['id_estado']; ?>"
        onclick="window.location.href='usuarios.php?id=<?php echo $estado['id_estado']; ?>';">
    EDITAR ESTADOS DE LOS USUARIOS
</button>                                
                           

                                        <button type="button" class="btn btn-info btn-ver-detalle"
                                                data-id="<?php echo $estado['id_estado']; ?>"
                                                data-nombre="<?php echo $estado['nombre']; ?>"
                                                data-fechasuspe="<?php echo $estado['fecha_suspe']; ?>">
                                            Ver Detalle
                                        </button>


                                        <button type="button" class="btn btn-danger btn-eliminar-estado"
        data-id="<?php echo $estado['id_estado']; ?>"
        onclick="window.location.href='EliminarEstadoalSistema.php?id=<?php echo $estado['id_estado']; ?>';">
    Eliminar
</button>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <a href="AgregarEstado.php" class="btn btn-success">Agregar Nuevo Estado</a>
                </div>
            </div>
        </div>
    </div>
    <a href="listardesdepaneldeadministrador.php">
        <i class="fas fa-arrow-circle-left"></i>
        <span class="nav-item">Regresar</span>
    </a>

    <!-- Modal para mostrar detalles de estado -->
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="detalleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleLabel">Detalles del Estado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="detalleID"></span></p>
                    <p><strong>Nombre:</strong> <span id="detalleNombre"></span></p>
                    <p><strong>Fecha Suspensión:</strong> <span id="detalleFechaSuspe"></span></p>
                    <!-- Aquí puedes agregar más detalles del estado si es necesario -->
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Evento delegado para los botones de editar estado
            $('.btn-editar-estado').click(function () {
                var estadoId = $(this).data('id');
                // Aquí puedes implementar la lógica para editar el estado específico
                console.log('Editar estado con ID: ' + estadoId);
            });

            // Evento delegado para los botones de eliminar estado
            $('.btn-eliminar-estado').click(function () {
                var estadoId = $(this).data('id');
                // Lógica para eliminar el estado específico
                console.log('Eliminar estado con ID: ' + estadoId);
            });

            // Evento delegado para los botones de ver detalle de estado
            $('.btn-ver-detalle').click(function () {
                var estadoId = $(this).data('id');
                var estadoNombre = $(this).data('nombre');
                var estadoFechaSuspe = $(this).data('fechasuspe');
                // Mostrar los detalles del estado en el modal
                $('#detalleID').text(estadoId);
                $('#detalleNombre').text(estadoNombre);
                $('#detalleFechaSuspe').text(estadoFechaSuspe);
                $('#modalDetalle').modal('show');
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
