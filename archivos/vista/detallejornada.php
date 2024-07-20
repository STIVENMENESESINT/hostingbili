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
    // Consulta para obtener las jornadas
    $queryJornadas = "SELECT * FROM jornada";
    $resultadoJornadas = mysqli_query($conn, $queryJornadas);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultadoJornadas) {
        // Recuperar las jornadas
        $jornadas = mysqli_fetch_all($resultadoJornadas, MYSQLI_ASSOC);
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
    <title>Detalle de Jornada</title>
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
                    <h2>Detalle de Jornada</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($jornadas)) {
                                foreach ($jornadas as $jornada) {
                                    echo "<tr>
                                        <td>{$jornada['id_jornada']}</td>
                                        <td>{$jornada['nombre']}</td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>No hay registros</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
  
                </div>
            </div>
        </div>
    </div>               <a href="listarjornada.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>
</body>
</html>

<?php
    } else {
        // Si hay un error en la consulta de jornadas, imprimir el mensaje de error
        echo "Error al ejecutar la consulta de jornadas: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
