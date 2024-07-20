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
    // Verificar si se ha enviado el ID de la observación a eliminar
    if (isset($_GET['id'])) {
        $idobs = $_GET['id'];

        // Query para eliminar la observación de matrícula
        $query = "DELETE FROM matriculaobs WHERE idobs=$idobs";

        // Ejecutar la consulta de eliminación
        if (mysqli_query($conn, $query)) {
            echo "Observación eliminada correctamente.";
        } else {
            echo "Error al eliminar la observación: " . mysqli_error($conn);
        }
    }

    // Redirigir al usuario de vuelta a la lista de observaciones después de eliminar
    header("Location: gestion_matriculaobs.php");
    exit();
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
