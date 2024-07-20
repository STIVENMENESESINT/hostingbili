<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
    <link rel="stylesheet" href="./css/bulma.min.css">
</head>
<body>

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
<?php
    require_once "main.php";

    // Recibir los datos del formulario
    $nombre = limpiar_cadena($_POST['proveedor_nombre']);
    $direccion = limpiar_cadena($_POST['proveedor_direccion']);
    $telefono = limpiar_cadena($_POST['proveedor_telefono']);
    $ciudad = limpiar_cadena($_POST['proveedor_ciudad']);
    $correo = limpiar_cadena($_POST['proveedor_correo']);

    // Insertar el proveedor en la base de datos
    $conexion = conexion();
    $query = $conexion->prepare("INSERT INTO proveedor (proveedor_nombre, proveedor_direccion, proveedor_telefono, proveedor_ciudad, proveedor_correo) VALUES (:nombre, :direccion, :telefono, :ciudad, :correo)");
    $query->bindParam(':nombre', $nombre);
    $query->bindParam(':direccion', $direccion);
    $query->bindParam(':telefono', $telefono);
    $query->bindParam(':ciudad', $ciudad);
    $query->bindParam(':correo', $correo);

    if ($query->execute()) {
        // Éxito al guardar el proveedor
        echo "Proveedor guardado correctamente.";
    } else {
        // Error al guardar el proveedor
        echo "Error al guardar el proveedor. Por favor, inténtalo de nuevo.";
    }
?>
