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
    // Consulta para obtener los datos del usuario
    $query = "SELECT * FROM userprofile 
              WHERE id_userprofile = " . $_SESSION['id_userprofile'];
    $resultado = mysqli_query($conn, $query);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultado) {
        // Recuperar los datos del usuario
        $fila = mysqli_fetch_assoc($resultado);
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
    <title>Agregar Nuevo MCER</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                    <!-- Sección para mostrar y editar el perfil del usuario -->
                    <div class="container mt-5">
              
                        <form id="formAgregarMCER">

                        </form>
                        <?php
                        // Consulta para obtener detalles de MCER
                        $query_mcer = "SELECT * FROM mcer";
                        $resultado_mcer = mysqli_query($conn, $query_mcer);

                        if ($resultado_mcer && mysqli_num_rows($resultado_mcer) > 0) {
                            $mcerDatos = mysqli_fetch_all($resultado_mcer, MYSQLI_ASSOC);
                        ?>
                        <div class="mt-5">
                            <h2>Detalles de MCER</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mcerDatos as $mcer) { ?>
                                    <tr>
                                        <td><?php echo $mcer['id_mcer']; ?></td>
                                        <td><?php echo $mcer['nombre']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } else {
                            echo "No hay detalles de MCER disponibles.";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div></div><a href="listarMCERdesdeaprendiz.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>

    <!-- Incluir jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Acción al hacer clic en el botón de agregar MCER
            $(document).on("click", "#btnAgregarMCER", function() {
                // Enviar solicitud AJAX para agregar MCER
                $.post("../../include/ctrlIndex3.php", {
                    action: 'AgregarMCER',
                    id_mcer: $("#id_mcer").val(),
                    nombre: $("#nombre").val()
                }, function(data) {
                    if (data.rst == "1") {
                        alert('MCER agregado con éxito');
                        $("#formAgregarMCER")[0].reset(); // Limpiar el formulario
                    } else {
                        alert('Error al agregar el MCER: ' + data.ms);
                    }
                }, 'json');
            });
        });
    </script>
<?php
    } else {
        // Si hay un error en la consulta de usuario, imprimir el mensaje de error
        echo "Error al obtener los datos del usuario: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
