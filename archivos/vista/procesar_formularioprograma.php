<?php
// Verificar si se recibieron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verificar si la acción es agregar programa de formación
    if (isset($_POST["action"]) && $_POST["action"] == "AgregarProgramaFormacion") {
        
        // Incluir archivo de conexión a la base de datos
        include_once("conexion.php"); // Asegúrate de ajustar la ruta según tu estructura
        
        // Recuperar y limpiar los datos del formulario
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $id_jornada = intval($_POST['id_jornada']);
        $id_mcer = intval($_POST['id_mcer']);
        $id_modalidad = intval($_POST['id_modalidad']);
        $id_nivel_formacion = intval($_POST['id_nivel_formacion']);
        $matriculados = intval($_POST['matriculados']);
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_cierre = $_POST['fecha_cierre'];
        $horas_curso = intval($_POST['horas_curso']);
        $id_estado = intval($_POST['id_estado']);
        $ficha = mysqli_real_escape_string($conn, $_POST['ficha']);
        
        // Validar los datos si es necesario
        // Aquí puedes agregar validaciones adicionales según tus requisitos
        
        // Preparar la consulta SQL para insertar el programa de formación
        $sql = "INSERT INTO programa_formacion (nombre, id_jornada, id_mcer, id_modalidad, id_nivel_formacion, matriculados, fecha_inicio, fecha_cierre, horas_curso, id_estado, ficha)
                VALUES ('$nombre', $id_jornada, $id_mcer, $id_modalidad, $id_nivel_formacion, $matriculados, '$fecha_inicio', '$fecha_cierre', $horas_curso, $id_estado, '$ficha')";
        
        // Ejecutar la consulta y verificar el resultado
        if (mysqli_query($conn, $sql)) {
            // Si la inserción fue exitosa, devolver respuesta JSON
            $response['rst'] = "1";
            $response['ms'] = "Programa de formación agregado correctamente.";
        } else {
            // Si hubo un error en la consulta SQL, devolver mensaje de error
            $response['rst'] = "0";
            $response['ms'] = "Error al agregar el programa de formación: " . mysqli_error($conn);
        }
        
        // Devolver la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    } else {
        // Si la acción no está definida o no es la esperada
        $response['rst'] = "0";
        $response['ms'] = "Acción no válida.";
        echo json_encode($response);
    }
} else {
    // Si no se recibieron datos por POST
    $response['rst'] = "0";
    $response['ms'] = "Método de solicitud no válido.";
    echo json_encode($response);
}
?>
