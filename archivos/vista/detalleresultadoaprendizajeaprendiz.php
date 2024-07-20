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
    <title>Agregar Resultados de Aprendizaje</title>
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
                    <form id="formAgregarResultado">
                        <!-- Aquí puedes agregar campos para agregar resultados de aprendizaje -->
                    </form>

                    <hr>

                    <h3 class="mb-4">Lista de Resultados de Aprendizaje</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Competencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaResultados">
                            <!-- Los datos se llenarán aquí con jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar detalles de resultado de aprendizaje -->
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="detalleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleLabel">Detalles del Resultado de Aprendizaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="detalleID"></span></p>
                    <p><strong>Nombre:</strong> <span id="detalleNombre"></span></p>
                    <p><strong>Competencia:</strong> <span id="detalleCompetencia"></span></p>
                </div>
            </div>
        </div>
    </div>

    <a href="listarresultadosaprendizajedesdeaprendiz.php">
        <i class="fas fa-arrow-circle-left"></i>
        <span class="nav-item">Regresar</span>
    </a>

    <script>
        $(document).ready(function () {
            function listarResultados() {
                $.post('../../include/ctrlIndex3.php', {action: 'ListarResultadosAprendizaje'}, function (data) {
                    if (data.rst === "1") {
                        $('#tablaResultados').empty();
                        $.each(data.data, function (index, resultado) {
                            $('#tablaResultados').append(
                                `<tr>
                                    <td>${resultado.id_resultado_aprendizaje}</td>
                                    <td>${resultado.nombre}</td>
                                    <td>${resultado.nombre_competencia}</td>
                                    <td>
                                        <button class="btn btn-info btnDetalle" data-id="${resultado.id_resultado_aprendizaje}">Ver Detalle</button>
                                    </td>
                                </tr>`
                            );
                        });
                    } else {
                        alert(data.ms);
                    }
                }, 'json');
            }

            listarResultados();

            $('#formAgregarResultado').submit(function (event) {
                event.preventDefault();
                $.post('../../include/ctrlIndex3.php', {
                    action: 'AgregarResultadoAprendizaje',
                    nombre: $('#nombre').val(),
                    id_competencia: $('#id_competencia').val()
                }, function (data) {
                    alert(data.ms);
                    if (data.rst === "1") {
                        listarResultados();
                        $('#formAgregarResultado')[0].reset();
                    }
                }, 'json');
            });

            $(document).on('click', '.btnDetalle', function () {
                var resultado = $(this).closest('tr').children('td');
                $('#detalleID').text(resultado.eq(0).text());
                $('#detalleNombre').text(resultado.eq(1).text());
                $('#detalleCompetencia').text(resultado.eq(2).text());
                $('#modalDetalle').modal('show');
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

