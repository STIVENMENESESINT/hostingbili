<?php
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
    <title>Agregar Competencia</title>
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
                    <form id="formAgregarCompetencia">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Competencia:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Agregar Competencia</button>
                    </form>

                    <hr>

                    <h3 class="mb-4">Lista de Competencias</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaCompetencias">
                            <!-- Los datos se llenarán aquí con jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <a href="listarcompetencia.php">
        <i class="fas fa-arrow-circle-left"></i>
        <span class="nav-item">Regresar</span>
    </a>

    <!-- Modal para mostrar detalles de la competencia -->
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="detalleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleLabel">Detalles de la Competencia</h5>
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

    <script>
        $(document).ready(function () {
            function listarCompetencias() {
                $.post('../../include/ctrlIndex3.php', {action: 'ListarCompetencias'}, function (data) {
                    if (data.rst === "1") {
                        $('#tablaCompetencias').empty();
                        $.each(data.records, function (index, competencia) {
                            $('#tablaCompetencias').append(
                                `<tr>
                                    <td>${competencia.id}</td>
                                    <td>${competencia.nombre}</td>
                                    <td>
                                        <button class="btn btn-info btnDetalle" data-id="${competencia.id}">Ver Detalle</button>
                                        <button class="btn btn-danger btnEliminar" data-id="${competencia.id}">Eliminar</button>
                                    </td>
                                </tr>`
                            );
                        });
                    } else {
                        alert(data.ms);
                    }
                }, 'json');
            }

            listarCompetencias();

            $('#formAgregarCompetencia').submit(function (event) {
                event.preventDefault();
                $.post('../../include/ctrlIndex3.php', {
                    action: 'AgregarCompetencia',
                    nombre: $('#nombre').val()
                }, function (data) {
                    alert(data.ms);
                    if (data.rst === "1") {
                        listarCompetencias();
                        $('#formAgregarCompetencia')[0].reset();
                    }
                }, 'json');
            });

            $(document).on('click', '.btnDetalle', function () {
                var competencia = $(this).closest('tr').children('td');
                $('#detalleID').text(competencia.eq(0).text());
                $('#detalleNombre').text(competencia.eq(1).text());
                $('#modalDetalle').modal('show');
            });

            $(document).on('click', '.btnEliminar', function () {
                var id = $(this).data('id');
                if (confirm('¿Estás seguro de eliminar esta competencia?')) {
                    $.post('../../include/ctrlIndex3.php', {action: 'EliminarCompetencia', id_competencia: id}, function (data) {
                        alert(data.ms);
                        if (data.rst === "1") {
                            listarCompetencias();
                        }
                    }, 'json');
                }
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
