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
    <title>agregar generos </title>
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
        <h2>Editar Género</h2>
        <div id="mensaje"></div>
        <form id="formEditarGenero">
            <div class="form-group">
                <label for="nombre">Nombre del Género:</label>
                <input type="hidden" id="id_genero" name="id_genero" value="<?php echo $_GET['id']; ?>">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Género">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="listargeneros.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script>

$(document).ready(function() {
            // Acción al hacer clic en el botón de agregar género
            $(document).on("click", "#btnAgregarGenero", function() {
                // Enviar solicitud AJAX para agregar género
                $.post("../../include/ctrlIndex3.php", {
                    action: 'AgregarGenero',
                    nombre: $("#nombreGenero").val()
                }, function(data) {
                    if (data.rst == "1") {
                        alert('Género agregado con éxito');
                        $("#formAgregarGenero")[0].reset(); // Limpiar el formulario
                    } else {
                        alert('Error al agregar el género: ' + data.ms);
                    }
                }, 'json');
            });
        });



        $(document).on("click", ".btnEditarGenero", function() {
        var generoId = $(this).data('id');
        // Aquí puedes implementar la lógica para editar el género específico
        console.log('Editar género con ID: ' + generoId);
        // Por ejemplo, puedes redirigir a la página de edición con el ID del género
        window.location.href = 'editargenero.php?id=' + generoId;
    });






        $(document).ready(function () {
            // Manejo del formulario para editar género
            $('#formEditarGenero').submit(function (event) {
                event.preventDefault(); // Evitar que se envíe el formulario de forma tradicional

                // Obtener los datos del formulario
                var id_genero = $('#id_genero').val();
                var nombre = $('#nombre').val();

                // Enviar los datos al servidor usando AJAX
                $.ajax({
                    type: 'POST',
                // Reemplaza con la URL correcta
                    data: {
                        action: 'EditarGenero', // Acción a realizar en el backend
                        id_genero: id_genero,
                        nombre: nombre
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.rst == '1') {
                            // Mostrar mensaje de éxito y redirigir o actualizar según tu lógica
                            $('#mensaje').html('<div class="alert alert-success" role="alert">' + response.ms + '</div>');
                            // Ejemplo de redirección después de 2 segundos
                            setTimeout(function () {
                                window.location.href = 'listargeneros.php'; // Reemplaza con la URL correcta
                            }, 2000);
                        } else {
                            // Mostrar mensaje de error si falla la actualización
                            $('#mensaje').html('<div class="alert alert-danger" role="alert">' + response.ms + '</div>');
                        }
                    },
                    error: function () {
                        // Manejar errores de conexión u otros errores
                        $('#mensaje').html('<div class="alert alert-danger" role="alert">Error al intentar actualizar el género.</div>');
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