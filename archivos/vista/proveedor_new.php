

<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Administrador</title>
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

</head>


    <div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php
                    // Incluir el menú de navegación
                    include_once('menu.php');
                    ?>
            </div>
        </aside>
        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page"></div>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Proveedor</title>
    <link rel="stylesheet" href="./css/bulma.min.css">
</head>
<body>

<!-- Aquí puedes incluir la barra de navegación si la tienes en un archivo separado -->

<div class="container is-fluid mb-6">
    <h1 class="title">Proveedores</h1>
    <h2 class="subtitle">Agregar proveedor</h2>
</div>

<div class="container pb-6 pt-6">
    <?php include "./inc/btn_back.php"; ?>
    <div class="form-rest mb-6 mt-6"></div>
    <form action="./php/proveedor_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Nombre</label>
                    <input class="input" type="text" name="proveedor_nombre" maxlength="50" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Dirección</label>
                    <input class="input" type="text" name="proveedor_direccion" maxlength="100">
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Teléfono</label>
                    <input class="input" type="text" name="proveedor_telefono" maxlength="20">
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Ciudad</label>
                    <input class="input" type="text" name="proveedor_ciudad" maxlength="50">
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Correo electrónico</label>
                    <input class="input" type="email" name="proveedor_correo" maxlength="70">
                </div>
            </div>
        </div>
        <p class="has-text-centered">
            <button type="submit" class="button is-success is-rounded">Guardar</button>
        </p>
    </form>
</div>

</body>
</html>


<!-- Script jQuery para enviar el formulario a través de AJAX -->
<script>
$(document).ready(function(){
    $("#btnGuardarProveedor").click(function(){
        $.ajax({
            url: $("#formularioProveedor").attr("action"),
            method: "POST",
            data: $("#formularioProveedor").serialize(),
            success: function(response) {
                // Maneja la respuesta del servidor aquí
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Maneja el error de la solicitud AJAX aquí
                console.error(error);
            }
        });
    });
});
</script>

</body>
</html>


<?php
// Verifica si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica que los campos necesarios no estén vacíos
    if (!empty($_POST['proveedor_nombre']) && !empty($_POST['proveedor_direccion']) && !empty($_POST['proveedor_telefono']) && !empty($_POST['proveedor_ciudad']) && !empty($_POST['proveedor_correo'])) {
        // Incluye el archivo de conexión a la base de datos
        require_once "conexion.php";

        // Captura los datos del formulario
        $nombre = limpiar_cadena($_POST['proveedor_nombre']);
        $direccion = limpiar_cadena($_POST['proveedor_direccion']);
        $telefono = limpiar_cadena($_POST['proveedor_telefono']);
        $ciudad = limpiar_cadena($_POST['proveedor_ciudad']);
        $correo = limpiar_cadena($_POST['proveedor_correo']);

        // Guarda los datos en la base de datos
        $conexion = conexion(); // Establece la conexión a la base de datos
        $query = $conexion->prepare("INSERT INTO proveedor (proveedor_nombre, proveedor_direccion, proveedor_telefono, proveedor_ciudad, proveedor_correo) VALUES (:nombre, :direccion, :telefono, :ciudad, :correo)");
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':direccion', $direccion);
        $query->bindParam(':telefono', $telefono);
        $query->bindParam(':ciudad', $ciudad);
        $query->bindParam(':correo', $correo);

        if ($query->execute()) {
            // Si la inserción fue exitosa, devuelve un mensaje de éxito
            echo "Proveedor guardado correctamente.";
        } else {
            // Si hubo un error en la inserción, devuelve un mensaje de error
            echo "Error al guardar el proveedor. Por favor, inténtalo de nuevo.";
        }
    } else {
        // Si alguno de los campos necesarios está vacío, devuelve un mensaje de error
        echo "Todos los campos son obligatorios. Por favor, completa el formulario.";
    }
} else {
    // Si la solicitud no es POST, devuelve un mensaje de error
    echo "Error: Método de solicitud no válido.";
}
?>
