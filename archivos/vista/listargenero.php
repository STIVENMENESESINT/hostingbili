<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
session_name($session_name);
session_start();
$conn = Conectarse();

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
    // Consulta para obtener los géneros
    $query_generos = "SELECT * FROM genero";
    $result_generos = mysqli_query($conn, $query_generos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" href="../../herramientas/css/css/layout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Géneros</title>
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

            <h1>Agregar Nuevo Género</h1>
        <form id="formAgregarGenero">
            <div class="form-group">
                <label for="nombreGenero">Nombre del Género:</label>
                <input type="text" class="form-control" id="nombreGenero" name="nombreGenero" required>
            </div>
            <button type="button" class="btn btn-primary" id="btnAgregarGenero">
                Agregar Género
            </button>
        
     





                <h3 class="mb-4">Lista de Géneros</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaGeneros">
                        <!-- Aquí se llenarán los datos con PHP -->
                        <?php
                        if (mysqli_num_rows($result_generos) > 0) {
                            while ($row = mysqli_fetch_assoc($result_generos)) {
                                echo "<tr>";
                                echo "<td>" . $row['id_genero'] . "</td>";
                                echo "<td>" . $row['nombre'] . "</td>";
                                echo '<td>
                                        <button class="btn btn-info btnDetalle" data-id="' . $row['id_genero'] . '">Ver Detalle</button>
                                        <a href="editargenero.php?id=' . $row['id_genero'] . '" class="btn btn-primary">Editar</a>
                                        <button class="btn btn-danger btnEliminar" data-id="' . $row['id_genero'] . '">Eliminar</button>
                                      </td>';
                                echo "</tr>";
                            }
                        } else {
                            echo '<tr><td colspan="3">No hay géneros registrados.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar detalles de género -->
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="detalleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleLabel">Detalles del Género</h5>
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
    </div>  </div><a href="listardesdepaneldeadministrador.php">
                          <i class="fas fa-arrow-circle-left"></i>
                          <span class="nav-item">Regresar</span>

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





        $(document).ready(function() {
            $(document).on('click', '.btnDetalle', function() {
                var generoId = $(this).data('id');
                // Aquí puedes implementar la lógica para mostrar los detalles del género específico
                console.log('Ver detalle del género con ID: ' + generoId);
                // Por ejemplo, puedes cargar los detalles del género usando AJAX y mostrarlos en el modal
                $('#modalDetalle').modal('show');
            });

            $(document).on('click', '.btnEliminar', function() {
                var generoId = $(this).data('id');
                // Aquí puedes implementar la lógica para eliminar el género específico
                console.log('Eliminar género con ID: ' + generoId);
                if (confirm('¿Estás seguro de eliminar este género?')) {
                    // Enviar solicitud AJAX para eliminar el género
                    $.post("../../include/ctrlIndex3.php", {
                        action: 'EliminarGenero',
                        id_genero: generoId
                    }, function(data) {
                        if (data.rst == "1") {
                            alert('Género eliminado con éxito');
                            // Actualizar la tabla después de eliminar el género
                            // Puedes recargar la página o actualizar solo la tabla según tu lógica
                            location.reload();
                        } else {
                            alert('Error al eliminar el género: ' + data.ms);
                        }
                    }, 'json');
                }
            });
        });
    </script>
</body>
</html>

<?php
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
