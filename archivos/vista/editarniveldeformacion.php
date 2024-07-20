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
    $query = "SELECT * FROM userprofile WHERE id_userprofile = " . $_SESSION['id_userprofile'];
    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
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
    <title>Listar Niveles de Formación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="layout">
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>
            <div>
                <?php include_once('cabeceraMenu.php'); ?>
            </div>
        </aside>

        <div class="layout__content">
            <div class="content__page">
                <div id="contenido">
                    
        <h2>Editar Nivel de Formación</h2>
        <form id="formEditarNivelFormacion">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="hidden" id="id_nivel_formacion" name="id_nivel_formacion" value="<?php echo $id_nivel_formacion; ?>">
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="listarnivelesdeformacion.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>   </div>   </div>   </div>   </div>
    </div><a href="listarnivelformacion.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>
    <script>
        $(document).ready(function () {
            $('#formEditarNivelFormacion').submit(function (event) {
                event.preventDefault();
                $.post('../../include/ctrlIndex3.php', {
                    action: 'EditarNivelFormacion',
                    id_nivel_formacion: $('#id_nivel_formacion').val(),
                    nombre: $('#nombre').val()
                }, function (data) {
                    alert(data.ms);
                    if (data.rst === "1") {
                        window.location.href = 'listarnivelesdeformacion.php'; // Redireccionar a la lista de niveles de formación
                    }
                }, 'json');
            });
        });
    </script>
</body>
</html>
<?php
    } else {
        echo "Error al obtener los datos del usuario.";
    }
} else {
    echo "No hay una sesión activa.";
}
?>
