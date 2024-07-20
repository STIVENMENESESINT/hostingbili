<?php
// Incluir el archivo de configuración de conexión a la base de datos
include_once('../../include/conex.php');

// Iniciar la sesión con el nombre de sesión configurado
session_name($session_name);
session_start();

// Verificar si se recibieron datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre_empresa = $_POST['nombre'];
    $nit_empresa = $_POST['nit'];
    $correo_contacto = $_POST['email'];
    $telefono_contacto = $_POST['telefono'];
    $nombre_contacto = $_POST['contactoempresa'];
    $direccion_empresa = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $comentarios = $_POST['comentarios'];
    $archivo = $_FILES['archivo'];
    $archivo_nombre = $archivo['name'];
    $archivo_temp = $archivo['tmp_name'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $id_jornada = $_POST['id_jornada'];
    $id_modalidad = $_POST['id_modalidad'];
    $programaformacion = $_POST['programaformacion'];

    // Mover el archivo a una ubicación permanente (por ejemplo, una carpeta de archivos)
    $ruta_archivo = '../../archivos_soli/' . $archivo_nombre;
    move_uploaded_file($archivo_temp, $ruta_archivo);

    // Preparar la consulta SQL para insertar los datos en la tabla detallesolicitud
    $query = "INSERT INTO detallesolicitud 
              (nombre_empresa, nit_empresa, correo_contacto, telefono_contacto, 
               nombre_contacto, direccion_empresa, fecha_nacimiento, comentarios,
               archivo, fecha_inicio, fecha_fin, id_jornada, id_modalidad, programaformacion)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia
    $stmt = mysqli_prepare($conn, $query);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, "sssssssssssiis", 
                               $nombre_empresa, $nit_empresa, $correo_contacto, $telefono_contacto, 
                               $nombre_contacto, $direccion_empresa, $fecha_nacimiento, $comentarios,
                               $ruta_archivo, $fecha_inicio, $fecha_fin, $id_jornada, $id_modalidad, $programaformacion);

        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);

        // Verificar si se insertó correctamente
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "¡Solicitud enviada correctamente!";
            // Puedes redirigir o hacer alguna acción adicional después de la inserción exitosa
        } else {
            echo "Error al procesar la solicitud. Inténtelo de nuevo.";
        }

        // Cerrar la sentencia
        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);

} else {
    // Si no se recibieron datos por POST, redirigir a la página principal o mostrar un mensaje de error
    echo "Error: No se recibieron datos del formulario.";
}
?>
