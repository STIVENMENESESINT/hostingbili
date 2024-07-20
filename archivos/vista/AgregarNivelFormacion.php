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
                    
                                 <!-- Sección para mostrar y editar el perfil del usuario -->
                                 <h1>Agregar Nuevo Nivel de Formación</h1>
        <form id="formAgregarNivelFormacion">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <button type="button" class="btn btn-primary" id="btnAgregarNivelFormacion">
                Agregar Nivel de Formación
            </button>
  
        </form>
                
                
                
                
                
                
                
                <h3 class="mb-4">Lista de Niveles de Formación</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaNivelesFormacion">
                            <!-- Aquí se llenarán los datos con PHP -->
                            <?php
                            $query_niveles = "SELECT * FROM nivelformacion";
                            $result_niveles = mysqli_query($conn, $query_niveles);

                            if (mysqli_num_rows($result_niveles) > 0) {
                                while ($row = mysqli_fetch_assoc($result_niveles)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id_nivel_formacion'] . "</td>";
                                    echo "<td>" . $row['nombre'] . "</td>";
                                    echo '<td>

<button class="btn btn-primary btn-editar-nivel" data-id="' . $row['id_nivel_formacion'] . '">Editar</button>
                                    
                                            <button class="btn btn-info btnDetalle" data-id="' . $row['id_nivel_formacion'] . '">Ver Detalle</button>
                                            <button class="btn btn-danger btnEliminar" data-id="' . $row['id_nivel_formacion'] . '">Eliminar</button>
                                          </td>';
                                    echo "</tr>";
                                }
                            } else {
                                echo '<tr><td colspan="3">No hay niveles de formación registrados.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar detalles de nivel de formación -->
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="detalleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleLabel">Detalles del Nivel de Formación</h5>
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
    </div></div></div></div><a href="listarnivelformacion.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>
   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btnDetalle', function () {
                var nivel = $(this).closest('tr').children('td');
                $('#detalleID').text(nivel.eq(0).text());
                $('#detalleNombre').text(nivel.eq(1).text());
                $('#modalDetalle').modal('show');
            });

            $(document).on('click', '.btnEliminar', function () {
                var id_nivel_formacion = $(this).data('id');
                if (confirm('¿Estás seguro de eliminar este nivel de formación?')) {
                    $.post('../../include/ctrlIndex3.php', {
                        action: 'EliminarNivel',
                        id_nivel_formacion: id_nivel_formacion
                    }, function (data) {
                        alert(data.ms);
                        if (data.rst === "1") {
                            location.reload(); // Recargar la página para actualizar la lista
                        }
                    }, 'json');
                }
            });
        });






   
        $(document).ready(function() {
            // Acción al hacer clic en el botón de agregar nivel de formación
            $(document).on("click", "#btnAgregarNivelFormacion", function() {
                // Enviar solicitud AJAX para agregar nivel de formación
                $.post("../../include/ctrlIndex3.php", {
                    action: 'AgregarNivelFormacion',
                    nombre: $("#nombre").val()
                }, function(data) {
                    if (data.rst == "1") {
                        alert('Nivel de formación agregado con éxito');
                        $("#formAgregarNivelFormacion")[0].reset(); // Limpiar el formulario
                    } else {
                        alert('Error al agregar el nivel de formación: ' + data.ms);
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
