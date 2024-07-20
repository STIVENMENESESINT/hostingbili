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
    <title>Agregar Calificaciones</title>
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
                    <h2 class="mb-4">Agregar Calificación</h2>
        <form id="formAgregarCalificacion">
            <div class="form-group">
                <label for="nombre">Nombre de la Calificación:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="user_id">Seleccionar Usuario:</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    <!-- Opciones de usuarios se cargarán dinámicamente -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Calificación</button>



        <nav class="navbar navbar-dark bg-success">
                    <!-- Navbar content -->
                    <li>
                        <a href="paneldeadministrador.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>
                    </li>
                </nav>
    </div></div><a href="listardesdepaneldeadministrador.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            // Cargar opciones de usuarios al cargar la página
            $.ajax({
                url: 'obtener_usuarios.php', // Archivo PHP para obtener usuarios
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data && data.length > 0) {
                        var options = '';
                        $.each(data, function (index, user) {
                            options += '<option value="' + user.id_userprofile + '">' + user.nombre + ' ' + user.apellido + '</option>';
                        });
                        $('#user_id').html(options);
                    } else {
                        alert('No se encontraron usuarios.');
                    }
                },
                error: function () {
                    alert('Error al obtener usuarios.');
                }
            });

            // Envío del formulario para agregar calificación
            $('#formAgregarCalificacion').submit(function (event) {
                event.preventDefault();
                var nombre = $('#nombre').val();
                var user_id = $('#user_id').val();

                $.ajax({
                    url: 'ctrlIndex3.php', // Archivo PHP para manejar la lógica del servidor
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'AgregarCalificacion',
                        nombre: nombre,
                        user_id: user_id
                    },
                    success: function (response) {
                        if (response.rst == "1") {
                            alert('Calificación agregada con éxito.');
                            $('#formAgregarCalificacion')[0].reset(); // Limpiar formulario
                        } else {
                            alert('Error: ' + response.ms);
                        }
                    },
                    error: function () {
                        alert('Error al agregar la calificación.');
                    }
                });
            });
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