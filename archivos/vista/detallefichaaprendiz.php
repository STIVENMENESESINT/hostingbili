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
    $query = "SELECT * FROM userprofile 
    WHERE id_userprofile = " . $_SESSION['id_userprofile'];
    $resultado = mysqli_query($conn, $query);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultado) {
        // Recuperar los datos del usuario
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
    <title>agregar fichas de formacion</title>
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
           
        </form>
<body>
    <div class="container mt-5">
        <h1>Listado de Fichas</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ficha</th>
                        <th>Programa de Formación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener las fichas y sus detalles de programa de formación
                    $query = "SELECT f.id_ficha, f.ficha, p.nombre AS programa_formacion 
                              FROM ficha AS f 
                              INNER JOIN programaformacion AS p ON f.id_programaformacion = p.id_programaformacion";
                    
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['id_ficha'] . '</td>';
                            echo '<td>' . htmlspecialchars($row['ficha']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['programa_formacion']) . '</td>';
                            echo '<td>

                           
                                  
                                 
                                  </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">No se encontraron fichas.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div></div>
    </div>     </div>
    </div><a href="listarfichadesdeaprendiz.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>

    <!-- Script para manejar acciones de eliminar mediante Ajax -->
    <script>

$(document).ready(function() {
            // Acción al hacer clic en el botón de agregar ficha
            $(document).on("click", "#btnAgregarFicha", function() {
                // Enviar solicitud AJAX para agregar ficha
                $.post("../../include/ctrlIndex3.php", {
                    action: 'AgregarFicha',
                    ficha: $("#ficha").val(),
                    id_programaformacion: $("#id_programaformacion").val()
                }, function(data) {
                    if (data.rst == "1") {
                        alert('Ficha agregada con éxito');
                        $("#formAgregarFicha")[0].reset(); // Limpiar el formulario
                    } else {
                        alert('Error al agregar la ficha: ' + data.ms);
                    }
                }, 'json');
            });
        });



        $(document).ready(function() {
            // Eliminar ficha
            $('.btn-eliminar').click(function() {
                var id_ficha = $(this).data('id');
                if (confirm('¿Estás seguro de eliminar esta ficha?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'eliminar_ficha.php', // Ajusta la ruta según tu estructura de archivos
                        data: { id_ficha: id_ficha },
                        dataType: 'json',
                        success: function(response) {
                            if (response.rst == '1') {
                                alert(response.ms);
                                // Recargar la página o actualizar el listado de fichas
                                location.reload();
                            } else {
                                alert(response.ms);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Error al procesar la solicitud.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>

<?php
    } else {
        // Si hay un error en la consulta de datos del usuario, imprimir el mensaje de error
        echo "Error al consultar los datos del usuario: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
