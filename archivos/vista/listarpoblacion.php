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
    // Consulta para obtener las poblaciones
    $queryPoblaciones = "SELECT * FROM poblacion";
    $resultadoPoblaciones = mysqli_query($conn, $queryPoblaciones);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultadoPoblaciones) {
        // Recuperar las poblaciones
        $poblaciones = mysqli_fetch_all($resultadoPoblaciones, MYSQLI_ASSOC);
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
    <title>poblaciones</title>
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
                    <!-- Sección para mostrar y editar las poblaciones -->
                    <h1>Listado de Poblaciones</h1>
                    <div id="poblaciones-lista">
                        <?php foreach ($poblaciones as $poblacion) { ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $poblacion['nombre_poblacion']; ?></h5>
                                    <p class="card-text">Código: <?php echo $poblacion['cod_poblacion']; ?></p>
                                    <!-- Botones de acción -->
                                 
                                    <button type="button" class="btn btn-primary btn-agregar-poblacion"
        data-id="<?php echo $poblacion['cod_poblacion']; ?>"
        onclick="window.location.href='AgregarPoblacion.php?id=<?php echo $poblacion['cod_poblacion']; ?>';">
    Agregar
</button>

                                 
                                 
                                 
                                    <button type="button" class="btn btn-primary btn-editar-poblacion"
                                        data-id="<?php echo $poblacion['cod_poblacion']; ?>">Editar</button>
                                    <button type="button" class="btn btn-info btn-detalles-poblacion"
                                        data-id="<?php echo $poblacion['cod_poblacion']; ?>">Detalles</button>
                                        <button type="button" class="btn btn-danger btn-eliminar-poblacion"
        data-id="<?php echo $poblacion['cod_poblacion']; ?>"
        onclick="window.location.href='EliminarPoblacion.php?id=<?php echo $poblacion['cod_poblacion']; ?>';">
    Eliminar
</button>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>                    <a href="AgregarPoblacion.php" class="btn btn-success">Agregar Nuevo Poblacion</a>
            </div>
        </div>
    </div>    </div><a href="listardesdepaneldeadministrador.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>


    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Evento delegado para los botones de editar población
            $('#poblaciones-lista').on('click', '.btn-editar-poblacion', function () {
                var poblacionId = $(this).data('id');
                // Aquí puedes implementar la lógica para editar la población específica
                console.log('Editar población con código: ' + poblacionId);
            });

            // Evento delegado para los botones de detalles de población
            $('#poblaciones-lista').on('click', '.btn-detalles-poblacion', function () {
                var poblacionId = $(this).data('id');
                // Lógica para mostrar detalles de la población específica
                console.log('Detalles de la población con código: ' + poblacionId);
            });

            // Evento delegado para los botones de eliminar población
            $('#poblaciones-lista').on('click', '.btn-eliminar-poblacion', function () {
                var poblacionId = $(this).data('id');
                // Lógica para eliminar la población específica
                console.log('Eliminar población con código: ' + poblacionId);
            });
        });
    </script>
</body>

</html>
<?php
    } else {
        // Si hay un error en la consulta de poblaciones, imprimir el mensaje de error
        echo "Error al ejecutar la consulta de poblaciones: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
