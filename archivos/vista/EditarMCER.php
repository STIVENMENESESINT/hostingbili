<?php
// Incluir el archivo de configuración de conexión a la base de datos
include_once('../../include/conex.php');

// Establecer el tipo de contenido a HTML con el charset especificado en la configuración
header('Content-Type: text/html; charset=' . $charset);

// Iniciar la sesión con el nombre de sesión configurado
session_name($session_name);
session_start();

// Verificar si existe una sesión activa con el id_userprofile
if (isset($_SESSION['id_userprofile'])) {
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
    <title>rol</title>
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
        <h1>Actualizar MCER</h1>
        <form id="formActualizarMCER">
            <input type="hidden" id="id_mcer" name="id_mcer" value="<?php echo htmlspecialchars($id_mcer); ?>">
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($descripcion); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar MCER</button>
            <a href="paneldeadministrador.php" class="btn btn-secondary">Cancelar</a>
        </form>
        </div>  </div>  </div>  </div>  </div>  </div>
    </div><a href="listarMCER.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>
    <script>
        $(document).ready(function() {
            // Capturar el evento de envío del formulario
            $('#formActualizarMCER').submit(function(event) {
                // Evitar el envío estándar del formulario
                event.preventDefault();

                // Obtener los datos del formulario
                var formData = $(this).serialize();

                // Enviar la solicitud Ajax
                $.ajax({
                    type: 'POST',
                    url: 'actualizar_mcer.php', // Ruta al archivo PHP que procesa la actualización
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Manejar la respuesta del servidor
                        if (response.rst == '1') {
                            // Éxito
                            alert(response.ms);
                            // Redirigir u actualizar según sea necesario
                        } else {
                            // Error
                            alert(response.ms);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores de Ajax
                        console.error(xhr.responseText);
                        alert('Error al procesar la solicitud.');
                    }
                });
            });
        });
    </script>
</body>

</html>

<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>


