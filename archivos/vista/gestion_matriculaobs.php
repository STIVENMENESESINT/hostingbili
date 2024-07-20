<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
session_name($session_name);
session_start();

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
    $conn = Conectarse(); // Establecer conexión a la base de datos

    // Lógica para gestionar las observaciones de matrícula
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar qué acción se está realizando (editar, eliminar, etc.)
        if (isset($_POST['accion'])) {
            $accion = $_POST['accion'];

            if ($accion == 'eliminar') {
                if (isset($_POST['idobs'])) {
                    $idobs = mysqli_real_escape_string($conn, $_POST['idobs']);
                    // Query para eliminar la observación de matrícula
                    $query = "DELETE FROM matriculaobs WHERE idobs = $idobs";

                    if (mysqli_query($conn, $query)) {
                        echo "Observación eliminada correctamente.";
                    } else {
                        echo "Error al eliminar la observación: " . mysqli_error($conn);
                    }
                }
            }
            // Puedes agregar más lógica para otras acciones como editar, agregar, etc.
        }
    }

    // Consulta para obtener todas las observaciones de matrícula
    $query = "SELECT * FROM matriculaobs";
    $resultado = mysqli_query($conn, $query);

    // Verificar si se obtuvieron resultados
    if ($resultado) {
        ?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
            <?php include_once('cabecera.php'); ?>
            <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
            <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
            <style>
                /* Estilos adicionales */
                .navbar-dark .navbar-nav .nav-link {
                    color: #fff;
                    transition: all 0.3s ease;
                    display: block;
                    padding: 10px 15px;
                    text-decoration: none;
                }

                .navbar-dark .navbar-nav .nav-link:hover {
                    background-color: #007bff;
                }

                .nav-link {
                    display: block;
                    padding: 10px 15px;
                    color: #333;
                    text-decoration: none;
                    transition: all 0.3s ease;
                }

                .nav-item-hover:hover {
                    transform: scale(1.1);
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
            </style>
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
                            <!-- Sección para mostrar las observaciones de matrícula -->
                            <h1> Postulacion A Programa De Formacion Nuevo</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Identificacion Del Aspirante</th>
                                        <th>Nombre Del Aspirante </th>
                                        <th>Correo Electronico Del Aspirante</th>
                                        <th>Fecha</th>
                                        <th>Observación</th>
                                        <th>Programa de Formación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Iterar sobre cada observación de matrícula
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                        echo "<tr>";
                                        echo "<td>" . $fila['idobs'] . "</td>";
                                        echo "<td>" . $fila['idalumno'] . "</td>";
                                        echo "<td>" . $fila['codalumno'] . "</td>";
                                        echo "<td>" . $fila['codmatri'] . "</td>";
                                        echo "<td>" . $fila['fecha'] . "</td>";
                                        echo "<td>" . $fila['obs'] . "</td>";
                                        echo "<td>" . obtenerNombreProgramaFormacion($conn, $fila['programaformacion']) . "</td>"; // Función para obtener el nombre del programa de formación
                                        echo "<td>";
                                        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                                        echo "<input type='hidden' name='idobs' value='" . $fila['idobs'] . "'>";
                                        echo "<input type='hidden' name='accion' value='eliminar'>";
                                        echo "<button type='submit' class='btn btn-danger'>Eliminar</button>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Añadir Bootstrap JS (opcional) -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>

        </html>
        <?php
        // Liberar el resultado de la consulta
        mysqli_free_result($resultado);
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario al inicio de sesión
    header("Location: ../../index.php");
    exit; // Asegúrate de terminar el script después de la redirección
}

// Función para obtener el nombre del programa de formación
function obtenerNombreProgramaFormacion($conn, $id_programa)
{
    $query = "SELECT nombre FROM programaformacion WHERE id_programaformacion = $id_programa";
    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['nombre'];
    } else {
        return "Programa no encontrado";
    }
}
?>
