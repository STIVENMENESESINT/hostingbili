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
    // Consulta para obtener las fichas
    $queryFichas = "SELECT * FROM ficha";
    $resultadoFichas = mysqli_query($conn, $queryFichas);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultadoFichas) {
        // Recuperar las fichas
        $fichas = mysqli_fetch_all($resultadoFichas, MYSQLI_ASSOC);
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
    <title>listar fichas de formacion</title>
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
                    <!-- Sección para mostrar y editar las fichas -->
                    <h1>Listado de Fichas</h1>
                    <div id="fichas-lista">
                        <?php foreach ($fichas as $ficha) { ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $ficha['ficha']; ?></h5>
                                    <p class="card-text">ID: <?php echo $ficha['id_ficha']; ?></p>
                                    <!-- Botones de acción -->


                                    


                                    <button type="button" class="btn btn-info btn-detalles-ficha"
        data-id="<?php echo $ficha['id_ficha']; ?>"
        onclick="window.location.href='detallefichaaprendiz.php?id=<?php echo $ficha['id_ficha']; ?>';">
        Detalles
</button>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div><a href="listardesdeaprendiz.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Evento delegado para los botones de editar ficha
            $('#fichas-lista').on('click', '.btn-editar-ficha', function () {
                var fichaId = $(this).data('id');
                // Aquí puedes implementar la lógica para editar la ficha específica
                console.log('Editar ficha con ID: ' + fichaId);
            });

            // Evento delegado para los botones de detalles de ficha
            $('#fichas-lista').on('click', '.btn-detalles-ficha', function () {
                var fichaId = $(this).data('id');
                // Lógica para mostrar detalles de la ficha específica
                console.log('Detalles de la ficha con ID: ' + fichaId);
            });

            // Evento delegado para los botones de eliminar ficha
            $('#fichas-lista').on('click', '.btn-eliminar-ficha', function () {
                var fichaId = $(this).data('id');
                // Lógica para eliminar la ficha específica
                console.log('Eliminar ficha con ID: ' + fichaId);
            });
        });
    </script>
</body>

</html>
<?php
    } else {
        // Si hay un error en la consulta de fichas, imprimir el mensaje de error
        echo "Error al ejecutar la consulta de fichas: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
