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
    <title>Listar Tipos de Documento</title>
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
                    <h1>Agregar Nuevo Tipo de Documento</h1>
                    <form id="formAgregarTipoDocumento">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Tipo de Documento</button>
                    </form>

                    <h3 class="mb-4">Lista de Tipos de Documento</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaTiposDocumento">
                            <!-- Aquí se llenarán los datos con PHP -->
                            <?php
                            $query_tipos = "SELECT * FROM tipodocumento";
                            $result_tipos = mysqli_query($conn, $query_tipos);

                            if (mysqli_num_rows($result_tipos) > 0) {
                                while ($row = mysqli_fetch_assoc($result_tipos)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id_doc'] . "</td>";
                                    echo "<td>" . $row['nombre'] . "</td>";
                                    echo '<td>
                                                   <button class="btn btn-primary btnDetalle" data-id="' . $row['id_doc'] . '">Editar</button>
                                            <button class="btn btn-info btnDetalle" data-id="' . $row['id_doc'] . '">Ver Detalle</button>
                                            <button class="btn btn-danger btnEliminar" data-id="' . $row['id_doc'] . '">Eliminar</button>
                                          </td>';
                                    echo "</tr>";
                                }
                            } else {
                                echo '<tr><td colspan="3">No hay tipos de documento registrados.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar detalles de tipo de documento -->
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="detalleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleLabel">Detalles del Tipo de Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="detalleID"></span></p>
                    <p><strong>Nombre:</strong> <span id="detalleNombre"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de regresar -->
    <a href="listardesdepaneldeadministrador.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>

    <script>
        $(document).ready(function () {
            // Funciones JavaScript para manejar los eventos de los botones y formularios
            $(document).on('click', '.btnDetalle', function () {
                var tipo = $(this).closest('tr').children('td');
                $('#detalleID').text(tipo.eq(0).text());
                $('#detalleNombre').text(tipo.eq(1).text());
                $('#modalDetalle').modal('show');
            });

            $(document).on('click', '.btnEliminar', function () {
                var id_tipo_documento = $(this).data('id');
                if (confirm('¿Estás seguro de eliminar este tipo de documento?')) {
                    $.post('../../include/ctrlIndex3.php', {
                        action: 'EliminarTipoDocumento',
                        id_tipo_documento: id_tipo_documento
                    }, function (data) {
                        alert(data.ms);
                        if (data.rst === "1") {
                            location.reload(); // Recargar la página para actualizar la lista
                        }
                    }, 'json');
                }
            });

            $(document).on("submit", "#formAgregarTipoDocumento", function (event) {
                event.preventDefault();
                var nombre = $("#nombre").val();
                $.post("../../include/ctrlIndex3.php", {
                    action: 'AgregarTipoDocumento',
                    nombre: nombre
                }, function (data) {
                    if (data.rst == "1") {
                        alert('Tipo de documento agregado con éxito');
                        $("#formAgregarTipoDocumento")[0].reset(); // Limpiar el formulario
                        location.reload(); // Recargar la página para actualizar la lista
                    } else {
                        alert('Error al agregar el tipo de documento: ' + data.ms);
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
