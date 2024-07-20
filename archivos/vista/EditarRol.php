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
    <title>editar rol</title>
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
                    <!-- Sección para mostrar y editar el perfil del usuario -->
                    <!-- Sección para mostrar y editar el perfil del usuario -->
                      <!-- Sección para editar el rol -->
                      <h1>Editar Rol</h1>
                    <form id="formEditarRol">
                        <div class="form-group">
                            <label for="id_rol">ID Rol:</label>
                            <input type="text" class="form-control" id="id_rol" name="id_rol" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <button type="button" class="btn btn-primary" id="btnGuardarRol">
                            Guardar Cambios
                        </button>

                        <a href="paneldeadministrador.php" class="btn btn-primary" id="btnRegresar">
                    Regresar
                </a>
                    </form>
                    <div id="mensaje"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Añadir Bootstrap JS (opcional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Función para cargar los datos del rol a editar
            cargarDatosRol();

            // Acción al hacer clic en el botón de guardar cambios
            $(document).on("click", "#btnGuardarRol", function() {
                var id_rol = $("#id_rol").val();
                var nombre = $("#nombre").val();

                // Enviar solicitud AJAX para editar rol
                $.post("../../include/ctrlIndex2.php", {
                    action: 'EditarRol',
                    id_rol: id_rol,
                    nombre: nombre
                }, function(data) {
                    $("#mensaje").html(data.ms);
                    if (data.rst == "1") {
                        // Opcional: Puedes redirigir o realizar otras acciones después de editar correctamente
                    }
                }, 'json');
            });

            // Función para cargar los datos del rol actual
            function cargarDatosRol() {
                var id_rol = obtenerParametroURL('id_rol'); // Función para obtener el parámetro de la URL (ejemplo)
                // Puedes adaptar esta función para obtener el ID de rol de otra manera
                $.get("../../include/ctrlIndex2.php", { action: 'CargarRol', id_rol: id_rol }, function(data) {
                    if (data.rst == "1") {
                        $("#id_rol").val(data.id_rol);
                        $("#nombre").val(data.nombre);
                    } else {
                        alert('Error al cargar los datos del rol.');
                    }
                }, 'json');
            }

            // Función para obtener un parámetro específico de la URL
            function obtenerParametroURL(nombreParametro) {
                var url = window.location.search.substring(1);
                var parametros = url.split('&');
                for (var i = 0; i < parametros.length; i++) {
                    var parametro = parametros[i].split('=');
                    if (parametro[0] === nombreParametro) {
                        return parametro[1] === undefined ? true : decodeURIComponent(parametro[1]);
                    }
                }
            }
        });
    </script>
</body>
</html>
<?php
    } else {
        // Si hay un error en la consulta, imprimir el mensaje de error
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>