<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
session_name($session_name);
session_start();
$conn = Conectarse();

// Verificar si se recibió un método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar y sanitizar los datos del formulario
    $idalumno = mysqli_real_escape_string($conn, $_POST['idalumno']);
    $codalumno = mysqli_real_escape_string($conn, $_POST['codalumno']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $celular = mysqli_real_escape_string($conn, $_POST['celular']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $codmatri = mysqli_real_escape_string($conn, $_POST['codmatri']);
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);
    $obs = mysqli_real_escape_string($conn, $_POST['obs']);
    $programaformacion = mysqli_real_escape_string($conn, $_POST['programaformacion']);

    // Verificar si se está agregando un nuevo registro o actualizando uno existente (dependiendo de si se recibió idobs)
    
    
    
    if (isset($_POST['idobs'])) {
        // Actualizar registro existente
        $idobs = mysqli_real_escape_string($conn, $_POST['idobs']);
        
        $query = "UPDATE matriculaobs 
              SET idalumno = '$idalumno', codalumno = '$codalumno', codmatri = '$codmatri', fecha = '$fecha', obs = '$obs', programaformacion = '$programaformacion', celular = '$celular', nombre = '$nombre'
              WHERE idobs = $idobs";
        if (mysqli_query($conn, $query)) {
            // Redirigir a la página principal con mensaje de éxito
            header("Location: index.php?mensaje=Registro actualizado correctamente");
            exit();
        } else {
            echo "Error al actualizar el registro: " . mysqli_error($conn);
        }
    } else {
        // Insertar nuevo registro
        $query = "INSERT INTO matriculaobs (idalumno, codalumno, codmatri, fecha, obs, programaformacion) VALUES ('$idalumno', '$codalumno', '$codmatri', '$fecha', '$obs', '$programaformacion')";

        if (mysqli_query($conn, $query)) {
            // Redirigir a la página principal con mensaje de éxito
            header("Location: index.php?mensaje=Registro agregado correctamente");
            exit();
        } else {
            echo "Error al insertar el registro: " . mysqli_error($conn);
        }
    }
} else {
    // Si no es una solicitud POST, redirigir a la página principal
    header("Location: index.php");
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
{
    header("Location: ../../index.php");
}
?>