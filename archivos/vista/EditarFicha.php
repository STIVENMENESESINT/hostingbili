<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ficha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                    <!-- Formulario para editar ficha -->
                    <h1>Editar Ficha</h1>
                    <form id="formEditarFicha">
                        <input type="hidden" name="id_ficha" value="<?php echo $ficha['id_ficha']; ?>">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Ficha</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?php echo $ficha['nombre']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción de la Ficha</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="5"
                                required><?php echo $ficha['descripcion']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div></div>
    </div>     </div>
    </div><a href="listarficha.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Manejar el envío del formulario de edición de ficha
            $('#formEditarFicha').submit(function (event) {
                event.preventDefault();
                
                // Obtener los datos del formulario
                var formData = $(this).serialize();

                // Enviar solicitud AJAX para actualizar la ficha
                $.post("../../include/ctrlIndex3.php", formData, function (data) {
                    if (data.rst === "1") {
                        alert('Ficha actualizada con éxito');
                        window.location.href = 'listadofichas.php'; // Redirigir a la lista después de editar
                    } else {
                        alert('Error al actualizar la ficha: ' + data.ms);
                    }
                }, 'json');
            });
        });
    </script>
</body>

</html>
