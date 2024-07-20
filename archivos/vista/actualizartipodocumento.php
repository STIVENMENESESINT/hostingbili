<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Tipo de Documento</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Actualizar Tipo de Documento</h2>
        <form id="formEditarTipoDocumento">
            <input type="hidden" id="id_doc" name="id_doc" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <div class="form-group">
                <label for="nombre">Nombre del Tipo de Documento:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Tipo de Documento">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="listartipodocumentos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <!-- Incluir jQuery y Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            // Obtener el ID del tipo de documento desde la URL
            var id_doc = <?php echo isset($_GET['id']) ? $_GET['id'] : '0'; ?>;

            // Cargar los datos actuales del tipo de documento
            $.post("../../include/ctrlIndex3.php", {
                action: 'DetalleTipoDocumento',
                id_doc: id_doc
            }, function (data) {
                if (data.rst == "1") {
                    $('#nombre').val(data.nombre); // Mostrar el nombre actual del tipo de documento
                } else {
                    alert('No se pudo cargar la información del tipo de documento.');
                    window.location.href = 'listartipodocumentos.php'; // Redirigir si hay un problema
                }
            }, 'json');

            // Manejar la actualización del tipo de documento
            $('#formEditarTipoDocumento').submit(function (event) {
                event.preventDefault(); // Evitar envío tradicional del formulario

                // Obtener los datos del formulario
                var id_doc = $('#id_doc').val();
                var nombre = $('#nombre').val();

                // Enviar los datos al servidor usando AJAX para actualizar
                $.ajax({
                    type: 'POST',
                    url: '../../include/ctrlIndex3.php', // Reemplaza con la URL correcta
                    data: {
                        action: 'EditarTipoDocumento',
                        id_doc: id_doc,
                        nombre: nombre
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.rst == '1') {
                            // Mostrar mensaje de éxito y redirigir según tu lógica
                            alert('Tipo de documento actualizado con éxito.');
                            window.location.href = 'listartipodocumentos.php'; // Redirigir a la lista de tipos de documentos
                        } else {
                            // Mostrar mensaje de error si falla la actualización
                            alert('Error al actualizar el tipo de documento: ' + response.ms);
                        }
                    },
                    error: function () {
                        // Manejar errores de conexión u otros errores
                        alert('Error al conectar con el servidor.');
                    }
                });
            });
        });
    </script>
</body>
</html>
