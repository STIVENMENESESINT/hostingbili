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
    // Consulta para obtener los datos de los niveles de formación
    $queryNivel = "SELECT * FROM nivelformacion";
    $resultadoNivel = mysqli_query($conn, $queryNivel);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultadoNivel) {
        // Recuperar los datos de los niveles de formación
        $nivelDatos = mysqli_fetch_all($resultadoNivel, MYSQLI_ASSOC);
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
    <title>eliminar programas de formacion</title>
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
                    <!-- Sección para mostrar y editar los datos de los niveles de formación -->
                    <h1>Listado de Niveles de Formación</h1>
                    <div id="nivel-lista">
                        <?php foreach ($nivelDatos as $nivel) { ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Nivel: <?php echo $nivel['nombre']; ?></h5>
                                    <p class="card-text">ID: <?php echo $nivel['id_nivel_formacion']; ?></p>
                                    <!-- Botones de acción -->
                                    <button type="button" class="btn btn-danger  btn-eliminar-nivel"
                                        data-id="<?php echo $nivel['id_nivel_formacion']; ?>">Eliminar</button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>           
            </div>
        </div>
    </div>
    </div></div></div><a href="listarnivelformacion.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>
    
    

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Evento delegado para los botones de eliminar nivel de formación
            $('#nivel-lista').on('click', '.btn-eliminar-nivel', function () {
                var nivelId = $(this).data('id');
                if (confirm('¿Estás seguro de que deseas eliminar este nivel de formación?')) {
                    // Enviar solicitud AJAX para eliminar el nivel de formación
                    $.post("../../include/ctrlIndex3.php", {
                        action: 'EliminarNivel',
                        id_nivel_formacion: nivelId
                    }, function (data) {
                        if (data.rst === "1") {
                            alert('Nivel de formación eliminado con éxito');
                            location.reload(); // Recargar la página para actualizar la lista
                        } else {
                            alert('Error al eliminar el nivel de formación: ' + data.ms);
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
        // Si hay un error en la consulta de niveles de formación, imprimir el mensaje de error
        echo "Error al ejecutar la consulta de niveles de formación: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
